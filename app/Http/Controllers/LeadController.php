<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Property;
use App\Mail\ContactAgenceMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    /**
     * Afficher le formulaire de contact
     */
    public function create($propertyId)
    {
        $property = Property::with(['user', 'images'])->findOrFail($propertyId);

        // Vérifier que l'utilisateur ne contacte pas sa propre propriété
        if (Auth::id() === $property->user_id) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas contacter votre propre annonce.');
        }

        return view('leads.create', compact('property'));
    }

    /**
     * Enregistrer et envoyer la demande
     */
    public function store(Request $request, $propertyId)
    {
        $property = Property::with('user')->findOrFail($propertyId);

        // Validation
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:20',
            'message' => 'required|string|min:10|max:1000',
        ], [
            'client_name.required' => 'Le nom est obligatoire.',
            'client_email.required' => 'L\'email est obligatoire.',
            'client_email.email' => 'Veuillez entrer un email valide.',
            'client_phone.required' => 'Le téléphone est obligatoire.',
            'message.required' => 'Le message est obligatoire.',
            'message.min' => 'Le message doit contenir au moins 10 caractères.',
            'message.max' => 'Le message ne peut pas dépasser 1000 caractères.',
        ]);

        // Créer le lead
        $lead = Lead::create([
            'property_id' => $property->id,
            'user_id' => Auth::id(),
            'agency_id' => $property->user_id,
            'type' => $property->transaction_type, // 'location' ou 'vente'
            'client_name' => $validated['client_name'],
            'client_email' => $validated['client_email'],
            'client_phone' => $validated['client_phone'],
            'message' => $validated['message'],
            'status' => 'nouveau'
        ]);

        // Envoyer l'email à l'agence
        try {
            Mail::to($property->user->email)->send(new ContactAgenceMail($lead, $property));

            return redirect()->route('homepage', $property->id)
                           ->with('success', ' Votre message a été envoyé avec succès ! L\'agence vous contactera bientôt.');
        } catch (\Exception $e) {
            // Si l'envoi échoue, on garde le lead en base
            return redirect()->route('properties.show', $property->id)
                           ->with('warning', '⚠️ Votre demande a été enregistrée, mais l\'email n\'a pas pu être envoyé. L\'agence sera notifiée.');
        }
    }

    /**
     * Voir les leads reçus (pour les agences)
     */
    public function index()
    {
        $leads = Lead::with(['property', 'user'])
            ->where('agency_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('leads.index', compact('leads'));
    }

    /**
     * Marquer comme contacté
     */
    public function markAsContacted($id)
    {
        $lead = Lead::where('agency_id', Auth::id())->findOrFail($id);
        $lead->markAsContacted();

        return back()->with('success', 'Lead marqué comme contacté.');
    }

    /**
     * Changer le statut
     */
    public function updateStatus(Request $request, $id)
    {
        $lead = Lead::where('agency_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:nouveau,contacte,en_cours,converti,perdu'
        ]);

        $lead->update(['status' => $validated['status']]);

        if ($validated['status'] === 'contacte') {
            $lead->update(['contacted_at' => now()]);
        }

        return back()->with('success', 'Statut mis à jour avec succès.');
    }
}
