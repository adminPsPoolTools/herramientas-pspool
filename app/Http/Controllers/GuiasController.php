<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuiasController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }
        return view('guias.index', compact('user'));
    }

    public function guiaCalplas(Request $request)
    {
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }

        return view('guias.filtros.index', compact('user'));
    }

    public function guiaPrivada(Request $request)
    {
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }

        return view('guias.filtros.privado', compact('user'));
    }
    public function guiaPublico(Request $request)
    {
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }

        return view('guias.filtros.publico', compact('user'));
    }
    public function guiaAltoRend(Request $request)
    {
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }

        return view('guias.filtros.alto-rend', compact('user'));
    }
    public function guiaBombasSaci(Request $request)
    {
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }

        return view('guias.bombas.saci.index', compact('user'));
    }
    public function guiaBombasSaciPrivado(Request $request)
    {
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }

        return view('guias.bombas.saci.privado', compact('user'));
    }
    public function guiaBombasSaciPublico(Request $request)
    {
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }

        return view('guias.bombas.saci.publico', compact('user'));
    }
    public function guiaCloradores(Request $request)
    {
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }

        return view('guias.cloradores.index', compact('user'));
    }
    public function guiaCloradoresPrivado(Request $request)
    {
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }

        return view('guias.cloradores.privado', compact('user'));
    }
    public function guiaCloradoresPublico(Request $request)
    {
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }

        return view('guias.cloradores.publico', compact('user'));
    }
    public function guiaTopclean(Request $request)
    {
        $user = $request->query('user');

        if ($this->isBase64($user)) {
            $decoded = base64_decode($user, true);
            if ($decoded !== false) {
                $user = $decoded;
            }
        }

        return view('guias.topclean.index', compact('user'));
    }

    private function isBase64($str)
    {
        return is_string($str) &&
            base64_encode(base64_decode($str, true)) === $str &&
            preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $str);
    }
}
