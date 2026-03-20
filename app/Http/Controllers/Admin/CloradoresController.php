<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cloradores;
use App\Models\ModelosCloradores;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CloradoresController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cloradores = Cloradores::all();
        $modelos = ModelosCloradores::all();
        $cloradoresPorModelo = $cloradores->groupBy('fk_modelo');
        return view('admin.cloradores.index', compact('cloradores', 'modelos' , 'cloradoresPorModelo'));
    }

    public function edit(Request $request)
    {
        $cloradores = Cloradores::find($request->id);
        $modelos = ModelosCloradores::all();
        return view('admin.cloradores.edit', compact('cloradores' ,'modelos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo'        => 'required',
            'descripcion'   => 'required',
            'valor'         => 'required',
            //'url'           => 'required',
            'fk_modelo'     => 'required',
        ]);
   
        $clorador = Cloradores::create($request->all());
        $clorador->save();
        return redirect()->route('admin.cloradores', $clorador);
    }

    public function update(Request $request)
    {
        $request->validate([
            'codigo'        => 'required',
            'descripcion'   => 'required',
            'valor'         => 'required',
            //'url'           => 'required',
            'fk_modelo'     => 'required',
        ]);
   
        $clorador = Cloradores::find($request->id);
        $clorador->codigo = $request->input('codigo');
        $clorador->descripcion = $request->input('descripcion');
        $clorador->valor = $request->input('valor');
        $clorador->url = $request->input('url');
        $clorador->fk_modelo = $request->input('fk_modelo');
        $clorador->save();
        return redirect()->route('admin.cloradores', $clorador);
    }

    public function delete(Request $request)
    {
        $clorador = Cloradores::find($request->id);
        $clorador->delete();
        return redirect()->route('admin.cloradores', $clorador);
    }

    public function create()
    {
        $modelos = ModelosCloradores::all();
         return view('admin.cloradores.create', compact('modelos'));
    }
}
