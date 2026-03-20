<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VolumenAguaController extends Controller
{
    //Voluem y superficie de la piscina
    private $volumen      = null;
    private $superficie   = null;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('volumen.index', compact('user'));
    }

    public function calcular(Request $request)
    {
        //Pedimos valores obligatorios
        $request->validate([
            'ancho'     => 'required|numeric|min:0',
            'largo'  => 'required|numeric|min:0',
            'profundidadMin'  => 'required|numeric|min:0',
            'profundidadMax'  => 'required|numeric|min:0',

        ]);

        $ancho = $request->ancho;
        $largo = $request->largo;
        $profundidadMin = $request->profundidadMin;
        $profundidadMax = $request->profundidadMax;
        $profundidadMedia = ($profundidadMin + $profundidadMax) / 2;

        $this->volumen = round($ancho * $largo * $profundidadMedia, 2);
        $this->superficie = round($ancho * $largo);

        // Devolver la respuesta en formato JSON
        return response()->json([
            'ancho'             => $ancho,
            'largo'             => $largo,
            'profundidadMedia'  => $profundidadMedia,
            'profundidadMax'    => $profundidadMax,
            'profundidadMin'    => $profundidadMin,
            'superficie'        => $this->superficie,
            'volumen'           => $this->volumen
        ]);
    }
}
