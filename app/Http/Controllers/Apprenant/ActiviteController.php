<?php
// app/Http/Controllers/Apprenant/ActiviteController.php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use App\Models\Inscription;
use App\Models\Contenu;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActiviteController extends Controller
{
    /**
     * Afficher l'historique des activités de l'apprenant
     */
    public function index(Request $request)
    {
        $apprenant = Auth::user();
        
        // Récupérer les IDs des formations de l'apprenant
        $formationsIds = Inscription::where('user_id', $apprenant->id)
            ->pluck('formation_id');
        
        // Récupérer les IDs des modules de ces formations
        $modulesIds = Module::whereIn('formation_id', $formationsIds)
            ->pluck('id');
        
        // Construire la collection d'activités
        $activites = collect();
        
        // 1. Activités d'inscription aux formations
        $inscriptions = Inscription::where('user_id', $apprenant->id)
            ->with('formation')
            ->latest()
            ->get()
            ->map(function($item) {
                return (object)[
                    'type' => 'inscription',
                    'icone' => 'person-plus',
                    'titre' => 'Inscription à une formation',
                    'description' => 'Vous vous êtes inscrit à "' . $item->formation->titre . '"',
                    'formation' => $item->formation,
                    'created_at' => $item->created_at,
                    'couleur' => 'primary'
                ];
            });
        
        $activites = $activites->concat($inscriptions);
        
        // 2. Accès aux ressources/contenus
        $contenus = Contenu::whereIn('module_id', $modulesIds)
            ->with('module.formation')
            ->latest()
            ->take(20)
            ->get()
            ->map(function($item) {
                return (object)[
                    'type' => 'ressource',
                    'icone' => 'download',
                    'titre' => 'Consultation de ressource',
                    'description' => 'Vous avez consulté "' . ($item->description ?? 'une ressource') . '"',
                    'formation' => $item->module->formation,
                    'created_at' => $item->created_at,
                    'couleur' => 'success'
                ];
            });
        
        $activites = $activites->concat($contenus);
        
        // 3. Simulation de progression (à remplacer par votre logique réelle)
        // Ceci est un exemple, vous devrez adapter selon votre système de suivi
        $progression = Inscription::where('user_id', $apprenant->id)
            ->where('statut', 'en_cours')
            ->with('formation')
            ->get()
            ->map(function($item) {
                return (object)[
                    'type' => 'progression',
                    'icone' => 'graph-up',
                    'titre' => 'Progression',
                    'description' => 'Vous avez progressé dans "' . $item->formation->titre . '"',
                    'formation' => $item->formation,
                    'created_at' => now()->subHours(rand(1, 48)),
                    'couleur' => 'info'
                ];
            });
        
        $activites = $activites->concat($progression);
        
        // Trier par date (les plus récentes d'abord)
        $activites = $activites->sortByDesc('created_at');
        
        // Pagination manuelle
        $perPage = 15;
        $currentPage = $request->get('page', 1);
        $pagedData = $activites->forPage($currentPage, $perPage)->values();
        
        $activites = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData,
            $activites->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );
        
        // Statistiques pour le résumé
        $stats = [
            'total_inscriptions' => $inscriptions->count(),
            'total_contenus' => $contenus->count(),
            'derniere_activite' => $activites->isNotEmpty() ? $activites->first()->created_at : null,
        ];
        
        return view('apprenant.activite.index', compact('activites', 'stats'));
    }
    
    /**
     * Filtrer les activités par type
     */
    public function filter(Request $request)
    {
        $type = $request->get('type', 'tout');
        $apprenant = Auth::user();
        
        // Logique de filtrage similaire mais avec filtre
        // Rediriger vers index avec paramètre
        return redirect()->route('apprenant.activite', ['type' => $type]);
    }
}