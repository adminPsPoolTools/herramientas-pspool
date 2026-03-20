<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bombas;
use App\Models\ModelosBombas;
use Illuminate\Http\Request;

class BombasController extends Controller
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
        return view('admin.bombas.index', compact('bombas', 'modelos' , 'bombasPorModelo'));
    }

    public function create()
    {
        $modelos = ModelosBombas::all();
         return view('admin.bombas.create', compact('modelos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo'        => 'required',
            'descripcion'   => 'required',
            'caudal'        => 'required',
            'fk_modelo'     => 'required'
        ]);
   
        $bombas = Bombas::create($request->all());
        $bombas->save();
        return redirect()->route('admin.bombas', $bombas);
    }

    public function edit(Request $request)
    {
        $bombas = Bombas::find($request->id);
        $modelos = ModelosBombas::all();
        return view('admin.bombas.edit', compact('bombas' ,'modelos'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'codigo'        => 'required',
            'descripcion'   => 'required',
            'caudal'        => 'required',
            'fk_modelo'     => 'required'
        ]);
   
        $bomba = Bombas::find($request->id);
        $bomba->codigo = $request->input('codigo');
        $bomba->descripcion = $request->input('descripcion');
        $bomba->caudal = $request->input('caudal');
        $bomba->url = $request->input('url');
        $bomba->fk_modelo = $request->input('fk_modelo');
        $bomba->save();

        return redirect()->route('admin.bombas', $bomba);
    }

    public function delete(Request $request)
    {
        $bombas = Bombas::find($request->id);
        $bombas->delete();
        return redirect()->route('admin.bombas', $bombas);
    }

}
