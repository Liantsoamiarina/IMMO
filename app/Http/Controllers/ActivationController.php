<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivationController extends Controller
{
    /**
     * Envoyer l'email d'activation après inscription
     */
    public function sendActivationEmail(Request $request)
    {
        $request->validate([
            'agence_id' => 'required|email',
        ]);
    }
}
