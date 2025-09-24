<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class PropertyShow extends Component
{
    public Property $property;
    public $currentImageIndex = 0;
    public $showContactForm = false;
    public $contactForm = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'message' => ''
    ];

    public function mount($id)
    {
        $this->property = Property::with(['images', 'user'])->findOrFail($id);
    }

    public function nextImage()
    {
        if ($this->property->images->count() > 0) {
            $this->currentImageIndex = ($this->currentImageIndex + 1) % $this->property->images->count();
        }
    }

    public function previousImage()
    {
        if ($this->property->images->count() > 0) {
            $this->currentImageIndex = $this->currentImageIndex > 0
                ? $this->currentImageIndex - 1
                : $this->property->images->count() - 1;
        }
    }

    public function selectImage($index)
    {
        $this->currentImageIndex = $index;
    }

    public function toggleContactForm()
    {
        $this->showContactForm = !$this->showContactForm;
    }

    public function sendMessage()
    {
        $this->validate([
            'contactForm.name' => 'required|min:2',
            'contactForm.email' => 'required|email',
            'contactForm.phone' => 'nullable|string',
            'contactForm.message' => 'required|min:10'
        ]);

        // Ici vous pouvez ajouter la logique pour envoyer l'email ou sauvegarder le message

        session()->flash('message', 'Your message has been sent successfully!');
        $this->reset('contactForm');
        $this->showContactForm = false;
    }

    public function render()
    {
        return view('livewire.property-show');
    }
}
