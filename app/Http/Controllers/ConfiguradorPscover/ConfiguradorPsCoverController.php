<?php

namespace App\Http\Controllers\ConfiguradorPscover;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ConfiguradorPsCoverController extends Controller
{
    public function index(Request $request)
    {
        $userCod = $request->query('user');
        $userEmail = $request->query('userEmail');
        $user = $userCod;

        if ($userEmail) {
            $this->notifyWebhook($userEmail);
        }

        return view('configuradorpscover.index', compact('user', 'userEmail'));

        // if ($user == '14071') {
        //     return view('configuradorpscover.index', compact('user'));
        // } else {
        //     //return view('configuradorpscover.index', compact('user'));
        //     return view('mantenimiento.index', compact('user'));
        // }
    }

    private function notifyWebhook(string $userEmail): void
    {
        try {
            Http::timeout(5)->post(
                'https://webhook-api.connectif.cloud/b68625a9-ddfe-4f57-9b67-e126f1350326/custom-events/alias/herramienta-cubiertas',
                ['campo-1' => $userEmail]
            );
        } catch (\Exception $e) {
            Log::warning('Fallo al notificar webhook Connectif (herramienta-cubiertas): ' . $e->getMessage());
        }
    }
}
