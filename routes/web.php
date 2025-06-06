<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Öffentlich sichtbare Startseite (Liste aller Beiträge)
Route::get('/', [PostController::class, 'index'])->name('home');

// Authentifizierte Bereiche (Erstellen, Bearbeiten, Löschen, Profil)
Route::middleware(['auth'])->group(function (): void {
    // Post-CRUD (ohne index & show, da öffentlich)
    Route::resource('posts', PostController::class)->except(['index', 'show']);

    // Profilverwaltung
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Einzelner Post darf ebenfalls öffentlich sichtbar sein
// Muss nach der resource-Route kommen, um Konflikte zu vermeiden!
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Auth-Routen von Laravel Breeze/Fortify/etc.
require __DIR__ . '/auth.php';