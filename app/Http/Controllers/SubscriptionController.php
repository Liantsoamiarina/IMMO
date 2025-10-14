<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivationAccount;

class SubscriptionController extends Controller
{
    /**
     * Liste toutes les demandes d'abonnement
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');

        $query = Subscription::with('user')->latest();

        switch ($status) {
            case 'pending':
                $query->pending();
                break;
            case 'active':
                $query->active();
                break;
            case 'expired':
                $query->expired();
                break;
        }

        $subscriptions = $query->paginate(20);

        $stats = [
            'pending' => Subscription::pending()->count(),
            'active' => Subscription::active()->count(),
            'expired' => Subscription::expired()->count(),
            'total' => Subscription::count(),
        ];

        return view('admin.abonnement', compact('subscriptions', 'stats', 'status'));
    }

    /**
     * Afficher les détails d'un abonnement
     */
    public function show($id)
    {
        $subscription = Subscription::with('user')->findOrFail($id);

        return view('admin.subscriptions.show', compact('subscription'));
    }

    /**
     * Activer un abonnement
     */
    public function activate($id)
    {
        $subscription = Subscription::findOrFail($id);

        if (!$subscription->isPending()) {
            return back()->with('error', 'Cet abonnement ne peut pas être activé.');
        }

        try {
            // Activer l'abonnement
            $subscription->activate();

            // Envoyer l'email de confirmation
            Mail::to($subscription->user->email)->send
            (new ActivationAccount($subscription->user, $subscription));

            return back()->with('success', 'L\'abonnement a été activé avec succès et l\'utilisateur a reçu un email de confirmation.');

        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    /**
     * Expirer manuellement un abonnement
     */
    public function expire($id)
    {
        $subscription = Subscription::findOrFail($id);

        if (!$subscription->isActive()) {
            return back()->with('error', 'Seuls les abonnements actifs peuvent être expirés.');
        }

        try {
            $subscription->expire();

            // TODO: Envoyer une notification email à l'utilisateur

            return back()->with('success', 'L\'abonnement a été expiré avec succès.');

        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de l\'expiration.');
        }
    }

    /**
     * Renouveler un abonnement
     */
    public function renew($id)
    {
        $subscription = Subscription::findOrFail($id);

        try {
            $subscription->renew();

            // TODO: Envoyer une notification email à l'utilisateur

            return back()->with('success', 'L\'abonnement a été renouvelé avec succès.');

        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors du renouvellement.');
        }
    }

    /**
     * Rejeter une demande d'abonnement
     */
    public function reject($id, Request $request)
    {
        $subscription = Subscription::findOrFail($id);

        if (!$subscription->isPending()) {
            return back()->with('error', 'Seules les demandes en attente peuvent être rejetées.');
        }

        $validated = $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        try {
            $subscription->delete();

            // TODO: Envoyer une notification email à l'utilisateur avec la raison

            return redirect()->route('admin.subscriptions.index')
                           ->with('success', 'La demande d\'abonnement a été rejetée.');

        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors du rejet.');
        }
    }

    /**
     * Statistiques globales
     */
    public function statistics()
    {
        $stats = [
            'total_subscriptions' => Subscription::count(),
            'active_subscriptions' => Subscription::active()->count(),
            'pending_subscriptions' => Subscription::pending()->count(),
            'expired_subscriptions' => Subscription::expired()->count(),

            'revenue_this_month' => Subscription::whereMonth('starts_at', now()->month)
                                               ->whereYear('starts_at', now()->year)
                                               ->where('status', 'active')
                                               ->sum('price'),

            'revenue_total' => Subscription::where('status', 'active')->sum('price'),

            'subscriptions_by_type' => [
                'free' => Subscription::where('type', 'free')->active()->count(),
                'silver' => Subscription::where('type', 'silver')->active()->count(),
                'gold' => Subscription::where('type', 'gold')->active()->count(),
            ],

            'agencies_count' => User::where('role', 'owner')->count(),
        ];

        return view('admin.subscriptions.statistics', compact('stats'));
    }

    /**
     * Expirer automatiquement les abonnements obsolètes
     */
    public function autoExpire()
    {
        $count = Subscription::expireOutdatedSubscriptions();

        return back()->with('success', "$count abonnement(s) ont été expirés automatiquement.");
    }
}
