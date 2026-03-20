<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;


class CsvToExcelController extends Controller
{
    public function convert(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $lines = file($path);

        $lines = array_map(function ($line) {
            return mb_convert_encoding($line, 'UTF-8', 'Windows-1252');
        }, $lines);

        // ---- 1. EXTRAEMOS PRIMERA LÍNEA DE DATOS (línea 1 de $lines, no headers textuales) ----
        $headerCols = str_getcsv($lines[1], ';');

        // CABECERA CLIENTE, OFERTA & PROYECTO
        $customer    = $headerCols[11] ?? '';
        $address     = $headerCols[12] ?? '';
        $cp          = $headerCols[13] ?? '';
        $city        = $headerCols[14] ?? '';
        $province    = $headerCols[15] ?? '';
        $phone       = $headerCols[16] ?? '';
        $email       = $headerCols[17] ?? '';
        $offerNumber = $headerCols[18] ?? '';
        $date        = $headerCols[19] ?? '';
        $title       = $headerCols[20] ?? '';
        $proyecto    = $headerCols[21] ?? '1';
        $baseImpBruto   = $headerCols[22] ?? '';
        $dtoAdicional   = $headerCols[23] ?? '';
        $importeDto     = $headerCols[24] ?? '';
        $baseImp        = $headerCols[25] ?? '';
        $total          = $headerCols[26] ?? '';
        $impuesto       = $headerCols[27] ?? '';
        $formaPago      = $headerCols[28] ?? '';

        // ---- 2. DEFINIMOS DATOS DE EMPRESA Y LOGO SEGÚN PROYECTO ----
        switch ($proyecto) {
            case 1:
                $empresaDatos = [
                    "PS POOL EQUIPMENT SL",
                    "POL. IND. PLA DE TEROL",
                    "C/ ZEUS 43",
                    "03520 - POLOP (ALICANTE)",
                    "TLF: 96 686 68 15",
                    "e-mail: info@ps-pool.com",
                    "web: ps-pool.com"
                ];
                $logoPath = public_path('storage/logo/pspool.png');
                break;
            case 50:
                $empresaDatos = [
                    "PS POOL AUTOMATIC COVER SL",
                    "POL IND. LA ALBERCA",
                    "AVD. DE BENIDORM Nº 12",
                    "03530 - LA NUCIA (ALICANTE)",
                    "TLF: 96 686 68 15",
                    "e-mail: info@ps-cover.com",
                    "web: ps-cover.com"
                ];
                $logoPath = public_path('storage/logo/pscover.png');
                break;
            case 51:
                $empresaDatos = [
                    "PS WATER SYSTEM",
                    "POL. IND. PLA DE TEROL",
                    "C/ ZEUS 43",
                    "03520 - POLOP (ALICANTE)",
                    "TLF: 96 686 68 15",
                    "e-mail: info@ps-water.com",
                    "web: ps-water.es"
                ];
                $logoPath = public_path('storage/logo/pswater.jpg');
                break;
            default:
                $empresaDatos = [
                    "PS POOL EQUIPMENT SL",
                    "POL. IND. PLA DE TEROL",
                    "C/ ZEUS 43",
                    "03520 - POLOP (ALICANTE)",
                    "TLF: 96 686 68 15",
                    "e-mail: info@ps-pool.com",
                    "web: ps-pool.com"
                ];
                $logoPath = public_path('storage/logo/pspool.png');
        }

        // ---- 3. PREPARAMOS EL HEADER DE EXCEL (B3-B10, E3:G11, B13:H13) ----

        $headerRows = [];
        // Filas 1 y 2 vacías (espacio para logo si quieres que sobresalga)
        $headerRows[] = ['', '', '', '', '', '', ''];
        $headerRows[] = ['', '', '', '', '', '', ''];
        $headerRows[] = ['', '', '', '', '', '', ''];
        $headerRows[] = ['', '', '', '', '', '', ''];
        $headerRows[] = ['', '', '', '', '', '', ''];


        // Filas 3 a 10: EMPRESA (columna B, índice 1)

        $headerRows[] = ['', $empresaDatos[0], '', 'FECHA ' .        $date,         '', '', ''];
        $headerRows[] = ['', $empresaDatos[1] . ' - ' . $empresaDatos[2], '', 'OFERTA PTO- ' . $offerNumber,  '', ''];
        $headerRows[] = ['', $empresaDatos[3], '', $customer,     '',            '', ''];
        $headerRows[] = ['', $empresaDatos[4], '', $address,      '',            '', ''];
        $headerRows[] = ['', $empresaDatos[5], '', $cp . ' - ' . $city . '(' . strtoupper($province) . ')', '',      '', ''];
        $headerRows[] = ['', $empresaDatos[6], '', 'TLF: ' . $phone, '',    '', ''];
        $headerRows[] = ['', '', '', 'E-MAIL: ' . $email,      '',    '', ''];

        $headerRows[] = ['', '', '', '', '', '', ''];
        // Fila TITULO oferta (merge B21:H21) - AJUSTA SI CAMBIAS EL NÚMERO DE FILAS HEADER
        $headerRows[] = [$title, '', '', '', '', '', ''];

        $headerRows[] = ['Nº', 'Código', 'Descripción', 'U', 'Precio', 'Dto', 'Total'];
        // ---- 4. PROCESADO DEL RESTO DE ARTÍCULOS ----
        $data = [];
        $lastSubcuenta = null;

        for ($i = 1; $i < count($lines); $i++) { // IMPORTANTE: ahora los datos empiezan en $lines[2]
            $row = str_getcsv($lines[$i], ';');

            [$linea, $codigo, $descripcion, $comentario, $cantidad, $pvp, $dto, $importe, $subcuenta, $descripcion_subcuenta] = array_pad($row, 10, '');

            // Normalizar valores
            $pvp = str_replace(',', '.', $pvp);
            $importe = str_replace(',', '.', $importe);
            $pvp = is_numeric($pvp) ? (float) $pvp : 0;
            $importe = is_numeric($importe) ? (float) $importe : 0;
            $dto = $this->normalizarPorcentaje($dto);

            // Visual separation for subaccount changes
            if ($lastSubcuenta !== null && $subcuenta !== $lastSubcuenta) {
                $data[] = ['', '', '', '', '', '', ''];
            }

            // Subaccount row
            if (!empty($subcuenta) && $subcuenta !== $lastSubcuenta) {
                $data[] = ['', '', "SUBCUENTA - $descripcion_subcuenta", '', '', '', ''];
            }

            $comentario = trim($comentario); // elimina espacios al inicio y final
            $comentario = preg_replace('/\s+/', ' ', $comentario); // convierte múltiples espacios, tabs y saltos de línea en un solo espacio
            // Main row
            $data[] = [$linea, $codigo, $descripcion, $cantidad, $pvp, $dto, $importe];

            if (!empty($comentario)) {
                $data[] = ['', '', $comentario, '', '', '', ''];
            }

            $lastSubcuenta = $subcuenta ?: null;
        }

        $baseImpBruto = str_replace(',', '.', $baseImpBruto);
        $dtoAdicional = str_replace(',', '.', $dtoAdicional);
        $dtoAdicional = $this->normalizarPorcentaje($dtoAdicional);
        $importeDto     = str_replace(',', '.', $importeDto);
        $baseImp        = str_replace(',', '.', $baseImp);
        $total          = str_replace(',', '.', $total);
        $impuesto = is_numeric($impuesto) ? floatval($impuesto) / 100 : floatval($impuesto);
        $formaPago = empty($formaPago) ? 'TRANSFERENCIA BANCO SANTANDER  ES52 0049-5944-11-2216050726' : $formaPago;
        $partes = preg_split('/\s{2,}/', trim($formaPago));
        $desFormapago = $partes[0];
        $cuentaFormapago = $partes[1];

        $data[] = ['', '', '', '', '', '', ''];
        $data[] = ['', 'Condiciones de pago', '', '', 'Precio bruto ', '', $baseImpBruto];
        $data[] = ['', $desFormapago, '', '', 'Dto adicional %', '', $dtoAdicional];
        $data[] = ['', $cuentaFormapago, '', '', 'Base imponible', '', $baseImp];
        $data[] = ['', '', '', '', 'IVA %', '', $impuesto];
        $data[] = ['', '', '', '', 'Total', '', $total];



        // ---- 5. UNIMOS HEADER + ARTÍCULOS Y GENERAMOS EXPORT ----
        $dataConCabecera = array_merge($headerRows, $data);
        $footerStartRow = count($dataConCabecera) - 5 + 1; // el bloque footer tiene 5 filas, asumo según tu ejemplo
        $footerEndRow   = count($dataConCabecera);

        $export = new class($dataConCabecera, count($headerRows), $logoPath, $footerStartRow, $footerEndRow) implements FromArray, WithStyles, WithEvents, WithDrawings {
            protected $rows;
            protected $headerRowsCount;
            protected $logoPath;
            protected $footerStartRow;
            protected $footerEndRow;

            public function __construct(array $rows, $headerRowsCount, $logoPath, $footerStartRow, $footerEndRow)
            {
                $this->rows = $rows;
                $this->headerRowsCount = $headerRowsCount;
                $this->logoPath = $logoPath;
                $this->footerStartRow = $footerStartRow;
                $this->footerEndRow   = $footerEndRow;
            }

            public function array(): array
            {
                return $this->rows;
            }

            public function drawings()
            {
                $drawing = new Drawing();
                $drawing->setName('Logo Empresa');
                $drawing->setDescription('Logo');
                $drawing->setPath($this->logoPath); // Path ABSOLUTO
                $drawing->setHeight(60); // Ajusta la altura según el logo
                $drawing->setCoordinates('B3'); // Celda de inicio en la hoja
                return [$drawing];
            }

            public function styles(Worksheet $sheet)
            {
                // Sólo establece estilos mediante getStyle en el evento AfterSheet
                // Aquí lo dejamos vacío si solo quieres usar AfterSheet para formato
                return [];
            }

            public function registerEvents(): array
            {
                return [
                    AfterSheet::class => function (AfterSheet $event) {
                        $sheet = $event->sheet->getDelegate();

                        // --- Ajuste columnas y cabecera ---
                        $sheet->getColumnDimension('B')->setWidth(8); // Para empresa/logo
                        $sheet->getColumnDimension('C')->setWidth(12); // Nº/Código
                        $sheet->getColumnDimension('D')->setWidth(12);
                        $sheet->getColumnDimension('E')->setWidth(12);
                        $sheet->getColumnDimension('C')->setWidth(90); // Descripción amplia
                        $sheet->getColumnDimension('E')->setWidth(15);
                        $sheet->getColumnDimension('G')->setWidth(15);

                        // --- Merges y Formatos específicos ---

                        // Cabecera cliente (zona E11-G19, pero solo algunas filas están rellenas!)
                        for ($row = 6; $row <= 13; $row++) {
                            $sheet->mergeCells("D{$row}:G{$row}");
                            $sheet->getStyle("D{$row}:G{$row}")->getAlignment()->setHorizontal('left');
                        }

                        // Etiquetas destacadas (DATE y OFFER NUMBER), sólo borde celda valor!
                        $sheet->getStyle('D6:G6')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                        $sheet->getStyle('D7:G7')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                        //Cabecera
                        $sheet->getStyle('A2:G13')->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                        $sheet->getStyle('A2:G13')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THICK);
                        $sheet->getStyle('A2:G13')->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THICK);
                        $sheet->getStyle('A2:G13')->getBorders()->getRight()->setBorderStyle(Border::BORDER_THICK);

                        // Ejemplo dinámico:
                        $footerStart = $this->footerStartRow;
                        $footerEnd   = $this->footerEndRow;

                        // Borde exterior
                        $sheet->getStyle("A{$footerStart}:G{$footerEnd}")->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
                        $sheet->getStyle("A{$footerStart}:G{$footerEnd}")->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THICK);
                        $sheet->getStyle("A{$footerStart}:G{$footerEnd}")->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THICK);
                        $sheet->getStyle("A{$footerStart}:G{$footerEnd}")->getBorders()->getRight()->setBorderStyle(Border::BORDER_THICK);

                        // Merges igual, por fila
                        $sheet->mergeCells("B{$footerStart}:D{$footerStart}");
                        $sheet->mergeCells("B" . ($footerStart + 1) . ":D" . ($footerStart + 1));
                        $sheet->mergeCells("B" . ($footerStart + 2) . ":D" . ($footerStart + 2));

                        // Colores dinámicos
                        $sheet->getStyle("B{$footerStart}:D{$footerStart}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setRGB('808080');
                        $sheet->getStyle("B{$footerStart}:D{$footerStart}")->getFont()->getColor()->setRGB('FFFFFF');
                        $sheet->getStyle("G{$footerEnd}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setRGB('FFFF66');
                        $sheet->getStyle("G{$footerEnd}")->getFont()->setBold(true)->setSize(14);

                        // Formato (ajusta índices según corresponda tu footer)
                        $sheet->getStyle("G{$footerStart}")->getNumberFormat()->setFormatCode('#,##0.00 €');
                        $sheet->getStyle("G" . ($footerStart + 1))->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
                        $sheet->getStyle("G" . ($footerStart + 2))->getNumberFormat()->setFormatCode('#,##0.00 €');
                        $sheet->getStyle("G" . ($footerStart + 3))->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
                        $sheet->getStyle("G" . ($footerStart + 4))->getNumberFormat()->setFormatCode('#,##0.00 €');

                        // Mergeo título (Ajusta fila si cambias número de headerRows!!)
                        $tituloFila = 14; // ¡modifica este valor si agregas/quitas filas al header!
                        $sheet->mergeCells("A{$tituloFila}:G{$tituloFila}");
                        $sheet->getStyle("A{$tituloFila}:G{$tituloFila}")->getAlignment()->setHorizontal('center');
                        $sheet->getStyle("A{$tituloFila}:G{$tituloFila}")->getFont()->setBold(true)->setSize(12);
                        $sheet->getStyle("A{$tituloFila}:G{$tituloFila}")->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setRGB('1899B4');

                        $tituloFila2 = 15;
                        $sheet->getStyle("A{$tituloFila2}:G{$tituloFila2}")->getAlignment()->setHorizontal('center');
                        $sheet->getStyle("A{$tituloFila2}:G{$tituloFila2}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setRGB('005EBC');
                        $sheet->getStyle("A{$tituloFila2}:G{$tituloFila2}")->getFont()->getColor()->setRGB('FFFFFF');
                        $sheet->getStyle("A{$tituloFila2}:G{$tituloFila2}")->getFont()->setBold(true)->setSize(12);

                        // Artículos empiezan después de la cabecera (ajusta posición si cambian filas header)
                        $firstRowProduct = $this->headerRowsCount + 1;

                        $startBlock = null;
                        foreach ($this->rows as $i => $row) {
                            $rowIndex = $i + 1;
                            if ($rowIndex < $firstRowProduct) continue;

                            // SUBCUENTA (merge A-G, gris claro)
                            if (isset($row[2]) && str_starts_with($row[2], 'SUBCUENTA')) {
                                $sheet->mergeCells("A{$rowIndex}:G{$rowIndex}");
                                $sheet->setCellValue("A{$rowIndex}", $row[2]);
                                $sheet->getStyle("A{$rowIndex}:G{$rowIndex}")->getFont()->setBold(true);
                                $sheet->getStyle("A{$rowIndex}:G{$rowIndex}")->getFill()
                                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                    ->getStartColor()->setRGB('D9D9D9');
                                $startBlock = $rowIndex;
                            }

                            // Comentario descripción (wrap)
                            if (isset($row[0]) && $row[0] === '' && isset($row[2]) && !str_starts_with($row[2], 'SUBCUENTA')) {
                                $sheet->getStyle("C{$rowIndex}")->getAlignment()->setWrapText(true);
                            }

                            // Formato de moneda y porcentaje
                            if (
                                isset($row[0]) && $row[0] !== '' &&
                                isset($row[4]) && $row[4] !== ''
                            ) {
                                $sheet->getStyle("E{$rowIndex}")
                                    ->getNumberFormat()
                                    ->setFormatCode('#,##0.00 €');
                                $sheet->getStyle("F{$rowIndex}")
                                    ->getNumberFormat()
                                    ->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
                                $sheet->getStyle("G{$rowIndex}")
                                    ->getNumberFormat()
                                    ->setFormatCode('#,##0.00 €');
                            }

                            // Bordes por bloque de subcuenta, si necesitas:
                            if ($startBlock !== null) {
                                $sheet->getStyle("A{$rowIndex}:G{$rowIndex}")
                                    ->getBorders()
                                    ->getTop()
                                    ->setBorderStyle(Border::BORDER_THIN);
                                $sheet->getStyle("A{$rowIndex}:G{$rowIndex}")
                                    ->getBorders()
                                    ->getBottom()
                                    ->setBorderStyle(Border::BORDER_THIN);
                                $sheet->getStyle("A{$rowIndex}:G{$rowIndex}")
                                    ->getBorders()
                                    ->getLeft()
                                    ->setBorderStyle(Border::BORDER_THIN);
                                $sheet->getStyle("A{$rowIndex}:G{$rowIndex}")
                                    ->getBorders()
                                    ->getRight()
                                    ->setBorderStyle(Border::BORDER_THIN);
                            }

                            $nextRow = $this->rows[$i + 1] ?? null;
                            $isEndOfBlock = $startBlock !== null && (
                                $nextRow === null ||
                                (isset($nextRow[2]) && str_starts_with($nextRow[2], 'SUBCUENTA')) ||
                                (isset($nextRow[0]) && $nextRow[0] === '' && empty($nextRow[2]))
                            );
                            if ($isEndOfBlock) {
                                $startBlock = null;
                            }
                        }
                    }
                ];
            }
        };

        $formatDate =  str_replace('/', '_', $date);
        $documentName = 'Presupuesto PTO-' . $offerNumber . ' ' . $customer . ' ' . $formatDate . '.xlsx';
        return Excel::download($export, $documentName);
    }


    function normalizarPorcentaje($valor)
    {
        $valor = str_replace(',', '.', $valor);
        return is_numeric($valor) ? floatval($valor) / 100 : 0.0;
    }
}
