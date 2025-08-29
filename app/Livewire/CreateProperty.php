<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;   // <-- IMPORT
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Auth;

class CreateProperty extends Component
{
    use WithFileUploads;   // <-- UTILISATION

    public $title, $description, $price, $type = "appartement", $transaction_type = "vente",
           $surface, $rooms, $floors, $parking = false, $address, $city, $country;

    //image
    public $images = [];
    public $maxFiles = 10;

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

    public function updatedImages() // <-- majuscule "I"
    {
        $this->validateOnly('images.*');

        if (count($this->images) > $this->maxFiles) {
            $this->images = array_slice($this->images, 0, $this->maxFiles);
            session()->flash('error', "Maximum {$this->maxFiles} images.");
        }
    }

    public function removeTempImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images); // reindexer
    }

// app/Livewire/CreateProperty.php
public function save()
{
    $this->validate();

    if ($this->type === 'terrain') {
        $this->rooms = null;
        $this->floors = null;
        $this->parking = false;
    }

    // Création via la relation => user_id rempli automatiquement
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

    foreach ($this->images as $image) {
        $path = $image->store('properties', 'public');
        \App\Models\PropertyImage::create([
            'property_id' => $property->id,
            'image_path'  => $path, // <-- corrige ici
        ]);
    }

    $this->reset([
        'title','description','price','type','transaction_type','surface',
        'rooms','floors','parking','address','city','country','images'
    ]);

    session()->flash('success', 'Annonce créée avec succès !');
    return redirect()->route('admin.property');
}

    public function render()
    {
        return view('livewire.create-property');
    }
}
