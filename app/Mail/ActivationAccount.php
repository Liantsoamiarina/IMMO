<?php

namespace App\Mail;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ActivationAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subscription;

    public function __construct(User $user, Subscription $subscription)
    {
        $this->user = $user;
        $this->subscription = $subscription;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre abonnement ' . ucfirst($this->subscription->type) . ' a été activé ! 🎉',
        );
    }

    public function content(): Content
    {
        $plan = Subscription::$plans[$this->subscription->type];

        // Features selon le plan
        $features = match($this->subscription->type) {
            'free' => [
                'Accès aux annonces publiques',
                'Filtres de recherche basiques',
                '5 annonces par mois'
            ],
            'silver' => [
                'Tout du plan Gratuit',
                '20 annonces par mois',
                'Filtres de recherche avancés',
                'Support par email'
            ],
            'gold' => [
                'Tout du plan Silver',
                'Annonces illimitées',
                'Conseiller personnel dédié',
                'Analyses de marché privées',
                'Support prioritaire 24/7'
            ],
            default => []
        };

        return new Content(
            view: 'mail.inscriptionValide',
            with: [
                'agencyName' => $this->user->name,
                'agencyEmail' => $this->user->email,
                'subscriptionPlan' => ucfirst($this->subscription->type),
                'planIcon' => match($this->subscription->type) {
                    'gold' => '👑',
                    'silver' => '🏢',
                    default => '🏠'
                },
                'subscriptionPrice' => $plan['price'],
                'startDate' => $this->subscription->starts_at->format('d/m/Y'),
                'endDate' => $this->subscription->expires_at->format('d/m/Y'),
                'maxListings' => $this->subscription->getPostsLimit() === -1 ? 'Illimité' : $this->subscription->getPostsLimit(),
                'planFeatures' => $features,
                'dashboardUrl' => route('homepage'),
                'supportUrl' => url('/support'),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
