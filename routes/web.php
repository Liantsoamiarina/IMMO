<?php


use App\Http\Livewire\Properties;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admincontroller;


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

Route::get('/',[HomeController::class,"index"])->name("homepage");
Route::get('/contact',[HomeController::class,"contact"])->name("contact");
Route::get('/properties',[HomeController::class,"properties"])->name("properties");
Route::get('/details',[HomeController::class,"details"])->name("details");
Route::get('/Rent',[HomeController::class,"RentDetails"])->name("Rent");

// Admincontroller
Route::get('/admin', [Admincontroller::class, 'admin'])->name('admin.dashboard');
Route::get('/property', [Admincontroller::class, 'property'])->name('admin.property');
Route::get('/createproperty', [Admincontroller::class, 'Cproperty'])->name('createproperty');


// routes/web.php
Route::get('/current-time', function () {
    return response()->json([
        'time' => now()->format('H:i:s')
    ]);
});

// login et register
Route::get('register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

//forgot password
// Route::get('password/forgot', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
// Route::post('password/email', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
// Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
// Route::post('password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.update');

//redirection dashboard
Route::middleware('auth')->get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return view('dashboard.admin');
    } elseif ($user->role === 'owner') {
        return view('dashboard.owner');
    } else {
        return view('dashboard.client');
    }
})->name('dashboard');

