<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BombasSaciController extends Controller
{
    private $modeloBombaSaci;
    private $modeloStandard;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('saci.index', compact('user'));
    }
    public function calcular(Request $request)
    {

        $this->modeloBombaSaci  = $request->calc_modelo;
        $this->modeloStandard   = $request->calc_potencia;

        try {
            $response = Http::withHeaders([

                'X-Api-Key' => env('API_KEY_SACI')

            ])->get('https://api.sacipumps.com/v1.0/calculadoras/', [

                'calc_id'           => $request->input('calc_id'),
                'calc_idioma'       => $request->input('calc_idioma'),
                'calc_perdidas'     => $request->input('calc_perdidas'),
                'calc_tuberia'      => $request->input('calc_tuberia'),
                'calc_volumen'      => $request->input('calc_volumen'),
                'calc_filtration'   => $request->input('calc_filtration'),
                'calc_preciokw'     => $request->input('calc_preciokw'),
                'calc_meses'        => $request->input('calc_meses'),
                'calc_potencia'     => $request->input('calc_potencia'),
                'calc_modelo'       => $request->input('calc_modelo')
            ]);
            // Combinar la respuesta de la API con la variable adicional
            $responseData = $response->json();
            $responseData['modeloBombaSaci']    = $this->modeloBombaSaci;
            $responseData['modeloStandard']     = $this->modeloStandard;

            return response()->json($responseData);
        } catch (\Exception $e) {
            Log::error('Excepción en llamada API', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
