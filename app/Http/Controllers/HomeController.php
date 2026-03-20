<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Homes;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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

        if ($token !== env('ACCESS_TOKEN_HERRAMIENTAS')) {
            abort(403, 'Acceso denegado');
        }

        $cards = Homes::where('activo', 'S')->get();
        return view('home.index', compact('cards', 'user'));
    }

    private function isBase64($str)
    {
        return is_string($str) &&
            base64_encode(base64_decode($str, true)) === $str &&
            preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $str);
    }
}
