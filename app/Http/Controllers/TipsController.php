<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipsController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->query('token');
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }
        return view('tips.index', compact('user'));
    }
    public function topclean(Request $request)
    {
        $token = $request->query('token');
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }
        return view('tips.topclean.index', compact('user'));
    }

    public function filtros(Request $request)
    {
        $token = $request->query('token');
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }
        return view('tips.filtros.index', compact('user'));
    }
    public function tratamiento(Request $request)
    {
        $token = $request->query('token');
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }
        return view('tips.tratamiento.index', compact('user'));
    }
    public function tratamientoFiltracion(Request $request)
    {
        $token = $request->query('token');
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }
        return view('tips.tratamiento.filtracion.index', compact('user'));
    }
    public function tratamientoLangelier(Request $request)
    {
        $token = $request->query('token');
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }
        return view('tips.tratamiento.langelier.index', compact('user'));
    }

    private function isBase64($str)
    {
        return is_string($str) &&
            base64_encode(base64_decode($str, true)) === $str &&
            preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $str);
    }
}
