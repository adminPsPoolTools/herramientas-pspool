<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ilovepdf\Ilovepdf;
use Ilovepdf\CompressTask;
use Ilovepdf\MergeTask;

class PdfController extends Controller
{
    private string $publicKey;
    private string $secretKey;

    public function __construct()
    {
        $this->publicKey = config('services.ilovepdf.public_key');
        $this->secretKey = config('services.ilovepdf.secret_key');
    }

    // ── Mostrar la vista ────────────────────────────────────────────
    public function index()
    {
        return view('pdfs.index');
    }

    // ── Unir + comprimir ────────────────────────────────────────────
    public function merge(Request $request)
    {
        $request->validate([
            'files'       => 'required|array|min:1',
            'files.*'     => 'file|mimes:pdf|max:200000', // 200 MB por archivo
            'compress'    => 'boolean',
            'quality'     => 'in:low,recommended,extreme',
        ]);

        $tmpDir   = sys_get_temp_dir() . '/pdf-unir-' . Str::uuid();
        $compress = $request->boolean('compress', true);
        $quality  = $request->input('quality', 'recommended');

        try {
            mkdir($tmpDir, 0755, true);

            $uploadedFiles = $request->file('files');
            $uploadedFile  = reset($uploadedFiles);
            if (!$uploadedFile) {
                $this->cleanup($tmpDir);
                return response()->json(['error' => 'No se encontró el archivo combinado.'], 422);
            }

            $uploadedPath = $tmpDir . '/combined.pdf';
            $uploadedFile->move($tmpDir, basename($uploadedPath));
            $originalSize = $uploadedFile->getSize() ?? filesize($uploadedPath);

            $finalBytes = file_get_contents($uploadedPath);
            if ($compress) {
                $finalBytes = $this->compressPdf($uploadedPath, $tmpDir, $quality);
            }

            $finalSize = strlen($finalBytes);
            $saved     = $originalSize - $finalSize;
            $savedPct  = $originalSize > 0 ? round(($saved / $originalSize) * 100) : 0;

            $response = response($finalBytes, 200, [
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="combinado.pdf"',
                'X-Original-Size'       => $originalSize,
                'X-Final-Size'          => $finalSize,
                'X-Saved-Percent'       => $savedPct,
                'Access-Control-Expose-Headers' => 'X-Original-Size,X-Final-Size,X-Saved-Percent',
            ]);

            app()->terminating(function () use ($tmpDir) {
                $this->cleanup($tmpDir);
            });

            return $response;

        } catch (\Ilovepdf\Exceptions\AuthException $e) {
            $this->cleanup($tmpDir);
            return response()->json(['error' => 'Claves de iLovePDF inválidas. Revisa tu .env'], 401);
        } catch (\Ilovepdf\Exceptions\UploadException $e) {
            $this->cleanup($tmpDir);
            return response()->json(['error' => 'Error al subir archivos a iLovePDF: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            $this->cleanup($tmpDir);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // ── Extrae PDFs de archivos subidos (incluyendo ZIPs) ──────────
    private function extractPdfs(array $files, string $tmpDir): array
    {
        $pdfPaths = [];

        foreach ($files as $file) {
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext === 'pdf') {
                $dest = $tmpDir . '/' . Str::uuid() . '.pdf';
                $file->move($tmpDir, basename($dest));
                $pdfPaths[] = $tmpDir . '/' . basename($dest);

            } elseif ($ext === 'zip') {
                $zipPath = $tmpDir . '/' . Str::uuid() . '.zip';
                $file->move($tmpDir, basename($zipPath));

                $zip = new \ZipArchive();
                if ($zip->open($tmpDir . '/' . basename($zipPath)) === true) {
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $name = $zip->getNameIndex($i);
                        if (strtolower(pathinfo($name, PATHINFO_EXTENSION)) === 'pdf') {
                            $outName = $tmpDir . '/' . Str::uuid() . '_' . basename($name);
                            file_put_contents($outName, $zip->getFromIndex($i));
                            $pdfPaths[] = $outName;
                        }
                    }
                    $zip->close();
                }
            }
        }

        // Ordenar por nombre original para mantener orden consistente
        sort($pdfPaths);
        return $pdfPaths;
    }

    // ── Une PDFs con iLovePDF ──────────────────────────────────────
    private function mergePdfs(array $pdfPaths, string $tmpDir): string
    {
        // Si solo hay un PDF, no hace falta unir
        if (count($pdfPaths) === 1) {
            return $pdfPaths[0];
        }

        $ilovepdf = new Ilovepdf($this->publicKey, $this->secretKey);
        $task     = $ilovepdf->newTask('merge');

        foreach ($pdfPaths as $path) {
            $task->addFile($path);
        }

        $task->execute();
        $mergedBytes = $task->blob();

        $mergedPath = $this->writeTempFile($tmpDir, $mergedBytes, 'merged_');
        return $mergedPath;
    }

    // ── Comprime un PDF con iLovePDF ───────────────────────────────
    private function compressPdf(string $pdfPath, string $tmpDir, string $quality): string
    {
        $ilovepdf = new Ilovepdf($this->publicKey, $this->secretKey);
        $task     = $ilovepdf->newTask('compress');

        $task->addFile($pdfPath);
        $task->setCompressionLevel($quality); // 'low' | 'recommended' | 'extreme'

        $task->execute();
        return $task->blob();
    }

    private function writeTempFile(string $dir, string $contents, string $prefix = 'tmp_'): string
    {
        $tempPath = tempnam($dir, $prefix);
        if ($tempPath === false) {
            throw new \RuntimeException('No se pudo crear un archivo temporal.');
        }
        file_put_contents($tempPath, $contents);
        return $tempPath;
    }

    // ── Busca el PDF más reciente descargado en el directorio ──────
    private function findDownloadedPdf(string $dir, array $exclude): ?string
    {
        $excludeBasenames = array_map('basename', $exclude);
        $files = glob($dir . '/*.pdf');

        if (empty($files)) return null;

        // Filtrar los que ya existían antes
        $newFiles = array_filter($files, fn($f) => !in_array(basename($f), $excludeBasenames));

        if (empty($newFiles)) {
            // Si no hay nuevos, coger el más reciente
            usort($files, fn($a, $b) => filemtime($b) - filemtime($a));
            return $files[0] ?? null;
        }

        usort($newFiles, fn($a, $b) => filemtime($b) - filemtime($a));
        return array_values($newFiles)[0];
    }

    // ── Limpia el directorio temporal ──────────────────────────────
    private function cleanup(string $dir): void
    {
        if (is_dir($dir)) {
            array_map('unlink', glob($dir . '/*'));
            rmdir($dir);
        }
    }
}
