<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlowVisController extends Controller
{
    private $productos = [
        [
            'item' => '18641',
            'descripcion' => 'FlowVis caudalímetro + NRV',
            'dn' => 25,
            'diametro' => 32,
            'caudal_min' => 1.2,
            'caudal_max' => 5.4,
            'url' => 'https://ps-pool.com/tienda/medicion/275-1643-caudalimetros-flowvis.html#/1708-tipo-encolar/1709-conexiones-o_32_mm',
        ],
        [
            'item' => '13400',
            'descripcion' => 'FlowVis caudalímetro + NRV',
            'dn' => 40,
            'diametro' => 50,
            'caudal_min' => 2.4,
            'caudal_max' => 21.6,
            'url' => 'https://ps-pool.com/tienda/medicion/275-1644-caudalimetros-flowvis.html#/1708-tipo-encolar/1710-conexiones-o_50_mm',
        ],
        [
            'item' => '13401',
            'descripcion' => 'FlowVis caudalímetro + NRV',
            'dn' => 50,
            'diametro' => 63,
            'caudal_min' => 2.4,
            'caudal_max' => 24.0,
            'url' => 'https://ps-pool.com/tienda/medicion/275-1645-caudalimetros-flowvis.html#/1708-tipo-encolar/1711-conexiones-o_63_mm',
        ],
        [
            'item' => '17333',
            'descripcion' => 'FlowVis caudalímetro',
            'dn' => 65,
            'diametro' => 75,
            'caudal_min' => 7.0,
            'caudal_max' => 45.0,
            'url' => 'https://ps-pool.com/tienda/medicion/275-1646-caudalimetros-flowvis.html#/1708-tipo-encolar/1712-conexiones-o_75_mm',
        ],
        [
            'item' => '13403',
            'descripcion' => 'FlowVis caudalímetro',
            'dn' => 80,
            'diametro' => 90,
            'caudal_min' => 20.0,
            'caudal_max' => 50.0,
            'url' => 'https://ps-pool.com/tienda/medicion/275-1647-caudalimetros-flowvis.html#/1708-tipo-encolar/1713-conexiones-o_90_mm',
        ],
        [
            'item' => '13404',
            'descripcion' => 'FlowVis caudalímetro',
            'dn' => 100,
            'diametro' => 110,
            'caudal_min' => 34.0,
            'caudal_max' => 64.0,
            'url' => 'https://ps-pool.com/tienda/medicion/275-1648-caudalimetros-flowvis.html#/1708-tipo-encolar/1714-conexiones-o_110_mm',
        ],
    ];


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('flowvis.index', compact('user'));
    }

    public function calcular(Request $request)
    {

        $caudal = $request->caudal;
        $diametro = $request->diametro;

        $resultado = collect($this->productos)->filter(function ($producto) use ($caudal, $diametro) {
            if ($caudal !== null && $caudal !== '') {
                return $caudal >= $producto['caudal_min'] && $caudal <= $producto['caudal_max'];
            }

            if ($diametro !== null && $diametro !== '') {
                return $producto['diametro'] == $diametro;
            }

            return false;
        });
        return response()->json([
            'resultado' => collect($resultado)->values() // asegura array numérico
        ]);
    }
}
