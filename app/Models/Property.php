<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'type',
        'transaction_type',
        'surface',
        'rooms',
        'floors',
        'parking',
        'address',
        'city',
        'country',
    ];

    protected $casts = [
        'parking' => 'boolean',
        'price' => 'decimal:2',
    ];

    // Relation avec images
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    // Relation avec user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Méthodes utilitaires ajoutées
    public function getFirstImage()
    {
        $firstImage = $this->images()->first();
        if ($firstImage) {
            return Storage::url($firstImage->image_path);
        }

        // Image par défaut si aucune image
        return 'https://picsum.photos/400/280?random=' . $this->id;
    }

    public function getAllImages()
    {
        return $this->images->map(function ($image) {
            return Storage::url($image->image_path);
        });
    }

    public function getFormattedPrice()
    {
        return '$' . number_format($this->price);
    }

    public function getFullAddress()
    {
        $parts = array_filter([$this->address, $this->city, $this->country]);
        return implode(', ', $parts) ?: 'Adresse non spécifiée';
    }

    // Scopes
    public function scopeVente($query)
    {
        return $query->where('transaction_type', 'vente');
    }

    public function scopeLocation($query)
    {
        return $query->where('transaction_type', 'location');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
