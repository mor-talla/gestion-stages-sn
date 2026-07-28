<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================
// 1. PAGE D'ACCUEIL (LANDING PAGE)
// ============================================
Route::get('/', function () {
    // Si l'utilisateur est connecté, rediriger vers dashboard
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    // Sinon, afficher la landing page
    return view('landing');
})->name('landing');

// ============================================
// 2. DASHBOARD (protégé par authentification)
// ============================================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// ============================================
// 3. ROUTES D'AUTHENTIFICATION (Breeze)
// ============================================
require __DIR__.'/auth.php';

// ============================================
// 4. ROUTES PROTÉGÉES PAR AUTH (utilisateurs connectés)
// ============================================
Route::middleware(['auth'])->group(function () {
    
    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Stages (CRUD complet)
    Route::resource('stages', StageController::class);
    
    // Entreprises (CRUD complet)
    Route::resource('entreprises', EntrepriseController::class);
    
    // Candidatures (CRUD complet)
    Route::resource('candidatures', CandidatureController::class);
    
    // Routes supplémentaires pour les candidatures
    Route::get('/candidatures/create/{stage}', [CandidatureController::class, 'create'])->name('candidatures.create');
    Route::put('/candidatures/{candidature}/accept', [CandidatureController::class, 'accept'])->name('candidatures.accept');
    Route::put('/candidatures/{candidature}/refuse', [CandidatureController::class, 'refuse'])->name('candidatures.refuse');
});

// ============================================
// 5. ROUTES ADMIN (protégées par auth + admin)
// ============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/entreprises', [AdminController::class, 'entreprises'])->name('entreprises');
    Route::get('/stages', [AdminController::class, 'stages'])->name('stages');
    Route::get('/candidatures', [AdminController::class, 'candidatures'])->name('candidatures');
});

Route::get('/auth/google', [SocialController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/auth/github', [SocialController::class, 'redirectToGithub'])->name('github.redirect');
Route::get('/auth/github/callback', [SocialController::class, 'handleGithubCallback'])->name('github.callback');

use App\Http\Controllers\SocialController;

// Routes d'authentification sociale
Route::get('/auth/{provider}/redirect', [SocialController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialController::class, 'callback'])->name('social.callback');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // ... autres routes
    
    // Gestion des entreprises (admin)
    Route::get('/entreprises/create', [AdminController::class, 'createEntreprise'])->name('entreprises.create');
    Route::post('/entreprises', [AdminController::class, 'storeEntreprise'])->name('entreprises.store');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Ces routes doivent exister avec ces noms de méthodes
    Route::get('/entreprises', [AdminController::class, 'entreprises'])->name('entreprises');
    Route::get('/stages', [AdminController::class, 'stages'])->name('stages');
    Route::get('/candidatures', [AdminController::class, 'candidatures'])->name('candidatures');
    
    // Pour la création d'entreprise par l'admin
    Route::get('/entreprises/create', [AdminController::class, 'createEntreprise'])->name('entreprises.create');
    Route::post('/entreprises', [AdminController::class, 'storeEntreprise'])->name('entreprises.store');
});
// Routes Admin (protégées par auth + admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Gestion des entreprises (admin)
    Route::get('/entreprises', [AdminController::class, 'entreprises'])->name('entreprises');
    Route::get('/entreprises/create', [AdminController::class, 'createEntreprise'])->name('entreprises.create');
    Route::post('/entreprises', [AdminController::class, 'storeEntreprise'])->name('entreprises.store');
    
    Route::get('/stages', [AdminController::class, 'stages'])->name('stages');
    Route::get('/candidatures', [AdminController::class, 'candidatures'])->name('candidatures');
});