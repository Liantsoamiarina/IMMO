<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Property;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques générales
        $totalUsers = User::count();
        $totalSubscriptions = Subscription::count();
        $activeSubscriptions = Subscription::active()->count();
        $pendingSubscriptions = Subscription::pending()->count();
        $expiredSubscriptions = Subscription::expired()->count();

        // Propriétés - CORRIGÉ : utilisation de transaction_type au lieu de type
        $propertiesSale = Property::where('transaction_type', 'vente')->count();
        $propertiesRent = Property::where('transaction_type', 'location')->count();

        // Revenus
        $revenueThisMonth = Subscription::whereMonth('starts_at', now()->month)
            ->whereYear('starts_at', now()->year)
            ->where('status', 'active')
            ->sum('price');

        $revenueLastMonth = Subscription::whereMonth('starts_at', now()->subMonth()->month)
            ->whereYear('starts_at', now()->subMonth()->year)
            ->where('status', 'active')
            ->sum('price');

        $revenueGrowth = $revenueLastMonth > 0
            ? (($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100
            : 0;

        // Répartition des plans
        $planCounts = [
            'free' => Subscription::where('type', 'free')->active()->count(),
            'silver' => Subscription::where('type', 'silver')->active()->count(),
            'gold' => Subscription::where('type', 'gold')->active()->count(),
        ];

        $totalActivePlans = array_sum($planCounts);
        $planPercentages = [
            'free' => $totalActivePlans > 0 ? round(($planCounts['free'] / $totalActivePlans) * 100, 1) : 0,
            'silver' => $totalActivePlans > 0 ? round(($planCounts['silver'] / $totalActivePlans) * 100, 1) : 0,
            'gold' => $totalActivePlans > 0 ? round(($planCounts['gold'] / $totalActivePlans) * 100, 1) : 0,
        ];

        // Revenus mensuels sur les 7 derniers mois
        $monthlyRevenue = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $revenue = Subscription::whereMonth('starts_at', $date->month)
                ->whereYear('starts_at', $date->year)
                ->where('status', 'active')
                ->sum('price');

            $monthlyRevenue[$date->format('M')] = $revenue;
        }

        // Dernières propriétés avec leurs images
        $latestProperties = Property::with('images')->latest()->take(3)->get();

        $stats = [
            'total_users' => $totalUsers,
            'total_subscriptions' => $totalSubscriptions,
            'active_subscriptions' => $activeSubscriptions,
            'pending_subscriptions' => $pendingSubscriptions,
            'expired_subscriptions' => $expiredSubscriptions,
            'properties_sale' => $propertiesSale,
            'properties_rent' => $propertiesRent,
            'revenue_this_month' => $revenueThisMonth,
            'revenue_growth' => $revenueGrowth,
            'plan_percentages' => $planPercentages,
            'monthly_revenue' => $monthlyRevenue,
        ];

        return view('admin.dashboard', compact('stats', 'latestProperties'));
    }
}
