<?php

namespace App\Http\Controllers;

use App\Models\Bombas;
use App\Models\Filtros;
use App\Models\ModelosBombas;
use App\Models\ModelosFiltros;
use Illuminate\Http\Request;

class HidraulicaController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('hidraulica.index', compact('user'));
    }

    public function calcular(Request $request)
    {

        //Pedimos valores obligatorios
        $request->validate([
            'superficie'            => 'required',
            'profundidad'           => 'required',
            'desbordante'           => 'required',
            'tiempo'                => 'required',
            'velocidad_filtrado'    => 'required'
        ]);

        //Recogemos los valores del formulario
        $superficie             = doubleval($request->superficie);
        $profundidad            = doubleval($request->profundidad);
        $volumen_deposito       = doubleval($request->volumen_deposito);
        $tiempo                 = doubleval($request->tiempo);
        $velocidad_filtrado     = doubleval($request->velocidad_filtrado);
        $tipoPiscina           = $request->tipo_piscina;

        $volumenVaso = $superficie * $profundidad;
        $volumenTotal = $volumenVaso + $volumen_deposito;
        $caudal = $volumenTotal / $tiempo;

        //Calculamos el filtro necesario
        $superficie_necesaria = round($caudal / $velocidad_filtrado, 2);

        $filtros = Filtros::where('superficie_filtrante', '>', $superficie_necesaria)
            ->where('tipo_filtro', $tipoPiscina)
            ->orderBy('superficie_filtrante', 'asc')
            ->get(); // Devuelve el primer resultado que sea mayor al resultado.
        $modelosFiltros = ModelosFiltros::all()->pluck('descripcion', 'id');
        $filtrosPorModelo = $filtros->groupBy('fk_modelo');

        $primerResultadoPorModeloFiltro = $filtrosPorModelo->map(function ($filtros, $modeloId) use ($modelosFiltros) {
            $primerArticulo = $filtros->first();
            return [
                'descripcion' => $primerArticulo->descripcion,
                'superficie_filtrante' => $primerArticulo->superficie_filtrante,
                'url' => $primerArticulo->url,
                'tipo_filtro' => $primerArticulo->tipo_filtro,
                'nombre_modelo' => $modelosFiltros[$modeloId] ?? 'Desconocido'
            ];
        })->toArray();


        //Calculamos la bomba necesaria
        $velocidadAFM   = 45;
        $qLavado = round($superficie_necesaria * $velocidadAFM, 2);
        $bombas = Bombas::where('caudal', '>=', $qLavado)->orderBy('caudal', 'asc')->get(); // Devuelve el primer resultado que sea mayor al resultado.

        $modelosBombas = ModelosBombas::all()->pluck('descripcion', 'id');
        $bombasPorModelo = $bombas->groupBy('fk_modelo');

        $primerResultadoPorModeloBomba = $bombasPorModelo->map(function ($bombas, $modeloId) use ($modelosBombas) {
            $primerArticulo = $bombas->first();
            return [
                'descripcion' => $primerArticulo->descripcion,
                'caudal' => $primerArticulo->caudal,
                'url' => $primerArticulo->url,
                'nombre_modelo' => $modelosBombas[$modeloId] ?? 'Desconocido'
            ];
        })->toArray();

        // Devolver la respuesta en formato JSON
        return response()->json([
            'superficie_necesaria' => $superficie_necesaria,
            'qLavado' => $qLavado,
            'primerResultadoPorModeloBomba' => $primerResultadoPorModeloBomba,
            'primerResultadoPorModeloFiltro' => $primerResultadoPorModeloFiltro
        ]);
    }
}
