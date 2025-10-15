<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    /**
     * Afficher la liste de toutes les propriétés
     */
    public function index()
    {
        $properties = Property::with(['images', 'user'])
            ->latest()
            ->paginate(12);

        return view('home', compact('properties'));
    }

    /**
     * Afficher les propriétés de l'agence connectée
     */
    public function AgenceProperty()
    {
        // Cette vue utilise le composant Livewire pour la gestion
        return view('agence.agenceproperty');
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('admin.createproperty');
    }

    /**
     * Enregistrer une nouvelle propriété
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'type' => 'required|string',
            'transaction_type' => 'required|in:vente,location',
            'surface' => 'nullable|integer|min:0',
            'rooms' => 'nullable|integer|min:0',
            'floors' => 'nullable|integer|min:0',
            'parking' => 'nullable|boolean',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB max
        ]);

        DB::beginTransaction();

        try {
            // Créer la propriété
            $validated['user_id'] = Auth::id();
            $validated['parking'] = $request->has('parking') ? true : false;

            $property = Property::create($validated);

            // Gérer les images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('properties', 'public');

                    PropertyImage::create([
                        'property_id' => $property->id,
                        'image_path' => $path,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('agence.properties')
                ->with('success', 'Propriété créée avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la création : ' . $e->getMessage());
        }
    }

    /**
     * Afficher les détails d'une propriété
     */
    public function show(Property $property)
    {
        // Charger les relations
        $property->load(['images', 'user']);

        // Propriétés similaires
        $similarProperties = Property::with('images')
            ->where('id', '!=', $property->id)
            ->where('type', $property->type)
            ->where('transaction_type', $property->transaction_type)
            ->limit(3)
            ->get();

        return view('properties.show', compact('property', 'similarProperties'));
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit(Property $property)
    {
        // Vérifier que l'utilisateur est propriétaire
        if ($property->user_id !== Auth::id()) {
            abort(403, 'Action non autorisée.');
        }

        $property->load('images');

        return view('properties.edit', compact('property'));
    }

    /**
     * Mettre à jour une propriété
     */
    public function update(Request $request, Property $property)
    {
        // Vérifier que l'utilisateur est propriétaire
        if ($property->user_id !== Auth::id()) {
            abort(403, 'Action non autorisée.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'type' => 'required|string',
            'transaction_type' => 'required|in:vente,location',
            'surface' => 'nullable|integer|min:0',
            'rooms' => 'nullable|integer|min:0',
            'floors' => 'nullable|integer|min:0',
            'parking' => 'nullable|boolean',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:property_images,id',
        ]);

        DB::beginTransaction();

        try {
            // Mettre à jour les informations
            $validated['parking'] = $request->has('parking') ? true : false;
            $property->update($validated);

            // Supprimer les images sélectionnées
            if ($request->has('delete_images')) {
                foreach ($request->delete_images as $imageId) {
                    $image = PropertyImage::find($imageId);
                    if ($image && $image->property_id === $property->id) {
                        Storage::disk('public')->delete($image->image_path);
                        $image->delete();
                    }
                }
            }

            // Ajouter de nouvelles images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('properties', 'public');

                    PropertyImage::create([
                        'property_id' => $property->id,
                        'image_path' => $path,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('agence.properties')
                ->with('success', 'Propriété mise à jour avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    /**
     * Supprimer une propriété
     */
    public function destroy(Property $property)
    {
        // Vérifier que l'utilisateur est propriétaire
        if ($property->user_id !== Auth::id()) {
            abort(403, 'Action non autorisée.');
        }

        DB::beginTransaction();

        try {
            // Supprimer toutes les images du stockage
            foreach ($property->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }

            // Supprimer la propriété (les images seront supprimées en cascade)
            $property->delete();

            DB::commit();

            return redirect()
                ->route('agence.properties')
                ->with('success', 'Propriété supprimée avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }

    /**
     * Supprimer une image spécifique
     */
    public function deleteImage(PropertyImage $image)
    {
        // Vérifier que l'utilisateur est propriétaire
        if ($image->property->user_id !== Auth::id()) {
            abort(403, 'Action non autorisée.');
        }

        try {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image supprimée avec succès'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression'
            ], 500);
        }
    }
}
