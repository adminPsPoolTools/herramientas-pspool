<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BombasInverHeroController extends Controller
{

    private $modeloBombaIH;

    //Variables para la bomba InverHero
    private $jsonDatosBombaElegidaIH;
    private $consumoMensualIH;
    private $costeElectricidadMensualIH;
    private $costeElectricidadAnualIH;
    private $volumenTotalIH;
    private $horasFuncionamientoBombaIH;
    private $consumoBombaKwIH;
    private $ruidoIH;

    //Variables para la bomba estandar
    private $volumenTotalST;
    private $jsonDatosBombaElegidaST;
    private $horasFuncionamientoBombaST;
    private $consumoBombaKwST;
    private $consumoMensualST;
    private $costeElectricidadMensualST;
    private $costeElectricidadAnualST;
    private $ruidoST;

    //Variables con total ahorros
    private $ahorroMes;
    private $ahorroTemporada;
    private $ahorroCincoTemporadas;
    private $ahorroDiezTemporadas;


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('inverhero.index', compact('user'));
    }


    public function calcular(Request $request)
    {


        $inverhero20 = [
            [30,   6.06, 33.1, 0.065],
            [40,   7.09, 34.4, 0.080],
            [50,   9.11, 37.1, 0.129],
            [60,  11.05, 39.8, 0.201],
            [70,  12.14, 42.6, 0.252],
            [80,  14.14, 45.3, 0.364],
            [90,  16.18, 48.0, 0.505],
            [100, 17.93, 50.7, 0.647],
            [110, 18.23, 52.7, 0.741],
            [120, 18.42, 52.9, 0.750]

        ];

        $inverhero24 = [
            [30,  7.04,  33.4, 0.085],
            [40,  9.11,  35.6, 0.105],
            [50,  11.99, 38.6, 0.168],
            [60,  14.04, 41.7, 0.238],
            [70,  16.30, 44.7, 0.339],
            [80,  19.08, 47.7, 0.498],
            [90,  21.10, 50.7, 0.638],
            [100, 23.23, 53.7, 0.806],
            [110, 24.33, 55.2, 1.042],
            [120, 24.46, 55.4, 1.050]
        ];

        $inverhero30 = [
            [30,   9.05, 33.9, 0.089],
            [40,  11.69, 36.8, 0.116],
            [50,  14.61, 40.1, 0.191],
            [60,  17.58, 43.4, 0.317],
            [70,  20.55, 46.7, 0.492],
            [80,  22.55, 50.0, 0.638],
            [90,  25.60, 53.3, 0.903],
            [100, 27.58, 56.6, 1.104],
            [110, 28.08, 56.8, 1.380],
            [120, 28.15, 57.0, 1.388]
        ];

        $inverhero40 = [
            [30,  10.60, 34.0, 0.111],
            [40,  13.74, 37.0, 0.149],
            [50,  17.25, 40.4, 0.238],
            [60,  20.68, 43.7, 0.404],
            [70,  23.76, 47.1, 0.611],
            [80,  26.36, 50.5, 0.839],
            [90,  29.18, 53.8, 1.110],
            [100, 31.72, 57.2, 1.402],
            [110, 32.03, 57.4, 1.722],
            [120, 32.10, 57.6, 1.734]
        ];

        $bombaStandar = [
            [75,   12.50, 60, 0.75, 14.40, 10.80],
            [110,  17.30, 60, 1.10, 10.40, 11.45],
            [150,  23.70, 65, 1.50,  7.59, 11.39]
        ];

        $this->modeloBombaIH = $request->modelo;

        if ($this->modeloBombaIH == 'IH20') {
            $valorArrayBombaIH            = $this->encontrarValorCercanoIH($inverhero20, $request->velocidad);
            $valorArrayBombaST            = $this->encontrarValorCercanoST($bombaStandar, $request->comparativa);
            $this->calcuarDatosCalculo($valorArrayBombaIH, $request, $valorArrayBombaST);
        } elseif ($this->modeloBombaIH == 'IH24') {
            $valorArrayBombaIH            = $this->encontrarValorCercanoIH($inverhero24, $request->velocidad);
            $valorArrayBombaST            = $this->encontrarValorCercanoST($bombaStandar, $request->comparativa);
            $this->calcuarDatosCalculo($valorArrayBombaIH, $request, $valorArrayBombaST);
        } elseif ($this->modeloBombaIH == 'IH30') {
            $valorArrayBombaIH            = $this->encontrarValorCercanoIH($inverhero30, $request->velocidad);
            $valorArrayBombaST            = $this->encontrarValorCercanoST($bombaStandar, $request->comparativa);
            $this->calcuarDatosCalculo($valorArrayBombaIH, $request, $valorArrayBombaST);
        } elseif ($this->modeloBombaIH == 'IH40') {
            $valorArrayBombaIH            = $this->encontrarValorCercanoIH($inverhero40, $request->velocidad);
            $valorArrayBombaST            = $this->encontrarValorCercanoST($bombaStandar, $request->comparativa);
            $this->calcuarDatosCalculo($valorArrayBombaIH, $request, $valorArrayBombaST);
        } else {
            $this->jsonDatosBombaElegidaIH      = ['Error en los datos enviados'];
        }

        return response()->json([
            //'jsonDatosBombaElegidaIH'       => [$this->jsonDatosBombaElegidaIH],
            'volumenTotalIH'                => round($this->volumenTotalIH, 2),
            'horasFuncionamientoBombaIH'    => round($this->horasFuncionamientoBombaIH, 2),
            'consumoBombaKwIH'              => round($this->consumoBombaKwIH, 2),
            'consumoMensualIH'              => round($this->consumoMensualIH, 2),
            'costeElectricidadMensualIH'    => round($this->costeElectricidadMensualIH, 2),
            'costeElectricidadAnualIH'      => round($this->costeElectricidadAnualIH, 2),
            'ruidoIH'                       => round($this->ruidoIH, 2),

            //'jsonDatosBombaElegidaST'       => [$this->jsonDatosBombaElegidaST],
            'volumenTotalST'                => round($this->volumenTotalST, 2),
            'horasFuncionamientoBombaST'    => round($this->horasFuncionamientoBombaST, 2),
            'consumoBombaKwST'              => round($this->consumoBombaKwST, 2),
            'consumoMensualST'              => round($this->consumoMensualST, 2),
            'costeElectricidadMensualST'    => round($this->costeElectricidadMensualST, 2),
            'costeElectricidadAnualST'      => round($this->costeElectricidadAnualST, 2),
            'ruidoST'                       => round($this->ruidoST, 2),

            'ahorroMes'                     => round($this->ahorroMes, 2),
            'ahorroTemporada'               => round($this->ahorroTemporada, 2),
            'ahorroCincoTemporadas'         => round($this->ahorroCincoTemporadas, 2),
            'ahorroDiezTemporadas'          => round($this->ahorroDiezTemporadas, 2),
            'modeloBombaIH'                 => $this->modeloBombaIH
        ]);
    }

    /**Metodos de la clase */
    function calcuarDatosCalculo($valorArrayBombaIH, $request, $bombaStandar)
    {
        //Calculos con bombas inverhero
        $this->volumenTotalIH               = $request->volumen * $request->horas;
        $this->jsonDatosBombaElegidaIH      = json_decode($valorArrayBombaIH, true);
        $this->horasFuncionamientoBombaIH   = $this->volumenTotalIH / $this->jsonDatosBombaElegidaIH[1];
        $this->consumoBombaKwIH             = $this->jsonDatosBombaElegidaIH[3] *  $this->horasFuncionamientoBombaIH;
        $this->consumoMensualIH             = $this->consumoBombaKwIH * 30;
        $this->costeElectricidadMensualIH   = $this->consumoMensualIH * $request->precio;
        $this->costeElectricidadAnualIH     = $this->costeElectricidadMensualIH * $request->meses;
        $this->ruidoIH                      =  $this->jsonDatosBombaElegidaIH[2];

        //Calculos con bomba Standar
        $this->volumenTotalST               = $request->volumen * $request->horas;
        $this->jsonDatosBombaElegidaST      = json_decode($bombaStandar, true);
        $this->horasFuncionamientoBombaST   = $this->volumenTotalST / $this->jsonDatosBombaElegidaST[1];
        $this->consumoBombaKwST             = $this->jsonDatosBombaElegidaST[3] *  $this->horasFuncionamientoBombaST;
        $this->consumoMensualST             = $this->consumoBombaKwST * 30;
        $this->costeElectricidadMensualST   = $this->consumoMensualST * $request->precio;
        $this->costeElectricidadAnualST     = $this->costeElectricidadMensualST * $request->meses;
        $this->ruidoST                      =  $this->jsonDatosBombaElegidaST[2];

        //Total de ahorros
        $this->ahorroMes                = $this->costeElectricidadMensualST - $this->costeElectricidadMensualIH;
        $this->ahorroTemporada          = $this->ahorroMes * $request->meses;
        $this->ahorroCincoTemporadas    = $this->ahorroTemporada * 5;
        $this->ahorroDiezTemporadas     = $this->ahorroTemporada * 10;
    }

    function encontrarValorCercanoIH($matriz, $caudal)
    {
        foreach ($matriz as $row) {
            if ($row[0] == $caudal) {
                return json_encode($row);
            }
        }
    }

    function encontrarValorCercanoST($matriz, $caudal)
    {
        foreach ($matriz as $row) {
            if ($row[0] == $caudal) {
                return json_encode($row);
            }
        }
    }
}
