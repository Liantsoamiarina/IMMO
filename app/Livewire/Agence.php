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
    public $title, $description, $price, $type = "appartement", $transaction_type = "vente";
    public $surface, $rooms, $floors, $parking = false, $address, $city, $country;

    public $images = [];
    public $maxFiles = 10;

    // Pour l'édition et suppression
    public $editingProperty, $editingId, $deletingProperty;
    public $properties;
    public $isLoading = true;

    protected $rules = [
        'title' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'type' => 'required|string',
        'transaction_type' => 'required|in:vente,location',
        'description' => 'nullable|string|max:5000',
        'surface' => 'nullable|integer|min:0',
        'rooms' => 'nullable|integer|min:0',
        'floors' => 'nullable|integer|min:0',
        'parking' => 'nullable|boolean',
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'images' => 'nullable|array|max:10',
        'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
    ];

    protected $messages = [
        'title.required' => 'Le titre est obligatoire',
        'price.required' => 'Le prix est obligatoire',
        'price.numeric' => 'Le prix doit être un nombre',
        'type.required' => 'Le type est obligatoire',
        'transaction_type.required' => 'Le type de transaction est obligatoire',
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

    try {
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

        if ($this->images && count($this->images) > 0) {
            foreach ($this->images as $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path'  => $path,
                ]);
            }
        }

        $this->resetForm();

        // Stocker les données dans la session
        session()->flash('property_created', [
            'title' => $property->title,
            'price' => number_format($property->price, 0, ',', ' '),
            'type' => ucfirst($property->type),
            'transaction' => ucfirst($property->transaction_type)
        ]);

        return redirect()->route('home.agence');

    } catch (\Exception $e) {
        \Log::error('Erreur création propriété: ' . $e->getMessage());

        $this->dispatch('show-toast', [
            'type' => 'error',
            'message' => 'Erreur lors de la création: ' . $e->getMessage()
        ]);
    }
}

    public function edit($id)
    {
        try {
            $this->editingProperty = Property::with('images')->findOrFail($id);
            $this->editingId = $id;

            // Vérifier que c'est bien la propriété de l'utilisateur
            if ($this->editingProperty->user_id !== Auth::id()) {
                $this->dispatch('show-toast',
                    type: 'error',
                    message: 'Vous n\'avez pas la permission de modifier cette propriété.'
                );
                return;
            }

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
            $this->dispatch('open-edit-modal',
                property: $this->editingProperty->toArray()
            );

        } catch (\Exception $e) {
            \Log::error('Erreur edit: ' . $e->getMessage());
            $this->dispatch('show-toast',
                type: 'error',
                message: 'Erreur: ' . $e->getMessage()
            );
        }
    }

    public function confirmDelete($id)
    {
        try {
            $this->deletingProperty = Property::findOrFail($id);

            // Vérifier que c'est bien la propriété de l'utilisateur
            if ($this->deletingProperty->user_id !== Auth::id()) {
                $this->dispatch('show-toast',
                    type: 'error',
                    message: 'Vous n\'avez pas la permission de supprimer cette propriété.'
                );
                return;
            }

            // Dispatcher un événement pour SweetAlert
            $this->dispatch('confirm-delete',
                id: $id,
                title: $this->deletingProperty->title
            );

        } catch (\Exception $e) {
            \Log::error('Erreur confirmDelete: ' . $e->getMessage());
            $this->dispatch('show-toast',
                type: 'error',
                message: 'Erreur: ' . $e->getMessage()
            );
        }
    }

    public function delete($id)
    {
        // CORRECTION: Utiliser findOrFail au lieu de where
        $property = Property::findOrFail($id);

        // Vérifier que c'est bien la propriété de l'utilisateur
        if ($property->user_id !== Auth::id()) {
            $this->dispatch('show-toast', [
                'type' => 'error',
                'message' => 'Vous n\'avez pas la permission de supprimer cette propriété.'
            ]);
            return;
        }

        try {
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
        } catch (\Exception $e) {
            $this->dispatch('show-toast', [
                'type' => 'error',
                'message' => 'Erreur lors de la suppression: ' . $e->getMessage()
            ]);
        }
    }

    public function update()
    {
        \Log::info("🔄 Tentative de mise à jour, editingId: " . $this->editingId);

        if (!$this->editingId) {
            $this->dispatch('show-toast',
                type: 'error',
                message: 'Aucune propriété sélectionnée pour modification.'
            );
            return;
        }

        $this->validate();

        try {
            $property = Property::findOrFail($this->editingId);

            \Log::info("✅ Propriété trouvée pour update: {$property->title}");

            // Vérifier que c'est bien la propriété de l'utilisateur
            if ($property->user_id !== Auth::id()) {
                $this->dispatch('show-toast',
                    type: 'error',
                    message: 'Vous n\'avez pas la permission de modifier cette propriété.'
                );
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

            \Log::info("✅ Propriété mise à jour avec succès");

            // Gestion des nouvelles images (optionnel)
            if ($this->images && count($this->images) > 0) {
                \Log::info("📸 Ajout de " . count($this->images) . " nouvelles images");

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

            $this->dispatch('show-toast',
                type: 'success',
                message: 'Propriété modifiée avec succès!'
            );

        } catch (\Exception $e) {
            \Log::error('❌ Erreur update: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());

            $this->dispatch('show-toast',
                type: 'error',
                message: 'Erreur lors de la modification: ' . $e->getMessage()
            );
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
        $this->editingId = null;
        $this->editingProperty = null;
    }

    public function render()
    {
        try {
            return view('livewire.agence', [
                'properties' => $this->properties
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur render: ' . $e->getMessage());
            return view('livewire.agence', [
                'properties' => collect([])
            ]);
        }
    }

    /**
     * Gestion des erreurs Livewire
     */
    public function exception($e, $stopPropagation)
    {
        \Log::error('Exception Livewire: ' . $e->getMessage());
        \Log::error($e->getTraceAsString());

        $this->dispatch('show-toast',
            type: 'error',
            message: 'Une erreur est survenue: ' . $e->getMessage()
        );

        $stopPropagation();
    }
}
