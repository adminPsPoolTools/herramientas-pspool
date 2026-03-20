<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelosCloradores;
use Illuminate\Http\Request;

class ModelosCloradoresController extends Controller
{
        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $modelos = ModelosCloradores::all();
        return view('admin.cloradores.modelos.modelos', compact('modelos'));
    }

    public function edit(Request $request)
    {
        $modelo = ModelosCloradores::find($request->id);
        return view('admin.cloradores.modelos.edit', compact('modelo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion'   => 'required',
         ]);

         $modelo = ModelosCloradores::create($request->all());
         $modelo->save();

         return redirect()->route('admin.modelos.cloradores', $modelo);
    }

    public function create()
    {
         return view('admin.cloradores.modelos.create');
    }

    public function update(Request $request)
    {
        $modelo = ModelosCloradores::find($request->id);
        $modelo->descripcion = $request->input('descripcion');
        $modelo->save();
        return redirect()->route('admin.modelos.cloradores', $modelo);
    }

    public function delete(Request $request)
    {
        $modelo = ModelosCloradores::find($request->id);
        $modelo->delete();
        return redirect()->route('admin.modelos.cloradores', $modelo);
    }
}
