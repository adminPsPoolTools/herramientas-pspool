<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelosFiltros;
use Illuminate\Http\Request;

class ModelosFiltrosController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $modelos = ModelosFiltros::all();
        return view('admin.filtros.modelos.modelos', compact('modelos'));
    }

    public function edit(Request $request)
    {
        $modelo = ModelosFiltros::find($request->id);
        return view('admin.filtros.modelos.edit', compact('modelo'));
    }

    public function update(Request $request)
    {
        $modelo = ModelosFiltros::find($request->id);
        $modelo->descripcion = $request->input('descripcion');
        $modelo->save();
        return redirect()->route('admin.modelos.filtros', $modelo);
    }

    
    public function delete(Request $request)
    {
        $modelo = ModelosFiltros::find($request->id);
        $modelo->delete();
        return redirect()->route('admin.modelos.filtros', $modelo);
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion'   => 'required',
         ]);

         $modelo = ModelosFiltros::create($request->all());
         $modelo->save();

         return redirect()->route('admin.modelos.filtros', $modelo);
    }

    public function create()
    {
         return view('admin.filtros.modelos.create');
    }
}
