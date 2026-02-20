<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UtilisateurController;
use App\Http\Controllers\Admin\FormationController;
use App\Http\Controllers\Admin\FormateurController;
use App\Http\Controllers\Admin\ModuleController as AdminModuleController;
use App\Http\Controllers\Admin\ContenuController as AdminContenuController;
use App\Http\Controllers\Admin\EvaluationController as AdminEvaluationController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController; 

use App\Http\Controllers\Formateur\FormateurDashboardController;
use App\Http\Controllers\Formateur\FormationController as FormateurFormationController;
use App\Http\Controllers\Formateur\ModuleController as FormateurModuleController;
use App\Http\Controllers\Formateur\ContenuController as FormateurContenuController;
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
use App\Http\Controllers\SearchController;

// ==============================
// ROUTES PUBLIQUES
// ==============================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Liste publique des formations
Route::get('/formations', [HomeController::class, 'formations'])->name('formations');
Route::get('/formations/recherche', [HomeController::class, 'search'])->name('formations.search');
Route::get('/formations/{id}', [HomeController::class, 'showFormation'])->name('formations.show');

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
// ADMIN - Gestion de la plateforme
// ==============================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    
    // CRUD utilisateurs
    Route::resource('utilisateurs', UtilisateurController::class);
    
    // Gestion des formateurs
    Route::resource('formateurs', FormateurController::class);
    
    // Gestion des formations (sans contenu pédagogique)
    Route::resource('formations', FormationController::class);
    Route::post('/formations/{formation}/activer', [FormationController::class, 'activer'])->name('formations.activer');
    Route::post('/formations/{formation}/desactiver', [FormationController::class, 'desactiver'])->name('formations.desactiver');
    Route::get('/formations/{formation}/statistiques', [FormationController::class, 'statistiques'])->name('formations.statistiques');
    
    // L'admin peut VOIR les modules mais pas les modifier (lecture seule)
    Route::get('/formations/{formation}/modules', [AdminModuleController::class, 'index'])->name('formations.modules.index');
    
    // L'admin peut VOIR les contenus mais pas les modifier (lecture seule)
    Route::get('/modules/{module}/contenus', [AdminContenuController::class, 'index'])->name('modules.contenus.index');
    
    // Modération des évaluations
    Route::get('/evaluations', [AdminEvaluationController::class, 'index'])->name('evaluations.index');
    Route::get('/evaluations/{evaluation}', [AdminEvaluationController::class, 'show'])->name('evaluations.show');
    Route::post('/evaluations/{evaluation}/approuver', [AdminEvaluationController::class, 'approuver'])->name('evaluations.approuver');
    Route::delete('/evaluations/{evaluation}/rejeter', [AdminEvaluationController::class, 'rejeter'])->name('evaluations.rejeter');
    
    // Modération des messages
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
    Route::post('/messages/bannir/{user}', [AdminMessageController::class, 'bannirUtilisateur'])->name('messages.bannir');
    
    // Statistiques globales
    Route::get('/statistiques', [AdminDashboardController::class, 'statistiques'])->name('statistiques');
    
    // Profil admin
    Route::get('/profil', [UtilisateurController::class, 'profil'])->name('profil');
    Route::put('/profil', [UtilisateurController::class, 'updateProfil'])->name('profil.update');
    
    // Paramètres
    Route::get('/parametres', [AdminDashboardController::class, 'parametres'])->name('parametres');
    Route::put('/parametres', [AdminDashboardController::class, 'updateParametres'])->name('parametres.update');
      Route::post('/parametres/security', [AdminDashboardController::class, 'updateSecurity'])->name('parametres.security');
       Route::post('/parametres/email', [AdminDashboardController::class, 'updateEmail'])->name('parametres.email');
       // Maintenance
    Route::post('/maintenance/cache', [AdminDashboardController::class, 'clearCache'])->name('maintenance.cache');
    Route::post('/maintenance/backup', [AdminDashboardController::class, 'backup'])->name('maintenance.backup');
    Route::post('/maintenance/toggle', [AdminDashboardController::class, 'toggleMaintenance'])->name('maintenance.toggle');
});

// ==============================
// FORMATEUR - Gestion des formations (contenu pédagogique)
// ==============================
Route::middleware(['auth', 'formateur'])->prefix('formateur')->name('formateur.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [FormateurDashboardController::class, 'dashboard'])->name('dashboard');
    
    // Gestion des formations (CRUD complet)
    Route::resource('formations', FormateurFormationController::class);
    
    // Gestion des modules (CRUD complet)
    Route::post('/formations/{formation}/modules', [FormateurModuleController::class, 'store'])
         ->name('formations.modules.store');
    Route::put('/modules/{module}', [FormateurModuleController::class, 'update'])
         ->name('modules.update');
    Route::delete('/modules/{module}', [FormateurModuleController::class, 'destroy'])
         ->name('modules.destroy');
    
    // Gestion des contenus (CRUD complet)
    Route::post('/modules/{module}/contenus', [FormateurContenuController::class, 'store'])
         ->name('contenus.store');
    Route::put('/contenus/{contenu}', [FormateurContenuController::class, 'update'])
         ->name('contenus.update');
    Route::delete('/contenus/{contenu}', [FormateurContenuController::class, 'destroy'])
         ->name('contenus.destroy');
    
    // Gestion des apprenants
    Route::get('/apprenants', [FormateurApprenantController::class, 'index'])->name('apprenants.index');
    Route::get('/apprenants/{apprenant}', [FormateurApprenantController::class, 'show'])->name('apprenants.show');
    
    // Évaluations
    Route::get('/evaluations', [FormateurEvaluationController::class, 'index'])->name('evaluations.index');
    Route::get('/evaluations/{evaluation}', [FormateurEvaluationController::class, 'show'])->name('evaluations.show');
    
    // Messages
    Route::get('/messages', [FormateurMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create/{apprenant?}', [FormateurMessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [FormateurMessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{message}', [FormateurMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [FormateurMessageController::class, 'destroy'])->name('messages.destroy');
    
    // Profil
    Route::get('/profil', [FormateurProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [FormateurProfilController::class, 'update'])->name('profil.update');
    
    // Paramètres
    Route::get('/parametres', [FormateurProfilController::class, 'settings'])->name('parametres');
    Route::put('/parametres', [FormateurProfilController::class, 'updateSettings'])->name('parametres.update');
});

// ==============================
// APPRENANT - Formation et apprentissage
// ==============================
Route::middleware(['auth', 'apprenant'])->prefix('apprenant')->name('apprenant.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [ApprenantDashboardController::class, 'dashboard'])->name('dashboard');
    
    // Inscription à une formation
    Route::post('/formations/{id}/inscrire', [ApprenantFormationController::class, 'inscrire'])
         ->name('formations.inscrire');
    
    // Mes formations
    Route::get('/formations', [ApprenantFormationController::class, 'index'])->name('formations');
    Route::get('/formation/{id}', [ApprenantFormationController::class, 'show'])->name('formation.show');
    
    // Suivi de progression
    Route::post('/formation/{id}/progression', [ApprenantFormationController::class, 'updateProgression'])
         ->name('formation.progression');
    
    // Continuer la dernière formation
    Route::get('/continuer', [ApprenantFormationController::class, 'continuer'])->name('continuer');
    
    // Ressources téléchargeables
    Route::get('/ressources', [ApprenantRessourceController::class, 'index'])->name('ressources');
    Route::get('/ressources/{id}/download', [ApprenantRessourceController::class, 'download'])->name('ressources.download');
    
    // Profil
    Route::get('/profil', [ApprenantProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [ApprenantProfilController::class, 'update'])->name('profil.update');
    
    // Paramètres
    Route::get('/parametres', [ApprenantProfilController::class, 'settings'])->name('parametres');
    Route::put('/parametres', [ApprenantProfilController::class, 'updateSettings'])->name('parametres.update');
    
    // Activité récente
    Route::get('/activite', [ApprenantActiviteController::class, 'index'])->name('activite');
    
    // Certificats
    Route::get('/certificats', [ApprenantFormationController::class, 'certificats'])->name('certificats');
    Route::get('/certificats/{id}/download', [ApprenantFormationController::class, 'downloadCertificat'])->name('certificats.download');



    Route::resource('messages', App\Http\Controllers\Apprenant\MessageController::class)
    ->except(['edit', 'update']);

// Évaluations
Route::get('/formations/{formation}/evaluer', [App\Http\Controllers\Apprenant\EvaluationController::class, 'create'])
    ->name('evaluations.create');
Route::post('/formations/{formation}/evaluer', [App\Http\Controllers\Apprenant\EvaluationController::class, 'store'])
    ->name('evaluations.store');
Route::get('/evaluations/{evaluation}/edit', [App\Http\Controllers\Apprenant\EvaluationController::class, 'edit'])
    ->name('evaluations.edit');
Route::put('/evaluations/{evaluation}', [App\Http\Controllers\Apprenant\EvaluationController::class, 'update'])
    ->name('evaluations.update');
});