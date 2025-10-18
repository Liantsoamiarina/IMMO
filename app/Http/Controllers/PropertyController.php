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
   public function show($id)
    {
        // Charger la propriété avec ses relations
        $property = Property::with(['user', 'images'])
            ->findOrFail($id);

        // Incrémenter le compteur de vues (commenté car colonne non existante)
        // $property->increment('views');

        // Récupérer des propriétés similaires
        $similarProperties = Property::with(['images'])
            ->where('id', '!=', $property->id)
            ->where(function($query) use ($property) {
                $query->where('city', $property->city)
                      ->where('transaction_type', $property->transaction_type);
            })
            ->orWhere(function($query) use ($property) {
                $query->where('type', $property->type)
                      ->where('transaction_type', $property->transaction_type)
                      ->where('id', '!=', $property->id);
            })
            ->limit(3)
            ->get();

        return view('propertiesDetails', compact('property', 'similarProperties'));
    }

    /**
     * Liste de toutes les propriétés
     */
    public function index(Request $request)
    {
        $query = Property::with(['user', 'images']);

        // Filtres
        if ($request->has('city') && $request->city) {
            $query->where('city', $request->city);
        }

        if ($request->has('transaction_type') && $request->transaction_type) {
            $query->where('transaction_type', $request->transaction_type);
        }

        if ($request->has('property_type') && $request->property_type) {
            $query->where('type', $request->property_type);
        }

        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        $properties = $query->latest()->take(3)->get();

        return view('home', compact('properties'));
    }

   public function allProperties(Request $request)
{
    $query = Property::with(['user', 'images']);

    // Recherche textuelle
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('city', 'LIKE', "%{$search}%")
              ->orWhere('address', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%");
        });
    }

    // Filtres simples
    if ($request->filled('city')) {
        $query->where('city', $request->city);
    }

    if ($request->filled('transaction_type')) {
        $query->where('transaction_type', $request->transaction_type);
    }

    if ($request->filled('property_type')) {
        $query->where('type', $request->property_type);
    }

    // Filtres de prix
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }

    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    // Pagination
    $properties = $query->latest()->paginate(9)->appends($request->query());

    // Villes disponibles
    $cities = Property::distinct()
        ->whereNotNull('city')
        ->pluck('city')
        ->filter()
        ->sort()
        ->values();

    return view('properties', compact('properties', 'cities'));
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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:20480',
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
