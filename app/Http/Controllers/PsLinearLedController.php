<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PsLinearLedController extends Controller
{

    private $espacio;
    private $tipo_giro;
    private $orientacion_cable;
    private $alimentacion;
    private $color;
    private $rgb = 83;
    private $monocolor = 50;
    private $valorDatosTira;
    private $resultadoSinTapones;
    private $resultadoConTapones;
    private $datosMedidasCable;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('pslinearled.index', compact('user'));
    }
    public function calcular(Request $request)
    {
        //Pedimos valores obligatorios
        $request->validate([
            'espacio'           => 'required|numeric|min:0',
            'tipo_giro'         => 'required',
            'orientacion_cable' => 'required',
            'alimentacion'      => 'required',
            'color'             => 'required'

        ]);


        $this->espacio = $request->espacio;

        //para los datos medida cable
        $this->tipo_giro = $request->tipo_giro;
        $this->orientacion_cable = $request->orientacion_cable;
        $this->alimentacion = $request->alimentacion;

        //para el color
        $this->color = $request->color;


        //Datos para la medida del cable
        $this->datosMedidasCable = [
            ['modelo' => 'frontal', 'salida_cable' => 'recto',  'alimentacion' => 'un_lado',    'medida' => 27],
            ['modelo' => 'frontal', 'salida_cable' => 'recto',  'alimentacion' => 'dos_lados',  'medida' => 44],
            ['modelo' => 'frontal', 'salida_cable' => 'acodado', 'alimentacion' => 'un_lado',    'medida' => 15.5],
            ['modelo' => 'frontal', 'salida_cable' => 'acodado', 'alimentacion' => 'dos_lados',  'medida' => 21],
            ['modelo' => 'lateral', 'salida_cable' => 'recto',  'alimentacion' => 'un_lado',    'medida' => 30],
            ['modelo' => 'lateral', 'salida_cable' => 'recto',  'alimentacion' => 'dos_lados',  'medida' => 50],
        ];

        $this->valorDatosTira = $this->buscarMedida($this->tipo_giro,  $this->orientacion_cable, $this->alimentacion);

        $medidaNumeroEntero = intval($this->espacio); // Redondea a numero entero
        $decimalD4 = $this->espacio - $medidaNumeroEntero;
        $multiplicado = $decimalD4 * 1000;
        $resta = $multiplicado -  $this->valorDatosTira;
        $multiploBase = ($this->color == 'rgb') ? $this->rgb : $this->monocolor;
        $multiploInferior = $this->floorToMultiple($resta, $multiploBase);

        $this->resultadoSinTapones = round(($multiploInferior / 1000) + $medidaNumeroEntero, 3);
        $this->resultadoConTapones = round($this->resultadoSinTapones + ($this->valorDatosTira / 1000), 3);

        // Devolver la respuesta en formato JSON
        return response()->json([
            'espacio'               => $this->espacio,
            'tipo_giro'             => $this->tipo_giro,
            'orientacion_cable'     => $this->orientacion_cable,
            'alimentacion'          => $this->alimentacion,
            'color'                 => $this->color,
            'rgb'                   => $this->rgb,
            'monocolor'             => $this->monocolor,
            'valorDatosTira'        => $this->valorDatosTira,
            'resultadoSinTapones'   => $this->resultadoSinTapones,
            'resultadoConTapones'    => $this->resultadoConTapones
        ]);
    }

    private function buscarMedida($tipo_giro, $orientacion_cable, $alimentacion)
    {
        foreach ($this->datosMedidasCable as $item) {
            if (
                $item['modelo'] === $tipo_giro &&
                $item['salida_cable'] === $orientacion_cable &&
                $item['alimentacion'] === $alimentacion
            ) {
                return $item['medida'];
            }
        }

        return null;
    }
    private function floorToMultiple($value, $multiple)
    {
        return floor($value / $multiple) * $multiple;
    }
}
