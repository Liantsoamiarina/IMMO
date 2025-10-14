<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    /**
     * Afficher le formulaire d'abonnement
     */
    public function create(Request $request)
    {
        $plan = $request->query('plan', 'silver');

        // Vérifier que le plan existe
        if (!isset(Subscription::$plans[$plan])) {
            return redirect()->route('home')->with('error', 'Plan invalide');
        }

        return view('subscriptions.create', compact('plan'));
    }

    /**
     * Soumettre une demande d'abonnement
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plan' => 'required|in:free,silver,gold',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:mobile_money,card',
            'mobile_operator' => 'required_if:payment_method,mobile_money|nullable|in:mvola,orange_money,airtel_money',
            'mobile_number' => 'required_if:payment_method,mobile_money|nullable|string',
            'card_number' => 'required_if:payment_method,card|nullable|string',
            'card_expiry' => 'required_if:payment_method,card|nullable|string',
            'card_cvv' => 'required_if:payment_method,card|nullable|string',
            'terms' => 'accepted',
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $planInfo = Subscription::$plans[$validated['plan']];

            // Créer la demande d'abonnement
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'type' => $validated['plan'],
                'status' => 'inactive', // En attente de validation admin
                'price' => $planInfo['price'],
                'starts_at' => null,
                'expires_at' => null,
            ]);

            // TODO: Enregistrer les informations de paiement dans une table séparée si nécessaire
            // PaymentInfo::create([...])

            DB::commit();

            return redirect()->route('homepage')
                           ->with('success', 'Votre demande d\'abonnement a été soumise avec succès. Elle sera activée par un administrateur sous peu.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Afficher l'erreur exacte en développement
            return back()->withInput()
                       ->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    /**
     * Page d'attente de validation
     */
    public function pending()
    {
        $user = Auth::user();
        $pendingSubscription = $user->subscriptions()
                                   ->where('status', 'inactive')
                                   ->latest()
                                   ->first();

        return view('subscriptions.pending', compact('pendingSubscription'));
    }

    /**
     * Tableau de bord des abonnements utilisateur
     */
    public function dashboard()
    {
        $user = Auth::user();
        $activeSubscription = $user->activeSubscription;
        $subscriptionHistory = $user->subscriptions()
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        $stats = null;
        if ($activeSubscription && $activeSubscription->isActive()) {
            $stats = [
                'posts_used' => $user->properties()
                                    ->whereMonth('created_at', now()->month)
                                    ->count(),
                'posts_limit' => $activeSubscription->getPostsLimit(),
                'posts_remaining' => $activeSubscription->getRemainingPosts(),
                'days_remaining' => $activeSubscription->getDaysRemaining(),
            ];
        }

        return view('subscriptions.dashboard', compact('activeSubscription', 'subscriptionHistory', 'stats'));
    }

    /**
     * Demander un renouvellement
     */
    public function requestRenewal($id)
    {
        $subscription = Subscription::findOrFail($id);

        // Vérifier que l'utilisateur possède cet abonnement
        if ($subscription->user_id !== Auth::id()) {
            abort(403);
        }

        // Vérifier que l'abonnement est expiré ou sur le point d'expirer
        if (!$subscription->isExpired() && $subscription->getDaysRemaining() > 7) {
            return back()->with('error', 'Cet abonnement ne peut pas encore être renouvelé.');
        }

        return redirect()->route('activation.create', ['plan' => $subscription->type])
                       ->with('info', 'Complétez le formulaire pour renouveler votre abonnement ' . $subscription->type . '.');
    }
}
