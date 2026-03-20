<?php

namespace App\Http\Controllers\ConfiguradorPscover;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfiguradorPsCoverController extends Controller
{
    public function index(Request $request)
    {
        $userCod = $request->query('user');
        $user = $userCod;

        return view('configuradorpscover.index', compact('user'));

        // if ($user == '14071') {
        //     return view('configuradorpscover.index', compact('user'));
        // } else {
        //     //return view('configuradorpscover.index', compact('user'));
        //     return view('mantenimiento.index', compact('user'));
        // }
    }
}
