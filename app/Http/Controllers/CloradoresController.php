<?php

namespace App\Http\Controllers;

use App\Models\Cloradores;
use App\Models\ModelosCloradores;
use Illuminate\Http\Request;

class CloradoresController extends Controller
{
    private $valorBanyista = 10;
    private $valorVolumen = 3;
    private $valorVolumen28 = 3.5;
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
            'temp' => 'required'
        ]);

        $numBanyistas   = intval($request->numero_banyistas);
        $volPiscina     = intval($request->volumen_piscina);
        $horasFilt      = intval($request->horas_filtracion);
        $temp           = intval($request->temp);

        if ($temp === 1) {
            $resultado = ($numBanyistas * $this->valorBanyista) + ($volPiscina * $this->valorVolumen28) / $horasFilt;
        } else {
            $resultado = ($numBanyistas * $this->valorBanyista) + ($volPiscina * $this->valorVolumen) / $horasFilt;
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
