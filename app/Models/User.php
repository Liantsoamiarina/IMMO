<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'status',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relations
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)
                    ->where('status', 'active')
                    ->where('expires_at', '>', now())
                    ->latest();
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    // Méthodes de vérification de rôle
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }

    public function isClient(): bool
    {
        return $this->role === 'client';
    }

    // Méthodes d'abonnement
    public function hasActiveSubscription(): bool
    {
        return $this->activeSubscription()->exists();
    }

    public function getSubscriptionType(): ?string
    {
        $subscription = $this->activeSubscription;
        return $subscription ? $subscription->type : null;
    }

    public function canPostProperty(): bool
    {
        // Admin peut toujours poster
        if ($this->isAdmin()) {
            return true;
        }

        // Les clients ne peuvent pas poster
        if ($this->isClient()) {
            return false;
        }

        // Vérifier l'abonnement actif
        $subscription = $this->activeSubscription;
        if (!$subscription || !$subscription->isActive()) {
            return false;
        }

        // Vérifier la limite de posts
        if ($subscription->hasUnlimitedPosts()) {
            return true;
        }

        $remainingPosts = $subscription->getRemainingPosts();
        return $remainingPosts !== null && $remainingPosts > 0;
    }

    public function getRemainingPosts(): ?int
    {
        $subscription = $this->activeSubscription;
        if (!$subscription || !$subscription->isActive()) {
            return 0;
        }

        return $subscription->getRemainingPosts();
    }

    public function getPostsUsedThisMonth(): int
    {
        return $this->properties()
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count();
    }

    public function promoteToOwner(): void
    {
        $this->update(['role' => 'owner']);
    }

    public function demoteToClient(): void
    {
        $this->update(['role' => 'client']);
    }

    // Enregistrer la dernière connexion
    public function updateLastLogin(): void
    {
        $this->update(['last_login_at' => now()]);
    }

    // Scope pour filtrer les utilisateurs
    public function scopeOwners($query)
    {
        return $query->where('role', 'owner');
    }

    public function scopeClients($query)
    {
        return $query->where('role', 'client');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeWithActiveSubscription($query)
    {
        return $query->whereHas('activeSubscription');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
}
