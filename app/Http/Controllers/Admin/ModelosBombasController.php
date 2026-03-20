<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bombas;
use App\Models\ModelosBombas;
use Illuminate\Http\Request;

class ModelosBombasController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bombas = Bombas::all();
        $modelos = ModelosBombas::all();
        $bombasPorModelo = $bombas->groupBy('fk_modelo');
        return view('admin.bombas.modelos.modelos', compact('bombas', 'modelos' , 'bombasPorModelo'));
    }

    public function create()
    {
         return view('admin.bombas.modelos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion'   => 'required',
         ]);

         $modelo = ModelosBombas::create($request->all());
         $modelo->save();

         return redirect()->route('admin.modelos.bombas', $modelo);
    }

    public function update(Request $request)
    {
        $modelo = ModelosBombas::find($request->id);
        $modelo->descripcion = $request->input('descripcion');
        $modelo->save();
        return redirect()->route('admin.modelos.bombas', $modelo);
    }

    
    public function delete(Request $request)
    {
        $modelo = ModelosBombas::find($request->id);
        $modelo->delete();
        return redirect()->route('admin.modelos.bombas', $modelo);
    }

    public function edit(Request $request)
    {
        $modelo = ModelosBombas::find($request->id);
        return view('admin.bombas.modelos.edit', compact('modelo'));
    }
}
