<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculoTuberiasController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('tuberias.index', compact('user'));
    }

    public function calcular(Request $request)
    {
        //Pedimos valores obligatorios
        $request->validate([
            'caudal'    => 'required|numeric|min:0'
        ]);
        $caudal = $request->caudal;

        $datosCanaleta = [
            [0.40, 0.7, 1.2, 2.0, 3.00, 4.80, 6.70, 9.50, 15, 19, 23, 31.0, 57.00, 68.00, 84.00, 135] //1
        ];

        $datosAspiracion = [
            [0.85, 1.4, 2.3, 3.9, 6.00, 9.50, 13.5, 19.5, 30, 37, 47, 63.0, 113.0, 136.0, 168.0, 270], //1
            [0.90, 1.5, 2.5, 4.3, 6.60, 10.4, 14.9, 21.5, 33, 41, 52, 69.0, 124.3, 149.6, 184.8, 297], //2
            [1.00, 1.7, 2.8, 4.7, 7.20, 11.4, 16.2, 23.5, 36, 45, 56, 76.0, 135.6, 163.2, 201.6, 324], //3
            [1.10, 1.8, 3.0, 5.1, 7.80, 12.3, 17.6, 25.5, 39, 49, 61, 82.0, 146.9, 176.8, 218.4, 351], //4
            [1.20, 2.0, 3.2, 5.5, 8.40, 13.3, 18.9, 27.5, 42, 52, 66, 88.0, 158.2, 190.4, 235.2, 378], //5
            [1.30, 2.1, 3.5, 5.9, 9.00, 14.3, 20.2, 29.0, 45, 56, 70, 94.0, 169.0, 204.0, 252.0, 405]  //6
        ];

        $datosImpulsion = [
            [1.30, 2.1, 3.5, 5.9, 9.00, 14.3, 20.2, 29.0, 45, 56, 70, 94.0, 169.0, 204.0, 252.0, 405], //1
            [1.40, 2.2, 3.7, 6.2, 9.60, 15.2, 21.6, 31.0, 48, 60, 75,  101, 180.8, 217.6, 268.8, 432], //2
            [1.50, 2.4, 3.9, 6.6, 10.2, 16.2, 22.9, 33.0, 51, 64, 80,  107, 192.1, 231.2, 285.6, 459], //3
            [1.60, 2.5, 4.1, 7.0, 10.8, 17.1, 24.3, 35.0, 54, 67, 85,  113, 203.4, 244.8, 302.4, 486], //4
            [1.70, 2.7, 4.4, 7.4, 11.4, 18.1, 25.6, 37.0, 57, 71, 89,  120, 214.7, 258.4, 319.2, 513], //5
            [1.70, 2.8, 4.6, 7.7, 12.0, 19.1, 27.0, 39.0, 60, 75, 94,  126, 226.0, 272.0, 336.0, 540]  //6

        ];

        // Encuentra el valor más cercano en cada conjunto de datos
        $valorMasCercanoCanaleta    = $this->encontrarValorCercano($datosCanaleta, $caudal);
        $valorMasCercanoAspiracion  = $this->encontrarValorCercano($datosAspiracion, $caudal);
        $valorMasCercanoImpulsion   = $this->encontrarValorCercano($datosImpulsion, $caudal);

        $nombresColumnas = [
            1 =>  'Ø20',
            2 =>  'Ø25',
            3 =>  'Ø32',
            4 =>  'Ø40',
            5 =>  'Ø50',
            6 =>  'Ø63',
            7 =>  'Ø75',
            8 =>  'Ø90',
            9 =>  'Ø110',
            10 => 'Ø125',
            11 => 'Ø140',
            12 => 'Ø160',
            13 => 'Ø200',
            14 => 'Ø225',
            15 => 'Ø250',
            16 => 'Ø310'
        ];

        $nombresFilasCanaleta = [
            1 => '0,5 m/s'
        ];

        $nombresFilasAspiracion = [
            1 => '1,0 m/s',
            2 => '1,1 m/s',
            3 => '1,2 m/s',
            4 => '1,3 m/s',
            5 => '1,4 m/s',
            6 => '1,5 m/s'
        ];

        $nombresFilasImpulsion = [
            1 => '1,5 m/s',
            2 => '1,6 m/s',
            3 => '1,7 m/s',
            4 => '1,8 m/s',
            5 => '1,9 m/s',
            6 => '2,0 m/s'
        ];


        if ($valorMasCercanoCanaleta === 0) {
            $ubicacionCanaleta = [0, 0];
        } else {
            $ubicacionCanaleta = $this->encontrarUbicacionConNombres($datosCanaleta, $valorMasCercanoCanaleta, $nombresFilasCanaleta, $nombresColumnas);
        }

        if ($valorMasCercanoAspiracion === 0) {
            $ubicacionAspiracion = [0, 0];
        } else {
            $ubicacionAspiracion = $this->encontrarUbicacionConNombres($datosAspiracion, $valorMasCercanoAspiracion, $nombresFilasAspiracion, $nombresColumnas);
        }

        if ($valorMasCercanoImpulsion === 0) {
            $ubicacionImpulsion = [0, 0];
        } else {
            $ubicacionImpulsion = $this->encontrarUbicacionConNombres($datosImpulsion, $valorMasCercanoImpulsion, $nombresFilasImpulsion, $nombresColumnas);
        }

        // Devolver la respuesta en formato JSON
        return response()->json([
            'resultadoCanaleta'        => [$ubicacionCanaleta[0],   $ubicacionCanaleta[1]],
            'resultadoImpulsion'       => [$ubicacionImpulsion[0],  $ubicacionImpulsion[1]],
            'resultadoAspiracion'      => [$ubicacionAspiracion[0], $ubicacionAspiracion[1]]
        ]);

        return view('tuberias.index');
    }

    /**Metodos de la clase */
    function encontrarValorCercano($matriz, $caudal)
    {
        $valoresCercanos = [];
        foreach ($matriz as $fila) {
            $valoresFiltrados = array_filter($fila, function ($valor) use ($caudal) {
                return $valor >= $caudal;
            });

            if (empty($valoresFiltrados)) {
                continue;
            }
            $valoresCercanos[] = min($valoresFiltrados);
        }
        if (empty($valoresCercanos)) {
            return 0;
        }
        return min($valoresCercanos);
    }

    function encontrarUbicacionConNombres($matriz, $valor, $nombresFilas, $nombresColumnas)
    {
        foreach ($matriz as $fila_idx => $fila) {
            $columna_idx = array_search($valor, $fila);
            if ($columna_idx !== false) {
                $nombreFila = $nombresFilas[$fila_idx + 1];
                $nombreColumna = $nombresColumnas[$columna_idx + 1];
                return [$nombreFila, $nombreColumna];
            }
        }
        return null;
    }
}
