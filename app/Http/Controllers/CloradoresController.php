<?php

namespace App\Http\Controllers;

use App\Models\Cloradores;
use App\Models\ModelosCloradores;
use Illuminate\Http\Request;

class CloradoresController extends Controller
{
    private $valorPrivada = 2;
    private $valorPublica = 3.5;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('cloradores.index', compact('user'));
    }

    public function calcular(Request $request)
    {

        $request->validate([
            'numero_banyistas'  => 'required',
            'volumen_piscina'   => 'required',
            'horas_filtracion'  => 'required',
            'tipo_piscina'      => 'required',
            'temp'              => 'required'

        ]);

        $numBanyistas   = intval($request->numero_banyistas);
        $volPiscina     = intval($request->volumen_piscina);
        $horasFilt      = intval($request->horas_filtracion);
        $tipoPiscina    = $request->tipo_piscina;
        $temp           = $request->temp;

        if ($tipoPiscina == "privada") {
            if ($temp == "0") {
                $resultado  = round((($volPiscina * $this->valorPrivada)) / $horasFilt, 2);
            } else {
                $resultado  = round((($volPiscina * $this->valorPublica)) / $horasFilt, 2);
            }
        } else {
            if ($temp == "0") {
                $resultado  = round((($numBanyistas * 10) + ($volPiscina * $this->valorPrivada)) / $horasFilt, 2);
            } else {
                $resultado  = round((($numBanyistas * 10) + ($volPiscina * $this->valorPublica)) / $horasFilt, 2);
            }
        }

        $articulos      = Cloradores::where('valor', '>', $resultado)->orderBy('valor', 'asc')->get(); // Devuelve el primer resultado que sea mayor al resultado.

        // Obtener todos los modelos con sus nombres
        $modelos = ModelosCloradores::all()->pluck('descripcion', 'id');

        // Agrupar los cloradores por modelo.
        $cloradoresPorModelo = $articulos->groupBy('fk_modelo');

        $primerResultadoPorModelo = $cloradoresPorModelo->map(function ($articulos, $modeloId) use ($modelos) {
            $primerArticulo = $articulos->first();
            return [
                'descripcion' => $primerArticulo->descripcion,
                'valor' => $primerArticulo->valor,
                'url' => $primerArticulo->url,
                'nombre_modelo' => $modelos[$modeloId] ?? 'Desconocido'
            ];
        })->toArray();

        // Devolver la respuesta en formato JSON
        return response()->json([
            'numBanyistas' => $numBanyistas,
            'volPiscina' => $volPiscina,
            'horasFilt' => $horasFilt,
            'resultado' => $resultado,
            'articulos' => $articulos,
            'cloradoresPorModelo' => $primerResultadoPorModelo
        ]);
    }
}
