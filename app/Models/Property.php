<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    // Scopes
    public function scopeVente($query)
    {
        return $query->where('transaction_type', 'vente');
    }

    public function scopeLocation($query)
    {
        return $query->where('transaction_type', 'location');
    }
}
