<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'image_path',
    ];

    // Relation avec Property
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // Accesseur pour l'URL complète de l'image
    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

    // Mutateur pour nettoyer le chemin de l'image
    public function setImagePathAttribute($value)
    {
        $this->attributes['image_path'] = ltrim($value, '/');
    }
}
