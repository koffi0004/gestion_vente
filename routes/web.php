<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProfileController;

// ✅ Page d'accueil (on remplace welcome)
Route::get('/', function () {
    return view('dashboard'); // ← maintenant / affiche ton dashboard
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sales/{sale}/receipt', [SaleController::class, 'receipt'])->name('sales.receipt');
// ✅ Ressources protégées par auth

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('sales', SaleController::class);

    // Optionnel : Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Authentification Breeze / Jetstream
require __DIR__.'/auth.php';