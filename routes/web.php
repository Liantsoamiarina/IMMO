<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Admin\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[PropertyController::class,"index"])->name("homepage");
Route::get('/contact',[HomeController::class,"contact"])->name("contact");
Route::get('/homepropertie',[HomeController::class,"propertie"])->name("homepropertie");
Route::get('/details',[HomeController::class,"details"])->name("details");
Route::get('/Rent',[HomeController::class,"RentDetails"])->name("Rent");
Route::get('/Abonnement',[HomeController::class,"Abonnement"])->name("Abonnement");

// Admincontroller
Route::get('/admin', [Admincontroller::class, 'admin'])->name('admin.dashboard');
Route::get('/property', [Admincontroller::class, 'property'])->name('admin.property');


Route::resource('properties', PropertyController::class)->middleware('auth');

// date
Route::get('/current-time', function () {
    return response()->json([
        'time' => now()->format('H:i:s')
    ]);
});


# Client
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

# Owner
Route::get('/home-agence', [OwnerController::class, 'Agence'])->name('home.agence');


# Auth commun
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// //redirection par role
// Route::middleware('auth')->get('/dashboard', function () {
//     $user = Auth::user();

//     if ($user->role === 'admin') {
//         return view('admin.dashboard');
//     } elseif ($user->role === 'owner') {
//         return view('agence.agence');
//     } else {
//         return view('home'); // client va à la page d'accueil
//     }
// })->name('dashboard');


// Créer des routes séparées
Route::middleware(['auth', 'admin'])->get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

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

//livewire
Route::middleware('auth')
    ->get('/createproperty', [PropertyController::class, 'Cproperty'])
    ->name('createproperty');
//agence
Route::get('/agenceproperty',[PropertyController::class,'Agenceproperty'])->name('Cproperty.agence');



use App\Http\Controllers\ActivationController;
use App\Http\Controllers\SubscriptionController;

// Routes d'activation d'abonnement
Route::middleware(['auth'])->group(function () {
    Route::get('/activation/create', [ActivationController::class, 'create'])->name('activation.create');
    Route::post('/activation/store', [ActivationController::class, 'store'])->name('activation.store');
    Route::get('/subscriptions/pending', [ActivationController::class, 'pending'])->name('subscriptions.pending');
    Route::get('/subscriptions/dashboard', [ActivationController::class, 'dashboard'])->name('subscriptions.dashboard');
    Route::post('/subscriptions/{id}/renew', [ActivationController::class, 'requestRenewal'])->name('subscriptions.renew');
});



// Routes Admin pour gérer les abonnements
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscriptions/{id}', [SubscriptionController::class, 'show'])->name('subscriptions.show');
    Route::post('/subscriptions/{id}/activate', [SubscriptionController::class, 'activate'])->name('subscriptions.activate');
    Route::post('/subscriptions/{id}/expire', [SubscriptionController::class, 'expire'])->name('subscriptions.expire');
    Route::post('/subscriptions/{id}/renew', [SubscriptionController::class, 'renew'])->name('subscriptions.renew');
    Route::delete('/subscriptions/{id}/reject', [SubscriptionController::class, 'reject'])->name('subscriptions.reject');
});
