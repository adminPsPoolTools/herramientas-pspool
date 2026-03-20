<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JetsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('jets.index', compact('user'));
    }
}
