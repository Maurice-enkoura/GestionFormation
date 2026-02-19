<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UtilisateurController;
use App\Http\Controllers\Admin\FormationController;
use App\Http\Controllers\Admin\FormateurController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\ContenuController;

use App\Http\Controllers\Formateur\FormateurDashboardController;
use App\Http\Controllers\Formateur\FormationController as FormateurFormationController;
use App\Http\Controllers\Formateur\ApprenantController as FormateurApprenantController;
use App\Http\Controllers\Formateur\EvaluationController as FormateurEvaluationController;
use App\Http\Controllers\Formateur\MessageController as FormateurMessageController;
use App\Http\Controllers\Formateur\ProfilController as FormateurProfilController;

use App\Http\Controllers\Apprenant\ApprenantDashboardController;
use App\Http\Controllers\Apprenant\FormationController as ApprenantFormationController;
use App\Http\Controllers\Apprenant\RessourceController as ApprenantRessourceController;
use App\Http\Controllers\Apprenant\ProfilController as ApprenantProfilController;
use App\Http\Controllers\Apprenant\ActiviteController as ApprenantActiviteController;

use App\Http\Controllers\HomeController;

// ==============================
// ROUTES PUBLIQUES
// ==============================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Liste publique des formations
Route::get('/formations', [HomeController::class, 'formations'])->name('formations');
Route::get('/formations/recherche', [HomeController::class, 'search'])->name('formations.search'); // Route pour la recherche
Route::get('/formations/{id}', [HomeController::class, 'showFormation'])->name('formations.show'); // Route pour le détail d'une formation

// ==============================
// AUTHENTIFICATION
// ==============================
Route::get('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])->name('login.store');

Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])->name('register.store');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// ==============================
// ADMIN
// ==============================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

    // CRUD utilisateurs
    Route::resource('utilisateurs', UtilisateurController::class);

    // CRUD formations
    Route::resource('formations', FormationController::class);
    
    // Route supplémentaire pour les statistiques des formations
    Route::get('/formations/{formation}/statistiques', [FormationController::class, 'statistiques'])->name('formations.statistiques');

    // Modules
    Route::post('/formations/{formation}/modules', [ModuleController::class, 'store'])->name('formations.modules.store');
    Route::put('/modules/{module}', [ModuleController::class, 'update'])->name('modules.update');
    Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy');

    // Contenus
    Route::post('/modules/{module}/contenus', [ContenuController::class, 'store'])->name('contenus.store');
    Route::put('/contenus/{contenu}', [ContenuController::class, 'update'])->name('contenus.update');
    Route::delete('/contenus/{contenu}', [ContenuController::class, 'destroy'])->name('contenus.destroy');

    // Gestion des formateurs
    Route::resource('formateurs', FormateurController::class);
});

// ==============================
// FORMATEUR - ROUTES COMPLÈTES (DÉCOMMENTÉES)
// ==============================
// ==============================
// FORMATEUR - ROUTES COMPLÈTES (AVEC MODULES ET CONTENUS)
// ==============================
Route::middleware(['auth', 'formateur'])->prefix('formateur')->name('formateur.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [FormateurDashboardController::class, 'dashboard'])->name('dashboard');
    

    // Gestion des formations (CRUD complet)
    Route::resource('formations', FormateurFormationController::class);
    
    // Ajouter un module à une formation
    Route::post('/formations/{formation}/modules', [App\Http\Controllers\Formateur\ModuleController::class, 'store'])
         ->name('formations.modules.store');
    
    // Modifier un module
    Route::put('/modules/{module}', [App\Http\Controllers\Formateur\ModuleController::class, 'update'])
         ->name('modules.update');
    
    // Supprimer un module
    Route::delete('/modules/{module}', [App\Http\Controllers\Formateur\ModuleController::class, 'destroy'])
         ->name('modules.destroy');
    
    // ===== ROUTES POUR LES CONTENUS =====
    // Ajouter un contenu à un module
    Route::post('/modules/{module}/contenus', [App\Http\Controllers\Formateur\ContenuController::class, 'store'])
         ->name('contenus.store');
    
    // Modifier un contenu
    Route::put('/contenus/{contenu}', [App\Http\Controllers\Formateur\ContenuController::class, 'update'])
         ->name('contenus.update');
    
    // Supprimer un contenu
    Route::delete('/contenus/{contenu}', [App\Http\Controllers\Formateur\ContenuController::class, 'destroy'])
         ->name('contenus.destroy');
    
    // Gestion des apprenants
    Route::get('/apprenants', [FormateurApprenantController::class, 'index'])->name('apprenants.index');
    Route::get('/apprenants/{apprenant}', [FormateurApprenantController::class, 'show'])->name('apprenants.show');
    
    // Évaluations
    Route::get('/evaluations', [FormateurEvaluationController::class, 'index'])->name('evaluations.index');
    Route::get('/evaluations/{evaluation}', [FormateurEvaluationController::class, 'show'])->name('evaluations.show');
    
    // Messages
    Route::get('/messages', [FormateurMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [FormateurMessageController::class, 'show'])->name('messages.show');
    Route::post('/messages', [FormateurMessageController::class, 'store'])->name('messages.store');
    
    // Profil
    Route::get('/profil', [FormateurProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [FormateurProfilController::class, 'update'])->name('profil.update');
    
    // Paramètres
    Route::get('/parametres', [FormateurProfilController::class, 'settings'])->name('parametres');
    Route::put('/parametres', [FormateurProfilController::class, 'updateSettings'])->name('parametres.update');
});
// ==============================
// APPRENANT - ROUTES COMPLÈTES (DÉCOMMENTÉES)
// ==============================
Route::middleware(['auth', 'apprenant'])->prefix('apprenant')->name('apprenant.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [ApprenantDashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/formations/{id}/inscrire', [ApprenantFormationController::class, 'inscrire'])
         ->name('formations.inscrire');
    
    // Formations
    Route::get('/formations', [ApprenantFormationController::class, 'index'])->name('formations');
    Route::get('/formation/{id}', [ApprenantFormationController::class, 'show'])->name('formation.show');
    
    // Continuer (dernière formation)
    Route::get('/continuer', [ApprenantFormationController::class, 'continuer'])->name('continuer');
    
    // Ressources (utilise Contenu au lieu de Ressource)
    Route::get('/ressources', [ApprenantRessourceController::class, 'index'])->name('ressources');
    Route::get('/ressources/{id}/download', [ApprenantRessourceController::class, 'download'])->name('ressources.download');
    
    // Profil
    Route::get('/profil', [ApprenantProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [ApprenantProfilController::class, 'update'])->name('profil.update');
    
    // Paramètres
    Route::get('/parametres', [ApprenantProfilController::class, 'settings'])->name('parametres');
    Route::put('/parametres', [ApprenantProfilController::class, 'updateSettings'])->name('parametres.update');
    
    // Activité
    Route::get('/activite', [ApprenantActiviteController::class, 'index'])->name('activite');
});