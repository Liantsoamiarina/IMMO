<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;


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
// Route::get('/register-owner', [AuthController::class, 'showRegisterOwner'])->name('register.owner.form');
// Route::post('/register-owner', [AuthController::class, 'registerOwner'])->name('register.owner');

# Auth commun
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//redirection par role
Route::middleware('auth')->get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return view('admin.dashboard');
    } elseif ($user->role === 'owner') {
        return view('agence.agence');
    } else {
        return view('home'); // client va à la page d'accueil
    }
})->name('dashboard');

//livewire
Route::middleware('auth')
    ->get('/createproperty', [PropertyController::class, 'Cproperty'])
    ->name('createproperty');
//agence
Route::get('/agenceproperty',[PropertyController::class,'Agenceproperty'])->name('Cproperty.agence');


