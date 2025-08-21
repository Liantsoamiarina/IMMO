<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
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
        'country'
    ];
}
