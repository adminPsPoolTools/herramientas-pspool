<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PoolNeonLedController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('poolneonled.index', compact('user'));
    }

    public function calcular(Request $request)
    {
        $validated = $request->validate([
            'color' => 'required|in:rgbw,blanco',
            'perfil' => 'required|in:normal,con_solapa,flexible',
            'mando' => 'required|string|max:50',
            'articulos_base_json' => 'required|string',
            'transformador' => 'nullable|in:si,no',
            'cantidad_tiras' => 'nullable|integer|min:1',
            'calculos_tiras_json' => 'nullable|string',
            'tipos_salida_tiras_json' => 'nullable|string',
            'transformadores_seleccionados_json' => 'nullable|string',
        ]);

        $articulosBaseRecibidos = json_decode($validated['articulos_base_json'], true);
        if (!is_array($articulosBaseRecibidos)) {
            return response()->json([
                'ok' => false,
                'error' => 'El campo articulos_base_json no tiene un JSON valido.',
            ], 422);
        }

        $articulosBaseEsperados = $this->buildBaseArticlesFromSelection(
            $validated['color'],
            $validated['perfil'],
            $validated['mando']
        );

        if (count($articulosBaseEsperados) === 0) {
            return response()->json([
                'ok' => false,
                'error' => 'No hay articulos base para consultar con la seleccion actual.',
            ], 422);
        }

        $apiUser = env('POOLNEONLED_API_USER');
        $apiPassword = env('POOLNEONLED_API_PASSWORD');
        if (empty($apiUser) || empty($apiPassword)) {
            return response()->json([
                'ok' => false,
                'error' => 'Faltan POOLNEONLED_API_USER o POOLNEONLED_API_PASSWORD en el entorno.',
            ], 500);
        }

        $stockEndpoint = env('POOLNEONLED_STOCK_ENDPOINT', env('POOLNEONLED_ENDPOINT', env('POOLNEONLED_API_URL')));
        if (empty($stockEndpoint)) {
            return response()->json([
                'ok' => false,
                'error' => 'Falta configurar POOLNEONLED_STOCK_ENDPOINT (o POOLNEONLED_ENDPOINT) en el entorno.',
            ], 500);
        }

        try {
            $timeout = (int) env('POOLNEONLED_API_TIMEOUT', 20);
            $calculosTiras = json_decode((string) data_get($validated, 'calculos_tiras_json', '[]'), true);
            if (!is_array($calculosTiras)) {
                return response()->json([
                    'ok' => false,
                    'error' => 'El campo calculos_tiras_json no tiene un JSON valido.',
                ], 422);
            }
            $tiposSalidaTiras = json_decode((string) data_get($validated, 'tipos_salida_tiras_json', '[]'), true);
            if (!is_array($tiposSalidaTiras)) {
                return response()->json([
                    'ok' => false,
                    'error' => 'El campo tipos_salida_tiras_json no tiene un JSON valido.',
                ], 422);
            }
            $salidasTirasNormalizadas = $this->normalizeStripOutputSelections($tiposSalidaTiras);
            $articulosTipoSalida = $this->buildOutputTypeArticles($salidasTirasNormalizadas);
            foreach ($articulosTipoSalida as $articuloTipoSalida) {
                $articulosBaseEsperados[] = $articuloTipoSalida;
            }

            $totalMetrosCalculados = $this->resolveTotalMeters($calculosTiras);
            $outputStats = $this->resolveStripOutputStats($calculosTiras);
            $totalSalidasCalculadas = $this->resolveTotalOutputs($calculosTiras);
            if ($totalSalidasCalculadas > 0) {
                $articulosBaseEsperados[] = [
                    'codigo' => '28835',
                    'origen' => 'salidas',
                    'valor' => 'salidas_totales',
                    'cantidad' => $totalSalidasCalculadas,
                ];
            }
            if ((int) data_get($outputStats, 'one_side_strips', 0) > 0 && (int) data_get($outputStats, 'two_side_strips', 0) === 0) {
                $articulosBaseEsperados[] = [
                    'codigo' => '28851',
                    'origen' => 'salida_unica',
                    'valor' => 'tira_1_salida',
                    'cantidad' => (int) data_get($outputStats, 'one_side_strips', 0),
                ];
            }

            $transformadorSeleccionado = strtolower((string) data_get($validated, 'transformador', 'no'));
            if ($transformadorSeleccionado === 'si') {
                $wPorMetro = $validated['color'] === 'rgbw' ? 17.0 : 12.0;
                $wattsNecesarios = (int) ceil($totalMetrosCalculados * $wPorMetro);
                $transformadoresSeleccionados = json_decode((string) data_get(
                    $validated,
                    'transformadores_seleccionados_json',
                    '[]'
                ), true);

                if (!is_array($transformadoresSeleccionados)) {
                    return response()->json([
                        'ok' => false,
                        'error' => 'El campo transformadores_seleccionados_json no tiene un JSON valido.',
                    ], 422);
                }

                $transformadores = $this->normalizeSelectedTransformers($transformadoresSeleccionados);
                if (count($transformadores) === 0) {
                    $transformadores = $this->buildTransformerArticles($wattsNecesarios);
                }

                foreach ($transformadores as $transformador) {
                    $articulosBaseEsperados[] = [
                        'codigo' => (string) data_get($transformador, 'codigo'),
                        'origen' => 'transformador',
                        'valor' => 'transformador_auto',
                        'cantidad' => (float) data_get($transformador, 'cantidad', 1),
                    ];
                }
            }

            $yaTieneReferenciaFinal = collect($articulosBaseEsperados)->contains(function ($item) {
                return (string) data_get($item, 'codigo') === '28892';
            });
            if (!$yaTieneReferenciaFinal) {
                $articulosBaseEsperados[] = [
                    'codigo' => '28892',
                    'origen' => 'final_obligatorio',
                    'valor' => 'referencia_final',
                    'cantidad' => 1,
                ];
            }

            $articulosConPrecio = [];
            $resultadoSalida = [];
            $totalResultado = 0.0;
            foreach ($articulosBaseEsperados as $articuloBase) {
                $codigoArticulo = (string) data_get($articuloBase, 'codigo', '');
                if ($codigoArticulo === '') {
                    continue;
                }

                $stockLookup = $this->fetchStockByCode(
                    $stockEndpoint,
                    $codigoArticulo,
                    $apiUser,
                    $apiPassword,
                    $timeout
                );

                $precioUnitario = $this->extractUnitPrice([], $stockLookup);
                $descripcion = $this->extractDescriptionFromStockLookup($stockLookup, $codigoArticulo);
                if (in_array($codigoArticulo, ['28830', '28831'], true)) {
                    $uds = $totalMetrosCalculados;
                } elseif (in_array($codigoArticulo, ['28832', '28833', '36229'], true)) {
                    $uds = (float) ceil($totalMetrosCalculados);
                } elseif ($codigoArticulo === '28835') {
                    $uds = (float) $totalSalidasCalculadas;
                } else {
                    $uds = (float) data_get($articuloBase, 'cantidad', 1.0);
                }
                $totalLinea = is_null($precioUnitario) ? null : round($uds * $precioUnitario, 2);
                if (!is_null($totalLinea)) {
                    $totalResultado += $totalLinea;
                }

                $articulosConPrecio[] = [
                    'codigo' => $codigoArticulo,
                    'origen' => data_get($articuloBase, 'origen'),
                    'valor' => data_get($articuloBase, 'valor'),
                    'precio_unitario' => $precioUnitario,
                    'stock_lookup' => $stockLookup,
                ];

                $resultadoSalida[] = [
                    'ref' => $codigoArticulo,
                    'descripcion' => $descripcion,
                    'uds' => $this->normalizeUnits($uds),
                    'precio' => $precioUnitario,
                    'total' => $totalLinea,
                ];
            }

            return response()->json([
                'ok' => true,
                // 'resumen' => [
                //     'color' => $validated['color'],
                //     'perfil' => $validated['perfil'],
                //     'mando' => $validated['mando'],
                //     'transformador' => data_get($validated, 'transformador'),
                // ],
                //'articulos_base_recibidos' => array_values($articulosBaseRecibidos),
                //'articulos_base_esperados' => $articulosBaseEsperados,
                //'articulos_precio_unitario' => $articulosConPrecio,
                //'metros_totales_calculados' => $this->normalizeUnits($totalMetrosCalculados),
                'resultado_salida' => $resultadoSalida,
                'salidas_tiras' => $salidasTirasNormalizadas,
                'totales_resultado' => [
                    'total' => round($totalResultado, 2),
                ],
                // 'codigos_consultados' => array_values(array_map(function ($item) {
                //     return data_get($item, 'codigo');
                // }, $articulosConPrecio)),
            ]);
        } catch (\Throwable $e) {
            Log::error('Excepcion en API PoolNeonLed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'ok' => false,
                'error' => 'No se pudo conectar con la API de articulos.',
            ], 500);
        }
    }

    private function buildBaseArticlesFromSelection(string $color, string $perfil, string $mando): array
    {
        $articles = [];

        if ($color === 'rgbw') {
            $articles[] = [
                'codigo' => '28830',
                'origen' => 'color',
                'valor' => 'rgbw',
            ];
        } elseif ($color === 'blanco') {
            $articles[] = [
                'codigo' => '28831',
                'origen' => 'color',
                'valor' => 'blanco',
            ];
        }

        if ($perfil === 'normal') {
            $articles[] = [
                'codigo' => '28832',
                'origen' => 'perfil',
                'valor' => 'normal',
            ];
        } elseif ($perfil === 'con_solapa') {
            $articles[] = [
                'codigo' => '28833',
                'origen' => 'perfil',
                'valor' => 'con_solapa',
            ];
        } elseif ($perfil === 'flexible') {
            $articles[] = [
                'codigo' => '36229',
                'origen' => 'perfil',
                'valor' => 'flexible',
            ];
        }

        if (strtolower($mando) === 'mando') {
            $articles[] = [
                'codigo' => '28837',
                'origen' => 'control',
                'valor' => 'mando_fijo',
            ];

            if ($color === 'rgbw') {
                $articles[] = [
                    'codigo' => '28839',
                    'origen' => 'control',
                    'valor' => 'mando_rgbw',
                ];
            } elseif ($color === 'blanco') {
                $articles[] = [
                    'codigo' => '28838',
                    'origen' => 'control',
                    'valor' => 'mando_blanco',
                ];
            }
        } elseif (strtolower($mando) === 'dmx') {
            $articles[] = [
                'codigo' => '28842',
                'origen' => 'control',
                'valor' => 'dmx_fijo',
            ];

            if ($color === 'rgbw') {
                $articles[] = [
                    'codigo' => '28841',
                    'origen' => 'control',
                    'valor' => 'dmx_rgbw',
                ];
            } elseif ($color === 'blanco') {
                $articles[] = [
                    'codigo' => '28840',
                    'origen' => 'control',
                    'valor' => 'dmx_blanco',
                ];
            }
        } elseif (strtolower($mando) === 'knx') {
            $articles[] = [
                'codigo' => '28843',
                'origen' => 'control',
                'valor' => 'knx_fijo',
            ];
        } elseif (strtolower($mando) === 'wifi') {
            $articles[] = [
                'codigo' => '28844',
                'origen' => 'control',
                'valor' => 'wifi_fijo',
            ];
        }

        return array_values($articles);
    }

    private function resolveTotalMeters(array $calculosTiras): float
    {
        $total = 0.0;
        foreach ($calculosTiras as $fila) {
            if (!is_array($fila)) {
                continue;
            }

            $metrosAjustados = $this->parseNumeric(data_get($fila, 'metros_reales_ajustados'));
            $metrosOriginales = $this->parseNumeric(data_get($fila, 'metros'));
            $metros = !is_null($metrosAjustados) ? $metrosAjustados : $metrosOriginales;
            if (!is_null($metros) && $metros > 0) {
                $total += $metros;
            }
        }

        return round($total, 2);
    }

    private function resolveTotalOutputs(array $calculosTiras): int
    {
        $total = 0;
        foreach ($calculosTiras as $fila) {
            if (!is_array($fila)) {
                continue;
            }

            $tipoAlimentacion = strtolower(trim((string) data_get($fila, 'tipo_alimentacion', '')));
            if ($tipoAlimentacion === '') {
                continue;
            }

            if (str_contains($tipoAlimentacion, '2')) {
                $total += 2;
            } elseif (str_contains($tipoAlimentacion, '1')) {
                $total += 1;
            }
        }

        return $total;
    }

    private function resolveStripOutputStats(array $calculosTiras): array
    {
        $oneSide = 0;
        $twoSide = 0;

        foreach ($calculosTiras as $fila) {
            if (!is_array($fila)) {
                continue;
            }
            if (strtolower((string) data_get($fila, 'estado', 'ok')) === 'error') {
                continue;
            }

            $tipoAlimentacion = strtolower(trim((string) data_get($fila, 'tipo_alimentacion', '')));
            if ($tipoAlimentacion === '') {
                continue;
            }

            if (str_contains($tipoAlimentacion, '2')) {
                $twoSide++;
            } elseif (str_contains($tipoAlimentacion, '1')) {
                $oneSide++;
            }
        }

        return [
            'one_side_strips' => $oneSide,
            'two_side_strips' => $twoSide,
        ];
    }

    private function normalizeStripOutputSelections(array $tiposSalidaTiras): array
    {
        $result = [];
        foreach ($tiposSalidaTiras as $item) {
            if (!is_array($item)) {
                continue;
            }

            $tira = (int) data_get($item, 'tira', 0);
            if ($tira < 1) {
                continue;
            }

            $numeroSalidas = (int) data_get($item, 'numero_salidas', 1);
            if ($numeroSalidas < 1) {
                $numeroSalidas = 1;
            }
            if ($numeroSalidas > 2) {
                $numeroSalidas = 2;
            }

            $left = trim((string) data_get($item, 'tipo_salida_izquierda', data_get($item, 'tipo_salida', '')));
            $right = trim((string) data_get($item, 'tipo_salida_derecha', ''));

            $result[] = [
                'tira' => $tira,
                'numero_salidas' => $numeroSalidas,
                'tipo_salida_izquierda' => $left !== '' ? $left : null,
                'tipo_salida_derecha' => $numeroSalidas === 2 && $right !== '' ? $right : null,
            ];
        }

        return $result;
    }

    private function buildOutputTypeArticles(array $salidasTirasNormalizadas): array
    {
        $mapaSalidaCodigo = [
            'A' => '28847',
            'B' => '28848',
            'C' => '28849',
            'D' => '28850',
            'E' => '28846',
        ];

        $acumuladoPorCodigo = [];
        foreach ($salidasTirasNormalizadas as $salidaTira) {
            if (!is_array($salidaTira)) {
                continue;
            }

            $tipos = [
                strtoupper(trim((string) data_get($salidaTira, 'tipo_salida_izquierda', ''))),
                strtoupper(trim((string) data_get($salidaTira, 'tipo_salida_derecha', ''))),
            ];

            foreach ($tipos as $tipo) {
                if ($tipo === '' || !isset($mapaSalidaCodigo[$tipo])) {
                    continue;
                }

                $codigo = $mapaSalidaCodigo[$tipo];
                if (!isset($acumuladoPorCodigo[$codigo])) {
                    $acumuladoPorCodigo[$codigo] = 0;
                }
                $acumuladoPorCodigo[$codigo] += 1;
            }
        }

        $resultado = [];
        foreach ($acumuladoPorCodigo as $codigo => $cantidad) {
            $resultado[] = [
                'codigo' => $codigo,
                'origen' => 'tipo_salida',
                'valor' => 'salida_' . $codigo,
                'cantidad' => $cantidad,
            ];
        }

        return $resultado;
    }

    private function buildTransformerArticles(int $wattsNecesarios): array
    {
        if ($wattsNecesarios <= 0) {
            return [];
        }

        $catalogo = $this->getTransformerCatalog();
        $remaining = $wattsNecesarios;
        $seleccionados = [];

        while ($remaining > 480) {
            $seleccionados[] = '22224';
            $remaining -= 480;
        }

        if ($remaining > 0) {
            $seleccionados[] = $this->findTransformerCodeForPower($remaining, $catalogo);
        }

        $acumulado = [];
        foreach ($seleccionados as $codigo) {
            if (!isset($acumulado[$codigo])) {
                $acumulado[$codigo] = 0;
            }
            $acumulado[$codigo] += 1;
        }

        $resultado = [];
        foreach ($acumulado as $codigo => $cantidad) {
            $resultado[] = [
                'codigo' => $codigo,
                'cantidad' => $cantidad,
            ];
        }

        return $resultado;
    }

    private function findTransformerCodeForPower(int $requiredPower, array $catalogo): string
    {
        foreach ($catalogo as $item) {
            if ((int) data_get($item, 'potencia', 0) >= $requiredPower) {
                return (string) data_get($item, 'codigo');
            }
        }

        return (string) data_get(end($catalogo), 'codigo', '22224');
    }

    private function getTransformerCatalog(): array
    {
        return [
            ['codigo' => '23163', 'potencia' => 10],
            ['codigo' => '22653', 'potencia' => 16],
            ['codigo' => '22192', 'potencia' => 20],
            ['codigo' => '22193', 'potencia' => 35],
            ['codigo' => '22194', 'potencia' => 60],
            ['codigo' => '22190', 'potencia' => 100],
            ['codigo' => '22191', 'potencia' => 150],
            ['codigo' => '22187', 'potencia' => 185],
            ['codigo' => '22188', 'potencia' => 240],
            ['codigo' => '22189', 'potencia' => 320],
            ['codigo' => '22224', 'potencia' => 480],
        ];
    }

    private function normalizeSelectedTransformers(array $selected): array
    {
        $catalogo = $this->getTransformerCatalog();
        $catalogoByCode = [];
        foreach ($catalogo as $item) {
            $catalogoByCode[(string) data_get($item, 'codigo')] = true;
        }

        $acumulado = [];
        foreach ($selected as $item) {
            if (!is_array($item)) {
                continue;
            }

            $codigo = trim((string) data_get($item, 'codigo', ''));
            if ($codigo === '' || !isset($catalogoByCode[$codigo])) {
                continue;
            }

            $cantidad = (int) ceil((float) $this->parseNumeric(data_get($item, 'cantidad', 0)));
            if ($cantidad < 1) {
                continue;
            }

            if (!isset($acumulado[$codigo])) {
                $acumulado[$codigo] = 0;
            }
            $acumulado[$codigo] += $cantidad;
        }

        $resultado = [];
        foreach ($acumulado as $codigo => $cantidad) {
            $resultado[] = [
                'codigo' => $codigo,
                'cantidad' => $cantidad,
            ];
        }

        return $resultado;
    }

    private function fetchStockByCode(string $endpoint, string $code, string $user, string $password, int $timeout): array
    {
        try {
            $baseEndpoint = rtrim($endpoint, '/');
            $stockUrl = str_contains($baseEndpoint, 'consultar_stock.php')
                ? $baseEndpoint
                : $baseEndpoint . '/WebServices/clientes/consultar_stock.php';

            $response = Http::timeout($timeout)
                ->acceptJson()
                ->withBasicAuth($user, $password)
                ->get($stockUrl, ['CODIGO' => $code]);

            if (!$response->successful()) {
                return [
                    'ok' => false,
                    'codigo' => $code,
                    'url' => $stockUrl . '?CODIGO=' . urlencode($code),
                    'status' => $response->status(),
                    'error' => 'Error consultando stock/precio por codigo.',
                    'raw' => $response->body(),
                ];
            }

            $body = $response->body();
            $json = $response->json();
            if (!is_array($json)) {
                $json = $this->decodeJsonPayload($body);
            }
            $data = is_array($json) ? $this->normalizeDecodedPayload($json) : ['raw' => $body];

            return [
                'ok' => true,
                'codigo' => $code,
                'url' => $stockUrl . '?CODIGO=' . urlencode($code),
                'status' => $response->status(),
                'data' => $data,
            ];
        } catch (\Throwable $e) {
            Log::error('Excepcion en consulta de articulo por codigo', [
                'codigo' => $code,
                'message' => $e->getMessage(),
            ]);

            return [
                'ok' => false,
                'codigo' => $code,
                'status' => 0,
                'error' => 'Excepcion consultando stock/precio por codigo.',
            ];
        }
    }

    private function extractArticleCode(array $article): ?string
    {
        $candidateKeys = [
            'codigo',
            'CODIGO',
            'referencia',
            'REFERENCIA',
            'sku',
            'SKU',
            'item',
            'ITEM',
            'articulo',
            'ARTICULO',
        ];

        foreach ($candidateKeys as $key) {
            $value = data_get($article, $key);
            if (!is_null($value) && trim((string) $value) !== '') {
                return trim((string) $value);
            }
        }

        return null;
    }

    private function extractQuantity(array $article): float
    {
        $candidateKeys = ['cantidad', 'qty', 'QTY', 'unidades', 'UNIDADES'];
        foreach ($candidateKeys as $key) {
            $value = data_get($article, $key);
            if (!is_null($value)) {
                $parsed = $this->parseNumeric($value);
                if (!is_null($parsed) && $parsed > 0) {
                    return $parsed;
                }
            }
        }

        return 1.0;
    }

    private function extractUnitPrice(array $article, ?array $stockLookup): ?float
    {
        $articlePrice = $this->findPriceInArray($article);
        if (!is_null($articlePrice)) {
            return $articlePrice;
        }

        if (is_array($stockLookup) && data_get($stockLookup, 'ok') === true) {
            $stockData = data_get($stockLookup, 'data');
            if (is_array($stockData)) {
                $stockPrice = $this->findPriceInArray($stockData);
                if (!is_null($stockPrice)) {
                    return $stockPrice;
                }

                if (array_is_list($stockData) && isset($stockData[0]) && is_array($stockData[0])) {
                    return $this->findPriceInArray($stockData[0]);
                }
            }
        }

        return null;
    }

    private function extractDescriptionFromStockLookup(?array $stockLookup, string $fallbackCode): string
    {
        $fallback = 'Articulo ' . $fallbackCode;

        if (!is_array($stockLookup) || data_get($stockLookup, 'ok') !== true) {
            return $fallback;
        }

        $stockData = data_get($stockLookup, 'data');
        if (!is_array($stockData)) {
            return $fallback;
        }

        $description = $this->findDescriptionInArray($stockData);
        if (!is_null($description)) {
            return $description;
        }

        if (array_is_list($stockData) && isset($stockData[0]) && is_array($stockData[0])) {
            $description = $this->findDescriptionInArray($stockData[0]);
            if (!is_null($description)) {
                return $description;
            }
        }

        return $fallback;
    }

    private function findDescriptionInArray(array $source): ?string
    {
        $candidateKeys = [
            'descripcion',
            'DESCRIPCION',
            'descripcion_larga',
            'DESCRIPCION_LARGA',
            'nombre',
            'NOMBRE',
            'producto',
            'PRODUCTO',
            'articulo',
            'ARTICULO',
        ];

        foreach ($candidateKeys as $key) {
            $value = data_get($source, $key);
            if (is_string($value) && trim($value) !== '') {
                return trim($value);
            }
        }

        foreach ($source as $value) {
            if (is_array($value)) {
                $description = $this->findDescriptionInArray($value);
                if (!is_null($description)) {
                    return $description;
                }
            }
        }

        return null;
    }

    private function findPriceInArray(array $source): ?float
    {
        $candidateKeys = [
            'precio',
            'PRECIO',
            'pvp',
            'PVP',
            'price',
            'PRICE',
            'importe',
            'IMPORTE',
            'tarifa',
            'TARIFA',
            'coste',
            'COSTE',
        ];

        foreach ($candidateKeys as $key) {
            $value = data_get($source, $key);
            $parsed = $this->parseNumeric($value);
            if (!is_null($parsed)) {
                return $parsed;
            }
        }

        foreach ($source as $value) {
            if (is_array($value)) {
                $price = $this->findPriceInArray($value);
                if (!is_null($price)) {
                    return $price;
                }
            }
        }

        return null;
    }

    private function decodeJsonPayload(?string $payload): ?array
    {
        if (is_null($payload)) {
            return null;
        }

        $clean = trim($payload);
        $clean = preg_replace('/^\xEF\xBB\xBF/', '', $clean);
        if (!is_string($clean) || $clean === '') {
            return null;
        }

        $decoded = json_decode($clean, true);
        return is_array($decoded) ? $decoded : null;
    }

    private function normalizeDecodedPayload(array $payload): array
    {
        $normalized = [];
        foreach ($payload as $key => $value) {
            if (is_array($value)) {
                $normalized[$key] = $this->normalizeDecodedPayload($value);
                continue;
            }

            if (is_string($value)) {
                $decoded = $this->decodeJsonPayload($value);
                if (is_array($decoded)) {
                    $normalized[$key] = $this->normalizeDecodedPayload($decoded);
                    continue;
                }
            }

            $normalized[$key] = $value;
        }

        return $normalized;
    }

    private function parseNumeric($value): ?float
    {
        if (is_null($value)) {
            return null;
        }

        if (is_numeric($value)) {
            return (float) $value;
        }

        if (!is_string($value)) {
            return null;
        }

        $normalized = str_replace([' ', 'EUR', '€'], '', $value);

        $hasComma = str_contains($normalized, ',');
        $hasDot = str_contains($normalized, '.');

        if ($hasComma && $hasDot) {
            // Decide decimal separator by whichever appears last.
            $lastComma = strrpos($normalized, ',');
            $lastDot = strrpos($normalized, '.');

            if ($lastComma !== false && $lastDot !== false && $lastComma > $lastDot) {
                // 1.234,56
                $normalized = str_replace('.', '', $normalized);
                $normalized = str_replace(',', '.', $normalized);
            } else {
                // 1,234.56
                $normalized = str_replace(',', '', $normalized);
            }
        } elseif ($hasComma) {
            // 123,45
            $normalized = str_replace(',', '.', $normalized);
        } else {
            // 123.45 or 1234
            $normalized = str_replace(',', '', $normalized);
        }

        return is_numeric($normalized) ? (float) $normalized : null;
    }

    private function normalizeUnits(float $value): float
    {
        return floor($value) == $value ? (float) intval($value) : round($value, 2);
    }
}
