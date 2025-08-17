<?php


use App\Http\Livewire\Properties;
use Illuminate\Support\Facades\Route;
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

