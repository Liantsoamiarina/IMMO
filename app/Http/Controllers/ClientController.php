<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class ClientController extends Controller
{
    /**
     * Afficher la liste des clients
     */
    public function index()
    {
        // Récupérer tous les utilisateurs (ou seulement les clients selon votre besoin)
        // Si vous voulez seulement les clients :
        $clients = User::where('role', 'client')
            ->latest()
            ->get();

        // Si vous voulez tous les utilisateurs sauf les admins :
        // $clients = User::whereIn('role', ['client', 'owner'])
        //     ->latest()
        //     ->get();

        // Si vous voulez TOUS les utilisateurs :
        // $clients = User::latest()->get();

        return view('admin.clients', compact('clients'));
    }
}
