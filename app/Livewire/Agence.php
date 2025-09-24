<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Agence extends Component
{
    use WithFileUploads;

    // Variables du formulaire
    public $title, $description, $price, $type = "appartement", $transaction_type = "vente",
           $surface, $rooms, $floors, $parking = false, $address, $city, $country;

    public $images = [];
    public $maxFiles = 10;

    // Pour l'édition et suppression
    public $editingProperty, $editingId, $deletingProperty;
    public $properties;

    protected $rules = [
        'title' => 'required|string|max:255',
        'price' => 'required|numeric',
        'type' => 'required|string',
        'transaction_type' => 'required|in:vente,location',
        'surface' => 'nullable|integer|min:0',
        'rooms' => 'nullable|integer|min:0',
        'floors' => 'nullable|integer|min:0',
        'parking' => 'boolean',
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'images' => 'nullable|array|max:10',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
    ];

    public function mount()
    {
        // Ne pas charger les propriétés immédiatement pour éviter le loading
        $this->properties = collect([]);
        // Utiliser un dispatch pour charger après le rendu initial
        $this->dispatch('load-properties');
    }

    public function loadPropertiesData()
    {
        $this->properties = Property::with('images')->latest()->get();
    }

    public function loadProperties()
    {
        $this->properties = Property::with('images')->latest()->get();
    }

    public function updatedImages()
    {
        $this->validateOnly('images.*');
        if (count($this->images) > $this->maxFiles) {
            $this->images = array_slice($this->images, 0, $this->maxFiles);
            session()->flash('error', "Maximum {$this->maxFiles} images.");
        }
    }

    public function updatedType()
    {
        // Si c'est un terrain, on remet à zéro les champs non applicables
        if ($this->type === 'terrain') {
            $this->rooms = null;
            $this->floors = null;
            $this->parking = false;
        }
    }

    public function removeTempImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }

    public function save()
    {
        $this->validate();

        if ($this->type === 'terrain') {
            $this->rooms = null;
            $this->floors = null;
            $this->parking = false;
        }

        // Création de la propriété
        $property = Auth::user()->properties()->create([
            'title'             => $this->title,
            'description'       => $this->description,
            'price'             => $this->price,
            'type'              => $this->type,
            'transaction_type'  => $this->transaction_type,
            'surface'           => $this->surface,
            'rooms'             => $this->rooms,
            'floors'            => $this->floors,
            'parking'           => (bool) $this->parking,
            'address'           => $this->address,
            'city'              => $this->city,
            'country'           => $this->country,
        ]);

        // Sauvegarde des images
        foreach ($this->images as $image) {
            $path = $image->store('properties', 'public');
            PropertyImage::create([
                'property_id' => $property->id,
                'image_path'  => $path,
            ]);
        }

        // Recharger les propriétés
        $this->loadProperties();

        // Reset et notifications
        $this->resetForm();
        $this->dispatch('close-modal');
        $this->dispatch('show-toast', [
            'type' => 'success',
            'message' => 'Propriété créée avec succès!'
        ]);
    }

    public function edit($id)
    {
        $this->editingProperty = Property::with('images')->findOrFail($id);
        $this->editingId = $id;

        // Remplir le formulaire
        $this->title = $this->editingProperty->title;
        $this->price = $this->editingProperty->price;
        $this->description = $this->editingProperty->description;
        $this->type = $this->editingProperty->type;
        $this->transaction_type = $this->editingProperty->transaction_type;
        $this->surface = $this->editingProperty->surface;
        $this->rooms = $this->editingProperty->rooms;
        $this->floors = $this->editingProperty->floors;
        $this->parking = $this->editingProperty->parking;
        $this->address = $this->editingProperty->address;
        $this->city = $this->editingProperty->city;
        $this->country = $this->editingProperty->country;

        $this->dispatch('open-modal', ['modal' => 'editPropertyModal']);
    }

    public function update()
    {
        $this->validate();

        $property = Property::findOrFail($this->editingId);

        if ($this->type === 'terrain') {
            $this->rooms = null;
            $this->floors = null;
            $this->parking = false;
        }

        // Mise à jour de la propriété
        $property->update([
            'title'             => $this->title,
            'description'       => $this->description,
            'price'             => $this->price,
            'type'              => $this->type,
            'transaction_type'  => $this->transaction_type,
            'surface'           => $this->surface,
            'rooms'             => $this->rooms,
            'floors'            => $this->floors,
            'parking'           => (bool) $this->parking,
            'address'           => $this->address,
            'city'              => $this->city,
            'country'           => $this->country,
        ]);

        // Gestion des nouvelles images si fournies
        if ($this->images && count($this->images) > 0) {
            // Supprimer les anciennes images
            foreach ($property->images as $oldImage) {
                Storage::disk('public')->delete($oldImage->image_path);
                $oldImage->delete();
            }

            // Ajouter les nouvelles images
            foreach ($this->images as $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path'  => $path,
                ]);
            }
        }

        $this->loadProperties();
        $this->resetForm();
        $this->editingId = null;
        $this->editingProperty = null;

        $this->dispatch('close-modal');
        $this->dispatch('show-toast', [
            'type' => 'success',
            'message' => 'Propriété modifiée avec succès!'
        ]);
    }

    public function confirmDelete($id)
    {
        $this->deletingProperty = Property::findOrFail($id);
        $this->dispatch('open-modal', ['modal' => 'deletePropertyModal']);
    }

    public function delete()
    {
        if ($this->deletingProperty) {
            // Supprimer toutes les images associées
            foreach ($this->deletingProperty->images as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }

            // Supprimer la propriété
            $this->deletingProperty->delete();
            $this->loadProperties();
            $this->deletingProperty = null;

            $this->dispatch('close-modal');
            $this->dispatch('show-toast', [
                'type' => 'success',
                'message' => 'Propriété supprimée avec succès!'
            ]);
        }
    }

    public function resetForm()
    {
        $this->reset([
            'title','description','price','surface',
            'rooms','floors','address','city','country','images'
        ]);
        $this->resetValidation();

        // Remettre les valeurs par défaut
        $this->type = "appartement";
        $this->transaction_type = "vente";
        $this->parking = false;
    }

    public function render()
    {
        return view('livewire.agence');
    }
}
