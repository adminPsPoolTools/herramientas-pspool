<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CombisController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('combis.index', compact('user'));
    }
}
