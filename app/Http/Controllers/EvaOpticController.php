<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaOpticController extends Controller
{
    private $valoresPorcentajesReflexion;
    private $resultadoValoresFocosN1;
    private $resultadoValoresFocosN2;
    private $resultadoPorcentajesReflexion;
    private $valoresFocosGeometriaAncho;
    private $valoresFocosGeometriaLargo;
    private $valoresFocosSeleccionados;
    private $modelosFocos;
    private $wattiosFocos;

    private $ancho;
    private $largo;
    private $n_focos;
    private $ancho_consejos;
    private $tipo_luz;
    private $reflexion;
    private $superficie;
    private $minimoFocos;
    private $distanciaEntreFocos;
    private $distanciaParedPrimerFoco;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('evaoptic.index', compact('user'));
    }
    public function calcular(Request $request)
    {
        //Pedimos valores obligatorios
        $request->validate([
            'ancho'             => 'required|numeric|min:0',
            'largo'             => 'required|numeric|min:0',
            'ancho_consejos'    => 'required',
            'tipo_luz'          => 'required',
            'reflexion'         => 'required'
        ]);


        $this->valoresPorcentajesReflexion = [

            ['1'  => 1.7],
            ['2'  => 1.6],
            ['3'  => 1.5],
            ['4'  => 1.4],
            ['5'  => 1.3],
            ['6'  => 1.2],
            ['7'  => 1.1],
            ['8'  => 1.0]

        ];

        $this->valoresFocosGeometriaAncho = [

            ['1'    => 2.00],
            ['2'    => 2.00],
            ['3'    => 3.00],
            ['4'    => 3.00],
            ['5'    => 3.50],
            ['6'    => 3.50],
            ['7'    => 3.50],
            ['8'    => 3.50],
            ['9'    => 3.50],
            ['10'   => 5.00],
            ['11'   => 5.00],
            ['12'   => 5.00],
            ['13'   => 5.00],
            ['14'   => 5.00]

        ];

        $this->valoresFocosGeometriaLargo = [

            ['1'    => 2.00],
            ['2'    => 2.00],
            ['3'    => 3.00],
            ['4'    => 3.00],
            ['5'    => 5.00],
            ['6'    => 5.00],
            ['7'    => 5.00],
            ['8'    => 5.00],
            ['9'    => 5.00],
            ['10'   => 12.50],
            ['11'   => 12.50],
            ['12'   => 12.50],
            ['13'   => 12.50],
            ['14'   => 12.50]

        ];

        $this->valoresFocosSeleccionados = [

            ['1'    => 1.25],
            ['2'    => 1.00],
            ['3'    => 1.25],
            ['4'    => 1.00],
            ['5'    => 1.15],
            ['6'    => 1.00],
            ['7'    => 1.00],
            ['8'    => 1.15],
            ['9'    => 1.00],
            ['10'   => 1.05],
            ['11'   => 1.00],
            ['12'   => 1.00],
            ['13'   => 1.05],
            ['14'   => 1.00]

        ];

        $valoresModelosFocos = [

            ['1'    => "Q2"],
            ['2'    => "Q2"],
            ['3'    => "B2"],
            ['4'    => "B2"],
            ['5'    => "SubAqua"],
            ['6'    => "SubAqua"],
            ['7'    => "SubAqua"],
            ['8'    => "SubAqua"],
            ['9'    => "SubAqua"],
            ['10'   => "SubAqua"],
            ['11'   => "SubAqua"],
            ['12'   => "SubAqua"],
            ['13'   => "SubAqua"],
            ['14'   => "SubAqua"]

        ];

        $wattiosFocos = [

            ['1'    => "5W"],
            ['2'    => "5W"],
            ['3'    => "10W"],
            ['4'    => "10W"],
            ['5'    => "25W"],
            ['6'    => "25W"],
            ['7'    => "25W"],
            ['8'    => "25W"],
            ['9'    => "25W"],
            ['10'   => "40W"],
            ['11'   => "40W"],
            ['12'   => "40W"],
            ['13'   => "50W"],
            ['14'   => "50W"]

        ];

        //Recuperamos los datos del formulario y los seteamos
        $this->ancho            = $request->ancho;
        $this->largo            = $request->largo;
        $this->n_focos          = $request->n_focos;
        $this->ancho_consejos   = $request->ancho_consejos;
        $this->tipo_luz         = $request->tipo_luz;
        $this->reflexion        = $request->reflexion;

        $this->superficie = $this->ancho * $this->largo;


        $this->resultadoPorcentajesReflexion = $this->valoresPorcentajesReflexion[$this->reflexion - 1][$this->reflexion];


        $anchoDesfavorableTemp = $this->valoresFocosGeometriaLargo[$this->tipo_luz - 1][$this->tipo_luz] < $this->ancho ? 2 : 1;
        $largoDesfavorableTemp = $this->largo / $this->valoresFocosGeometriaAncho[$this->tipo_luz - 1][$this->tipo_luz];

        $datosFocosSeleccionados = $this->valoresFocosSeleccionados[$this->tipo_luz - 1][$this->tipo_luz];

        $this->resultadoValoresFocosN1 =  $anchoDesfavorableTemp * $largoDesfavorableTemp;
        $this->resultadoValoresFocosN2 =  $this->valoresFocosSeleccionados[$this->tipo_luz - 1][$this->tipo_luz];

        $this->modelosFocos =  $valoresModelosFocos[$this->tipo_luz - 1][$this->tipo_luz];
        $this->wattiosFocos =  $wattiosFocos[$this->tipo_luz - 1][$this->tipo_luz];

        $this->minimoFocos = ceil($this->resultadoValoresFocosN1 * $datosFocosSeleccionados *  $this->resultadoPorcentajesReflexion);
        $this->distanciaEntreFocos = round($this->largo / $this->minimoFocos, 2);
        $this->distanciaParedPrimerFoco = round($this->distanciaEntreFocos / 2, 2);

        // Devolver la respuesta en formato JSON
        return response()->json([
            'ancho'                         => $this->ancho,
            'largo'                         => $this->largo,
            'n_focos'                       => $this->n_focos,
            'ancho_consejos'                => $this->ancho_consejos,
            'tipo_luz'                      => $this->tipo_luz,
            'reflexion'                     => $this->reflexion,
            'superficie'                    => $this->superficie,
            'resultadoValoresFocosN1'       => $this->resultadoValoresFocosN1,
            'resultadoValoresFocosN2'       => $this->resultadoValoresFocosN2,
            'resultadoPorcentajesReflexion' => $this->resultadoPorcentajesReflexion,
            'minimoFocos'                   => $this->minimoFocos,
            'distanciaEntreFocos'           => $this->distanciaEntreFocos,
            'distanciaParedPrimerFoco'      => $this->distanciaParedPrimerFoco,
            'anchoDesfavorableTemp'         => $anchoDesfavorableTemp,
            'largoDesfavorableTemp'         => $largoDesfavorableTemp,
            'datosFocosSeleccionados'       => $datosFocosSeleccionados,
            'modelosFocos'                  => $this->modelosFocos,
            'wattiosFocos'                  => $this->wattiosFocos,

        ]);
    }
}
