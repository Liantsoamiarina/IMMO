<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Property;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DeleteProperty extends Component
{
    use WithPagination;

    public $search = '';
    public $typeFilter = '';
    public $transactionFilter = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 12;

    public $totalProperties = 0;
    public $forSaleCount = 0;
    public $forRentCount = 0;
    public $soldThisMonth = 0;

    protected $queryString = [
        'search' => ['except' => ''],
        'typeFilter' => ['except' => ''],
        'transactionFilter' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function mount()
    {
        $this->calculateStats();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedTypeFilter()
    {
        $this->resetPage();
    }

    public function updatedTransactionFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->typeFilter = '';
        $this->transactionFilter = '';
        $this->sortBy = 'created_at';
        $this->sortDirection = 'desc';
        $this->resetPage();
    }

    public function calculateStats()
    {
        $this->totalProperties = Property::count();
        $this->forSaleCount = Property::where('transaction_type', 'vente')->count();
        $this->forRentCount = Property::where('transaction_type', 'location')->count();
        $this->soldThisMonth = Property::where('created_at', '>=', now()->startOfMonth())->count();
    }

    public function getPropertiesProperty()
    {
        $query = Property::with(['images', 'user'])
            ->when($this->search, function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('address', 'like', '%' . $this->search . '%')
                  ->orWhere('city', 'like', '%' . $this->search . '%');
            })
            ->when($this->typeFilter, function ($q) {
                $q->where('type', $this->typeFilter);
            })
            ->when($this->transactionFilter, function ($q) {
                $q->where('transaction_type', $this->transactionFilter);
            })
            ->orderBy($this->sortBy, $this->sortDirection);

        return $query->paginate($this->perPage);
    }

    public function deleteProperty($propertyId)
    {
        $property = Property::findOrFail($propertyId);

        // Vérifier que l'utilisateur peut supprimer cette propriété
        if ($property->user_id !== Auth::id()) {
            session()->flash('error', 'Vous n\'êtes pas autorisé à supprimer cette propriété.');
            return;
        }

        // Supprimer les images associées
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        // Supprimer la propriété
        $property->delete();

        // Recalculer les statistiques
        $this->calculateStats();

        session()->flash('success', 'Propriété supprimée avec succès.');
    }

public function render()
{
    return view('livewire.delete-property');
}
}



