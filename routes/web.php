<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', function () {
    return view('/home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('marcas', 'App\Http\Controllers\MarcasController');
    Route::resource('vehiculos', 'App\Http\Controllers\VehiculosController');
    Route::resource('reservas', 'App\Http\Controllers\ReservasController');
    Route::resource('reservasDetalle', 'App\Http\Controllers\ReservasDetallesController');
});

require __DIR__.'/auth.php';
