<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Filtros;
use App\Models\ModelosFiltros;
use Illuminate\Http\Request;

class FiltrosController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $filtros = Filtros::all();
        $modelos = ModelosFiltros::all();
        $filtrosPorModelo = $filtros->groupBy('fk_modelo');
        return view('admin.filtros.index', compact('filtros', 'modelos', 'filtrosPorModelo'));
    }

    public function create()
    {
        $modelos = ModelosFiltros::all();
        return view('admin.filtros.create', compact('modelos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo'        => 'required',
            'descripcion'   => 'required',
            'diametro'      => 'required',
            'tipo_filtro'   => 'required',
            'fk_modelo'     => 'required',
        ]);

        $filtros = Filtros::create($request->all());
        $filtros->save();
        return redirect()->route('admin.filtros', $filtros);
    }

    public function edit(Request $request)
    {
        $filtros = Filtros::find($request->id);
        $modelos = ModelosFiltros::all();
        return view('admin.filtros.edit', compact('filtros', 'modelos'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'codigo'                => 'required',
            'descripcion'           => 'required',
            'tipo_filtro'           => 'required',
            'diametro'              => 'required',
            'superficie_filtrante'  => 'required',
            'fk_modelo'             => 'required',
        ]);

        $filtro = Filtros::find($request->id);
        $filtro->codigo = $request->input('codigo');
        $filtro->descripcion = $request->input('descripcion');
        $filtro->diametro = $request->input('diametro');
        $filtro->url = $request->input('url');
        $filtro->fk_modelo = $request->input('fk_modelo');
        $filtro->tipo_filtro = $request->input('tipo_filtro');
        $filtro->save();

        return redirect()->route('admin.filtros', $filtro);
    }

    public function delete(Request $request)
    {
        $filtros = Filtros::find($request->id);
        $filtros->delete();
        return redirect()->route('admin.filtros', $filtros);
    }
}
