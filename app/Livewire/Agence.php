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
    $this->loadProperties();
    $this->isLoading = false;
}

public function loadPropertiesData()
{
    $this->properties = Property::with('images')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

    \Log::info('Properties loaded: ' . $this->properties->count() . ' for user ' . Auth::id());
}

public function loadProperties()
{
    $this->properties = Property::with('images')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();
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

    // Dispatcher un événement pour ouvrir SweetAlert
    $this->dispatch('open-edit-modal', property: $this->editingProperty->toArray());
}

public function confirmDelete($id)
{
    $this->deletingProperty = Property::findOrFail($id);

    // Dispatcher un événement pour SweetAlert
    $this->dispatch('confirm-delete', [
        'id' => $id,
        'title' => $this->deletingProperty->title
    ]);
}

public function delete($id)
{
    $property = Property::where($id);

    // Vérifier que c'est bien la propriété de l'utilisateur
    if ($property->user_id !== Auth::id()) {
        $this->dispatch('show-toast', [
            'type' => 'error',
            'message' => 'Vous n\'avez pas la permission de supprimer cette propriété.'
        ]);
        return;
    }

    // Supprimer les images
    foreach ($property->images as $image) {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
    }

    // Supprimer la propriété
    $property->delete();

    // Recharger les propriétés
    $this->loadProperties();

    $this->dispatch('show-toast', [
        'type' => 'success',
        'message' => 'Propriété supprimée avec succès!'
    ]);
}

public function update()
{
    $this->validate();

    $property = Property::findOrFail($this->editingId);

    // Vérifier que c'est bien la propriété de l'utilisateur
    if ($property->user_id !== Auth::id()) {
        $this->dispatch('show-toast', [
            'type' => 'error',
            'message' => 'Vous n\'avez pas la permission de modifier cette propriété.'
        ]);
        return;
    }

    if ($this->type === 'terrain') {
        $this->rooms = null;
        $this->floors = null;
        $this->parking = false;
    }

    // Mise à jour
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

    // Gestion des nouvelles images
    if ($this->images && count($this->images) > 0) {
        foreach ($property->images as $oldImage) {
            Storage::disk('public')->delete($oldImage->image_path);
            $oldImage->delete();
        }

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

    $this->dispatch('show-toast', [
        'type' => 'success',
        'message' => 'Propriété modifiée avec succès!'
    ]);
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
    //     dd([
    //     'user_authenticated' => Auth::check(),
    //     'user_id' => Auth::id(),
    //     'properties_count' => $this->properties->count(),
    //     'properties' => $this->properties
    // ]);
        return view('livewire.agence');
    }
}
