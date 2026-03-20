<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangelierController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('langelier.index', compact('user'));
    }

    public function calcular(Request $request)
    {

        //Pedimos valores obligatorios
        $request->validate([
            'ph'           => 'required',
            'temperatura'  => 'required',
            'dureza'       => 'required',
            'alcalinidad'  => 'required'
        ]);

        /* Funcion para sacar el indice de la temperatura */
        // Variable clave valor temperatura
        $temperaturaTF = [
            '0'   => 0.00,
            '4'   => 0.10,
            '8'   => 0.20,
            '12'  => 0.30,
            '16'  => 0.40,
            '20'  => 0.50,
            '24'  => 0.60,
            '28'  => 0.70,
            '32'  => 0.70,
            '36'  => 0.80,
            '40'  => 0.90,
            '50'  => 1.00
        ];

        $temperaturaSeleccionada    = $request->temperatura;


        $valorInferiorTemperatura   = null;
        $valorSuperiorTemperatura   = null;
        $claveInferiorTemperatura   = null;
        $claveSuperiorTemperatura   = null;

        $claves = array_keys($temperaturaTF);
        sort($claves, SORT_NUMERIC); // Ordenar las claves numéricamente

        foreach ($claves as $c) {
            if ($c < $temperaturaSeleccionada) {
                $valorInferiorTemperatura = $temperaturaTF[$c];
                $claveInferiorTemperatura = $c;
            } elseif ($c > $temperaturaSeleccionada) {
                $valorSuperiorTemperatura = $temperaturaTF[$c];
                $claveSuperiorTemperatura = $c;
                break; // Detener la búsqueda una vez que se encuentre el valor superior más cercano
            }
        }
        $indiceLangelierTemperatura = ($valorInferiorTemperatura + (($temperaturaSeleccionada - $claveInferiorTemperatura) / ($claveSuperiorTemperatura - $claveInferiorTemperatura)) * ($valorSuperiorTemperatura - $valorInferiorTemperatura));
        /* Fin funcion para sacar el indice de la temperatura */

        /* Funcion para sacar el indice de la dureza */
        // Variable clave valor dureza
        $durezaTF = [
            '5'     => 0.70,
            '25'    => 1.40,
            '50'    => 1.70,
            '75'    => 1.90,
            '100'   => 2.00,
            '150'   => 2.20,
            '200'   => 2.30,
            '250'   => 2.40,
            '300'   => 2.50,
            '400'   => 2.60,
            '500'   => 2.70,
            '1000'  => 3.00
        ];

        $durezaSeleccionado    = $request->dureza;

        $valorInferiorDureza   = null;
        $valorSuperiorDureza   = null;
        $claveInferiorDureza   = null;
        $claveSuperiorDureza   = null;

        // Si la clave no existe en el array
        $claves = array_keys($durezaTF);
        sort($claves, SORT_NUMERIC); // Ordenar las claves numéricamente

        foreach ($claves as $c) {
            if ($c < $durezaSeleccionado) {
                $valorInferiorDureza = $durezaTF[$c];
                $claveInferiorDureza = $c;
            } elseif ($c > $durezaSeleccionado) {
                $valorSuperiorDureza = $durezaTF[$c];
                $claveSuperiorDureza = $c;
                break; // Detener la búsqueda una vez que se encuentre el valor superior más cercano
            }
        }
        $indiceLangelierDureza = ($valorInferiorDureza + (($durezaSeleccionado - $claveInferiorDureza) / ($claveSuperiorDureza - $claveInferiorDureza)) * ($valorSuperiorDureza - $valorInferiorDureza));
        /* Fin funcion para sacar el indice del Dureza */

        /* Funcion para sacar el indice de la alcalinidad */
        // Variable clave valor alcalinidad
        $alcalinidadTF = [
            '5'     => 0.70,
            '25'    => 1.40,
            '50'    => 1.70,
            '75'    => 1.90,
            '100'   => 2.00,
            '150'   => 2.20,
            '200'   => 2.30,
            '250'   => 2.40,
            '300'   => 2.50,
            '400'   => 2.60,
            '500'   => 2.70,
            '1000'  => 3.00
        ];

        $alcalinidadSeleccionado    = $request->alcalinidad;

        $valorInferiorAlcalinidad   = null;
        $valorSuperiorAlcalinidad   = null;
        $claveInferiorAlcalinidad   = null;
        $claveSuperiorAlcalinidad   = null;

        // Si la clave no existe en el array
        $claves = array_keys($alcalinidadTF);
        sort($claves, SORT_NUMERIC); // Ordenar las claves numéricamente

        foreach ($claves as $c) {
            if ($c < $alcalinidadSeleccionado) {
                $valorInferiorAlcalinidad = $alcalinidadTF[$c];
                $claveInferiorAlcalinidad = $c;
            } elseif ($c > $alcalinidadSeleccionado) {
                $valorSuperiorAlcalinidad = $alcalinidadTF[$c];
                $claveSuperiorAlcalinidad = $c;
                break; // Detener la búsqueda una vez que se encuentre el valor superior más cercano
            }
        }
        $indiceLangelierAlcalinidad = ($valorInferiorAlcalinidad + (($alcalinidadSeleccionado - $claveInferiorAlcalinidad) / ($claveSuperiorAlcalinidad - $claveInferiorAlcalinidad)) * ($valorSuperiorAlcalinidad - $valorInferiorAlcalinidad));
        /* Fin funcion para sacar el indice del Alcalinidad */


        $phSeleccionado = $request->ph;

        $resultadoIndiceLangelier = $phSeleccionado + $indiceLangelierTemperatura + $indiceLangelierDureza + $indiceLangelierAlcalinidad - 12.5;
        $validacionIndiceSuperior = $resultadoIndiceLangelier >  0.5 ? true : false;
        $validacionIndiceInferior = $resultadoIndiceLangelier < -0.5 ? true : false;

        // Devolver la respuesta en formato JSON
        return response()->json([
            //'valorInferiorTemperatura'    => $valorInferiorTemperatura,
            //'valorSuperiorTemperatura'    => $valorSuperiorTemperatura,
            //'valorCalculadoTemperatura'   => $valorCalculadoTemperatura,
            //'claveInferiorTemperatura'    => $claveInferiorTemperatura,
            //'claveSuperiorTemperatura'    => $claveSuperiorTemperatura,
            'indiceLangelierTemperatura'    => $indiceLangelierTemperatura,

            //'valorInferiorDureza'         => $valorInferiorDureza,
            //'valorSuperiorDureza'         => $valorSuperiorDureza,
            //'valorCalculadoDureza'        => $valorCalculadoDureza,
            //'claveInferiorDureza'         => $claveInferiorDureza,
            //'claveSuperiorDureza'         => $claveSuperiorDureza,
            'indiceLangelierDureza'         => $indiceLangelierDureza,

            //'valorInferiorAlcalinidad'    => $valorInferiorAlcalinidad,
            //'valorSuperiorAlcalinidad'    => $valorSuperiorAlcalinidad,
            //'valorCalculadoAlcalinidad'   => $valorCalculadoAlcalinidad,
            //'claveInferiorAlcalinidad'    => $claveInferiorAlcalinidad,
            //'claveSuperiorAlcalinidad'    => $claveSuperiorAlcalinidad,
            'indiceLangelierAlcalinidad'    => $indiceLangelierAlcalinidad,
            'resultadoIndiceLangelier'      => $resultadoIndiceLangelier,
            'validacionIndiceSuperior'      => $validacionIndiceSuperior,
            'validacionIndiceInferior'      => $validacionIndiceInferior

        ]);
    }
}
