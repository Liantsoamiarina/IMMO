<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;

// ============================================
// ROUTES PUBLIQUES (CLIENTS)
// ============================================

// Page d'accueil (3 dernières propriétés)
Route::get('/', [PropertyController::class, 'index'])->name('homepage');

// Page de toutes les propriétés avec filtres
Route::get('/properties', [PropertyController::class, 'allProperties'])->name('properties.index');

// Détails d'une propriété
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');

// Autres pages publiques
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/homepropertie', [HomeController::class, 'propertie'])->name('homepropertie');
Route::get('/Rent', [HomeController::class, 'RentDetails'])->name('Rent');
Route::get('/Abonnement', [HomeController::class, 'Abonnement'])->name('Abonnement');

// ============================================
// AUTHENTIFICATION
// ============================================

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============================================
// ROUTES AGENCES (OWNERS)
// ============================================

Route::middleware('auth')->group(function () {
    // Espace agence
    Route::get('/home-agence', [OwnerController::class, 'Agence'])->name('home.agence');

    // Gestion des propriétés (Livewire - avec CRUD intégré)
    Route::get('/agenceproperty', [PropertyController::class, 'Agenceproperty'])->name('Cproperty.agence');

    // Création de propriété
    Route::get('/createproperty', [PropertyController::class, 'Cproperty'])->name('createproperty');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
});

// ============================================
// ROUTES LEADS (CLIENTS ET AGENCES)
// ============================================

Route::middleware(['auth'])->group(function () {
    Route::get('/leads/{property}/create', [LeadController::class, 'create'])->name('leads.create');
    Route::post('/leads/{property}/store', [LeadController::class, 'store'])->name('leads.store');
    Route::get('/mes-leads', [LeadController::class, 'index'])->name('leads.index');
    Route::post('/leads/{lead}/contacted', [LeadController::class, 'markAsContacted'])->name('leads.markAsContacted');
    Route::post('/leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('leads.updateStatus');
});

// ============================================
// ROUTES ADMIN
// ============================================

use App\Http\Controllers\ActivationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ClientController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion des propriétés
    Route::get('/property', [Admincontroller::class, 'property'])->name('property');

    // Gestion des abonnements
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscriptions/{id}', [SubscriptionController::class, 'show'])->name('subscriptions.show');
    Route::post('/subscriptions/{id}/activate', [SubscriptionController::class, 'activate'])->name('subscriptions.activate');
    Route::post('/subscriptions/{id}/expire', [SubscriptionController::class, 'expire'])->name('subscriptions.expire');
    Route::post('/subscriptions/{id}/renew', [SubscriptionController::class, 'renew'])->name('subscriptions.renew');
    Route::delete('/subscriptions/{id}/reject', [SubscriptionController::class, 'reject'])->name('subscriptions.reject');

    // Clients
    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
});

// ============================================
// ABONNEMENTS (AGENCES)
// ============================================

Route::middleware(['auth'])->group(function () {
    Route::get('/activation/create', [ActivationController::class, 'create'])->name('activation.create');
    Route::post('/activation/store', [ActivationController::class, 'store'])->name('activation.store');
    Route::get('/subscriptions/pending', [ActivationController::class, 'pending'])->name('subscriptions.pending');
    Route::get('/subscriptions/dashboard', [ActivationController::class, 'dashboard'])->name('subscriptions.dashboard');
    Route::post('/subscriptions/{id}/renew', [ActivationController::class, 'requestRenewal'])->name('subscriptions.renew');
});

// ============================================
// DASHBOARD REDIRECTION
// ============================================

Route::middleware('auth')->get('/dashboard', function () {
    $user = Auth::user();

    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isOwner()) {
        return view('agence.agence');
    } else {
        return view('home');
    }
})->name('dashboard');

// ============================================
// UTILITAIRES
// ============================================

Route::get('/current-time', function () {
    return response()->json([
        'time' => now()->format('H:i:s')
    ]);
});
