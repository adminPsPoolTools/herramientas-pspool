<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivadorDagenController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('activador-dagen.index', compact('user'));
    }

    public function calcular(Request $request)
    {

        //Pedimos valores obligatorios
        $request->validate([
            'volumen'           => 'required'
        ]);

        $volumen = $request->volumen;
        $result = $volumen;

        // Devolver la respuesta en formato JSON
        return response()->json([
            'result' => $result

        ]);
    }
}
