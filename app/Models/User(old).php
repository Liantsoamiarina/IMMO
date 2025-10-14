<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function  activeSubscription()
    {
        return $this->hasOne(Subscription::class)->active()->latest();
    }

    // public function isAgency(): bool
    // {
    //     return $this->role === 'agency';
    // }

    // public function isVisitor(): bool
    // {
    //     return $this->role === 'visitor';
    // }

    // public function hasActiveSubscription(): bool
    // {
    //     return $this->activeSubscription()->exists();
    // }

    // public function getSubscriptionType(): ?string
    // {
    //     $subscription = $this->activeSubscription;
    //     return $subscription ? $subscription->type : null;
    // }

    // public function promoteToAgency(): void
    // {
    //     $this->update(['role' => 'agency']);
    // }


    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
