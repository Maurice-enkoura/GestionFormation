<?php
// app/Http/Controllers/Apprenant/ApprenantDashboardController.php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use App\Models\Inscription;
use App\Models\Formation;
use App\Models\Contenu;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprenantDashboardController extends Controller
{
    public function dashboard()
    {
        $apprenant = Auth::user();
        
        // Récupérer les IDs des formations auxquelles l'apprenant est inscrit
        $formationsIds = Inscription::where('user_id', $apprenant->id)
            ->pluck('formation_id');
        
        // Compter les formations par statut
        $totalInscriptions = Inscription::where('user_id', $apprenant->id)->count();
        $formationsEnCours = Inscription::where('user_id', $apprenant->id)
            ->where('statut', 'en_cours')
            ->count();
        $formationsTerminees = Inscription::where('user_id', $apprenant->id)
            ->where('statut', 'termine')
            ->count();
        
        // Compter les ressources disponibles (contenus)
        $modulesIds = Module::whereIn('formation_id', $formationsIds)->pluck('id');
        $ressourcesCount = Contenu::whereIn('module_id', $modulesIds)->count();
        
        // Statistiques pour les cards
        $stats = [
            'total_inscriptions' => $totalInscriptions,
            'formations_en_cours' => $formationsEnCours,
            'formations_terminees' => $formationsTerminees,
            'total_ressources' => $ressourcesCount
        ];
        
        // Formations en cours avec progression (simulée pour l'instant)
        $formationsEnCoursList = Inscription::where('user_id', $apprenant->id)
            ->with(['formation.formateur'])
            ->where('statut', 'en_cours')
            ->latest()
            ->take(3)
            ->get()
            ->map(function($inscription) {
                // Simuler une progression (à remplacer par votre logique réelle)
                $inscription->formation->pivot = (object)[
                    'progression' => rand(10, 90)
                ];
                return $inscription->formation;
            });
        
        // Activité récente (basée sur les inscriptions)
        $activitesRecentes = Inscription::where('user_id', $apprenant->id)
            ->with('formation')
            ->latest()
            ->take(4)
            ->get()
            ->map(function($inscription) {
                return (object)[
                    'icone' => 'book',
                    'titre' => 'Inscription à une formation',
                    'description' => 'Vous vous êtes inscrit à "' . $inscription->formation->titre . '"',
                    'created_at' => $inscription->created_at
                ];
            });
        
        if ($activitesRecentes->isEmpty()) {
            $activitesRecentes = collect([
                (object)[
                    'icone' => 'info-circle',
                    'titre' => 'Bienvenue sur EduForm',
                    'description' => 'Commencez votre parcours d\'apprentissage',
                    'created_at' => now()
                ]
            ]);
        }
        
        return view('apprenant.dashboard', compact(
            'stats', 
            'formationsEnCoursList',
            'activitesRecentes',
            'ressourcesCount'
        ));
    }
    
    public function activite()
    {
        $apprenant = Auth::user();
        
        $activites = Inscription::where('user_id', $apprenant->id)
            ->with('formation')
            ->latest()
            ->paginate(15);
        
        return view('apprenant.activite.index', compact('activites'));
    }
}