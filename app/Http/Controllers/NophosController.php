<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NophosController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('nophos.index', compact('user'));
    }

    public function calcularSemana(Request $request)
    {
        //Pedimos valores obligatorios
        $request->validate([
            'volumen'           => 'required'
        ]);

        $mlNophos = 100;
        $proporcion = 50000;
        $volumenPiscina = $request->volumen * 1000;


        $result = ($volumenPiscina * $mlNophos) / $proporcion;

        // Devolver la respuesta en formato JSON
        return response()->json([
            'result'    => $result
        ]);
    }

    public function calcularInicio(Request $request)
    {

        //Pedimos valores obligatorios
        $request->validate([
            'volumen'           => 'required',
            'fosfatos'          => 'required'
        ]);

        $result = $request->fosfatos * $request->volumen * 10;

        // Devolver la respuesta en formato JSON
        return response()->json([
            'result'    => $result
        ]);
    }
}
