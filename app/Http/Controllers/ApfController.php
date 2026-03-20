<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApfController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('apf.index', compact('user'));
    }

    public function calcular(Request $request)
    {

        //Pedimos valores obligatorios
        $request->validate([
            'caudal'           => 'required'
        ]);

        $dosis1 = 0.5; // valores en ml
        $dosis2 = 1; // valores en ml

        $caudal = $request->caudal;

        $result1 = $caudal * $dosis1;
        $result2 = $caudal * $dosis2;

        // Devolver la respuesta en formato JSON
        return response()->json([
            'result1' => $result1,
            'result2' => $result2
        ]);
    }
}
