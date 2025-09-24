<?php
// app/Services/SubscriptionService.php

namespace App\Services;

use App\Mail\ActivationAccount;
use App\Models\User;
use App\Models\Subscription;
use App\Mail\SubscriptionConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubscriptionService
{
    public const SUBSCRIPTION_PRICES = [
        'silver' => 50000,
        'gold' => 150000,
    ];

    public const SUBSCRIPTION_DURATIONS = [
        'silver' => 30, // 30 jours
        'gold' => 30,   // 30 jours
    ];

    /**
     * Créer un nouvel abonnement pour un utilisateur
     */
    public function createSubscription(User $user, string $type): Subscription
    {
        return DB::transaction(function () use ($user, $type) {
            // Désactiver les anciens abonnements
            $this->deactivateOldSubscriptions($user);

            // Créer le nouvel abonnement
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'type' => $type,
                'status' => 'active',
                'price' => self::SUBSCRIPTION_PRICES[$type],
                'starts_at' => now(),
                'expires_at' => now()->addDays(self::SUBSCRIPTION_DURATIONS[$type]),
            ]);

            // Promouvoir l'utilisateur en agence
            $user->promoteToAgency();

            return $subscription;
        });
    }

    /**
     * Envoyer l'email de confirmation d'abonnement
     */
    public function sendConfirmationEmail(User $user, Subscription $subscription): void
    {
        Mail::to($user->email)->send(new ActivationAccount($user, $subscription));
    }

    /**
     * Processus complet d'abonnement avec email
     */
    public function subscribe(User $user, string $type): array
    {
        try {
            // Valider le type d'abonnement
            if (!in_array($type, ['silver', 'gold'])) {
                throw new \InvalidArgumentException('Type d\'abonnement invalide');
            }

            // Créer l'abonnement
            $subscription = $this->createSubscription($user, $type);

            // Envoyer l'email de confirmation
            $this->sendConfirmationEmail($user, $subscription);

            return [
                'success' => true,
                'message' => 'Abonnement créé avec succès ! Un email de confirmation a été envoyé.',
                'subscription' => $subscription,
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Erreur lors de la création de l\'abonnement : ' . $e->getMessage(),
                'subscription' => null,
            ];
        }
    }

    /**
     * Désactiver les anciens abonnements d'un utilisateur
     */
    private function deactivateOldSubscriptions(User $user): void
    {
        $user->subscriptions()
            ->where('status', 'active')
            ->update(['status' => 'inactive']);
    }

    /**
     * Vérifier et expirer les abonnements qui ont dépassé leur date
     */
    public function expireOldSubscriptions(): int
    {
        $expiredCount = Subscription::where('status', 'active')
            ->where('expires_at', '<', now())
            ->update(['status' => 'expired']);

        // Remettre les utilisateurs en visiteur si ils n'ont plus d'abonnement actif
        $usersWithoutSubscription = User::where('role', 'agency')
            ->whereDoesntHave('subscriptions', function ($query) {
                $query->active();
            })
            ->update(['role' => 'visitor']);

        return $expiredCount;
    }

    /**
     * Obtenir les statistiques des abonnements
     */
    public function getSubscriptionStats(): array
    {
        return [
            'total_active' => Subscription::active()->count(),
            'silver_count' => Subscription::active()->where('type', 'silver')->count(),
            'gold_count' => Subscription::active()->where('type', 'gold')->count(),
            'total_revenue' => Subscription::active()->sum('price'),
            'agencies_count' => User::where('role', 'agency')->count(),
            'visitors_count' => User::where('role', 'visitor')->count(),
        ];
    }
}
