<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'user_id',
        'agency_id',
        'type',
        'client_name',
        'client_email',
        'client_phone',
        'message',
        'status',
        'contacted_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'contacted_at' => 'datetime',
    ];

    // Relations
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(User::class, 'agency_id');
    }

    // Méthodes utiles
    public function markAsContacted()
    {
        $this->update([
            'status' => 'contacte',
            'contacted_at' => now()
        ]);
    }

    public function markAsInProgress()
    {
        $this->update(['status' => 'en_cours']);
    }

    public function markAsConverted()
    {
        $this->update(['status' => 'converti']);
    }

    public function markAsLost()
    {
        $this->update(['status' => 'perdu']);
    }

    public function isNew()
    {
        return $this->status === 'nouveau';
    }

    public function getStatusBadge()
    {
        return match($this->status) {
            'nouveau' => '<span class="badge bg-warning text-dark">🆕 Nouveau</span>',
            'contacte' => '<span class="badge bg-info">📞 Contacté</span>',
            'en_cours' => '<span class="badge bg-primary">⏳ En cours</span>',
            'converti' => '<span class="badge bg-success">✅ Converti</span>',
            'perdu' => '<span class="badge bg-danger">❌ Perdu</span>',
            default => '<span class="badge bg-secondary">❓</span>',
        };
    }
}
