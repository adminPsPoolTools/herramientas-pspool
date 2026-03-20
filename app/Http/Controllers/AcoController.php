<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcoController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('aco.index', compact('user'));
    }

    public function calcular(Request $request)
    {
        //Pedimos valores obligatorios
        $request->validate([
            'volumen'           => 'required'
        ]);

        $acoSemana1 = 1000; // valores en ml
        $acoSemana2 = 2000; // valores en ml
        $acoMes1 = 5000;    // valores en ml
        $acoMes2 = 10000;   // valores en ml

        $proporcion = 100000;

        $volumenPiscina = $request->volumen * 1000;

        $resultSemana1 = ($volumenPiscina * $acoSemana1) / $proporcion;
        $resultSemana2 = ($volumenPiscina * $acoSemana2) / $proporcion;

        $resultMes1 = ($volumenPiscina * $acoMes1) / $proporcion;
        $resultMes2 = ($volumenPiscina * $acoMes2) / $proporcion;

        // Devolver la respuesta en formato JSON
        return response()->json([
            'resultSemana1' => $resultSemana1,
            'resultSemana2' => $resultSemana2,
            'resultMes1'    => $resultMes1,
            'resultMes2'    => $resultMes2
        ]);
    }
}
