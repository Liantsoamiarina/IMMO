<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'status',
        'price',
        'starts_at',
        'expires_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    // Plans configuration
    public static $plans = [
        'free' => [
            'name' => 'Gratuit',
            'price' => 0,
            'features' => [
                'posts_limit' => 5,
                'duration_days' => 30,
            ],
        ],
        'silver' => [
            'name' => 'Silver',
            'price' => 39000,
            'features' => [
                'posts_limit' => 20,
                'duration_days' => 30,
            ],
        ],
        'gold' => [
            'name' => 'Gold',
            'price' => 79000,
            'features' => [
                'posts_limit' => -1, // Illimité
                'duration_days' => 30,
            ],
        ],
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where('expires_at', '>', now());
    }

    public function scopePending($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired')
                    ->orWhere(function($q) {
                        $q->where('status', 'active')
                          ->where('expires_at', '<=', now());
                    });
    }

    // Méthodes
    public function isActive(): bool
    {
        return $this->status === 'active' && $this->expires_at > now();
    }

    public function isPending(): bool
    {
        return $this->status === 'inactive';
    }

    public function isExpired(): bool
    {
        return $this->status === 'expired' ||
               ($this->status === 'active' && $this->expires_at <= now());
    }

    public function activate()
    {
        $plan = self::$plans[$this->type];

        $this->update([
            'status' => 'active',
            'starts_at' => now(),
            'expires_at' => now()->addDays($plan['features']['duration_days']),
        ]);

        // Promouvoir l'utilisateur en agence
        $this->user->update(['role' => 'owner']);

        return $this;
    }

    public function expire()
    {
        $this->update([
            'status' => 'expired',
        ]);

        // Si c'était le dernier abonnement actif, rétrograder en client
        if (!$this->user->hasActiveSubscription()) {
            $this->user->update(['role' => 'client']);
        }

        return $this;
    }

    public function renew()
    {
        $plan = self::$plans[$this->type];

        $startDate = $this->expires_at > now() ? $this->expires_at : now();

        $this->update([
            'status' => 'active',
            'starts_at' => $startDate,
            'expires_at' => $startDate->copy()->addDays($plan['features']['duration_days']),
        ]);

        return $this;
    }

    public function getPostsLimit(): int
    {
        $plan = self::$plans[$this->type];
        return $plan['features']['posts_limit'];
    }

    public function hasUnlimitedPosts(): bool
    {
        return $this->getPostsLimit() === -1;
    }

    public function getRemainingPosts(): ?int
    {
        if ($this->hasUnlimitedPosts()) {
            return null; // Illimité
        }

        $usedPosts = $this->user->properties()
                                ->whereMonth('created_at', now()->month)
                                ->count();

        return max(0, $this->getPostsLimit() - $usedPosts);
    }

    public function getDaysRemaining(): int
    {
        if (!$this->isActive()) {
            return 0;
        }

        return max(0, now()->diffInDays($this->expires_at, false));
    }

    // Méthode statique pour obtenir les informations d'un plan
    public static function getPlanInfo(string $type): ?array
    {
        return self::$plans[$type] ?? null;
    }

    // Auto-expiration des abonnements (à appeler via un command schedulé)
    public static function expireOutdatedSubscriptions()
    {
        $expiredSubscriptions = self::where('status', 'active')
                                   ->where('expires_at', '<=', now())
                                   ->get();

        foreach ($expiredSubscriptions as $subscription) {
            $subscription->expire();
        }

        return $expiredSubscriptions->count();
    }
}
