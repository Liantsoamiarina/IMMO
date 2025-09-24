<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'status',
        'prix',
        'start_at',
        'expires_at',
    ];
    protected $casts = [
        'start_at' => 'date',
        'expires_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active' &&
        $this->start_at <= now() &&
        $this->expires_at > now();
    }

    public function isExpired(): bool
    {
        return $this->expires_at <= now();
    }

    public function getTypeDisplayName(): string
    {
        return match($this->type){
            'silver' => 'Silver',
            'gold' => 'Gold',
           default => ucfirst($this->type),
        };
    }

    public function getFeatures(): array
    {
        return match($this->type) {
            'silver' => [
                'Jusqu\'à 10 annonces',
                'Photos basiques',
                'Support email',
                'Statistiques de base',
            ],
            'gold' => [
                'Annoces illimitées',
                'Photos HD',
                'Support prioritaire',
                'Statistiques avancées',
                'Mise en avant des annonces',
            ],
            default => [],
        };
    }

    public function scopeactive($query)
    {
        return $query->where('status', 'active')
                     ->where('start_at', '<=', now())
                     ->where('expires_at', '>', now());
    }

}
