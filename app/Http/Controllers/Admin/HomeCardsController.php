<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homes;
use Illuminate\Http\Request;

class HomeCardsController extends Controller
{
    public function index()
    {

        $cards = Homes::all();
        return view('admin.home.index', compact('cards'));
    }

    public function edit(Request $request)
    {
        $card = Homes::find($request->id);
        return view('admin.home.edit', compact('card'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'url'       => 'required',
            'alt_title' => 'required',
            'imagen'    => 'required',
            'titulo'    => 'required',
            'parrafo'   => 'required',
            'boton'     => 'required',
            'activo'    => 'required',
        ]);

        $card = Homes::find($request->id);
        $card->url = $request->input('url');
        $card->alt_title = $request->input('alt_title');
        $card->imagen = $request->input('imagen');
        $card->titulo = $request->input('titulo');
        $card->parrafo = $request->input('parrafo');
        $card->boton = $request->input('boton');
        $card->int_ext = $request->input('int_ext');
        $card->activo = $request->input('activo');
        $card->save();
        return redirect()->route('home.index', $card);
    }

    public function delete(Request $request)
    {
        $card = Homes::find($request->id);
        $card->delete();
        return redirect()->route('home.index', $card);
    }


    public function create()
    {
        return view('admin.home.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url'       => 'required',
            'alt_title' => 'required',
            'imagen'    => 'required',
            'titulo'    => 'required',
            'parrafo'   => 'required',
            'boton'     => 'required',
            'activo'     => 'required',
        ]);

        $card = Homes::create($request->all());
        $card->save();
        return redirect()->route('home.index', $card);
    }
}
