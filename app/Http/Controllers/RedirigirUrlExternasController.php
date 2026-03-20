<?php

namespace App\Http\Controllers;

use App\Models\Homes;
use Illuminate\Http\Request;

class RedirigirUrlExternasController extends Controller
{
    public function handleRedirect(Request $request)
    {
        $url = $request->input('id');
        $card = Homes::find($url);
        return redirect()->away($card->url);
    }
}
