<?php
// app/Http/Controllers/Formateur/FormateurDashboardController.php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Formation;
use App\Models\Module;
use App\Models\Contenu;
use App\Models\Inscription;
use App\Models\Evaluation;

class FormateurDashboardController extends Controller
{
    public function dashboard()
    {
        $formateur = Auth::user();
        $formationsIds = Formation::where('formateur_id', $formateur->id)->pluck('id');

        // Stats détaillées
        $stats = [
            'total_formations' => $formateur->formations()->count(),
            'total_modules' => Module::whereIn('formation_id', $formationsIds)->count(),
            'total_contenus' => Contenu::whereIn('module_id', 
                Module::whereIn('formation_id', $formationsIds)->pluck('id')
            )->count(),
            'total_apprenants' => Inscription::whereIn('formation_id', $formationsIds)->count(),
            'note_moyenne' => round(
                Evaluation::whereIn('formation_id', $formationsIds)
                    ->where('est_publiee', true)
                    ->avg('note') ?? 0, 
                1
            ),
        ];

        // Formations récentes (3 dernières)
        $formations = Formation::where('formateur_id', $formateur->id)
            ->withCount(['inscriptions', 'modules'])
            ->latest()
            ->take(3)
            ->get();

        // Activité récente (mix d'inscriptions, avis, complétions)
        $activites = $this->getActivitesRecentes($formationsIds);

        // Apprenants récents (5 derniers inscrits)
        $apprenantsRecents = Inscription::whereIn('formation_id', $formationsIds)
            ->with(['user', 'formation'])
            ->latest()
            ->take(5)
            ->get();

        // Derniers avis (5 derniers)
        $derniersAvis = Evaluation::whereIn('formation_id', $formationsIds)
            ->where('est_publiee', true)
            ->with(['user', 'formation'])
            ->latest()
            ->take(5)
            ->get();

        // Stats pour le graphique (inscriptions par mois)
        $inscriptionsParMois = $this->getInscriptionsParMois($formationsIds);

        return view('formateur.index', compact(
            'formateur',
            'stats',
            'formations',
            'activites',
            'apprenantsRecents',
            'derniersAvis',
            'inscriptionsParMois'
        ));
    }

    /**
     * Récupère les activités récentes (inscriptions, avis, complétions)
     */
    private function getActivitesRecentes($formationsIds)
    {
        // Nouvelles inscriptions
        $inscriptions = Inscription::whereIn('formation_id', $formationsIds)
            ->with(['user', 'formation'])
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return (object)[
                    'type' => 'inscription',
                    'icon' => 'person-add',
                    'titre' => 'Nouvel apprenant',
                    'description' => $item->user->nom . ' a rejoint "' . $item->formation->titre . '"',
                    'time' => $item->created_at->diffForHumans(),
                    'created_at' => $item->created_at
                ];
            });

        // Nouveaux avis
        $evaluations = Evaluation::whereIn('formation_id', $formationsIds)
            ->where('est_publiee', true)
            ->with(['user', 'formation'])
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return (object)[
                    'type' => 'avis',
                    'icon' => 'star',
                    'titre' => 'Nouvel avis ' . $item->note . '/5',
                    'description' => $item->user->nom . ' a noté "' . $item->formation->titre . '"',
                    'time' => $item->created_at->diffForHumans(),
                    'created_at' => $item->created_at
                ];
            });

        // Formations terminées
        $completions = Inscription::whereIn('formation_id', $formationsIds)
            ->where('statut', 'termine')
            ->with(['user', 'formation'])
            ->latest('updated_at')
            ->take(3)
            ->get()
            ->map(function ($item) {
                return (object)[
                    'type' => 'completion',
                    'icon' => 'trophy',
                    'titre' => 'Formation terminée',
                    'description' => $item->user->nom . ' a terminé "' . $item->formation->titre . '"',
                    'time' => $item->updated_at->diffForHumans(),
                    'created_at' => $item->updated_at
                ];
            });

        // Fusionner et trier par date
        $activites = $inscriptions->concat($evaluations)->concat($completions)
            ->sortByDesc('created_at')
            ->take(7)
            ->values();

        return $activites;
    }

    /**
     * Récupère le nombre d'inscriptions par mois pour l'année en cours
     */
    private function getInscriptionsParMois($formationsIds)
    {
        $inscriptions = Inscription::whereIn('formation_id', $formationsIds)
            ->select(
                DB::raw('MONTH(created_at) as mois'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->pluck('total', 'mois')
            ->toArray();

        // Initialiser un tableau avec 12 mois
        $mois = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
        $donnees = array_fill(0, 12, 0);

        foreach ($inscriptions as $moisNum => $total) {
            $donnees[$moisNum - 1] = $total;
        }

        return [
            'labels' => $mois,
            'data' => $donnees
        ];
    }

    /**
     * Détail d'une formation avec ses modules et contenus
     */
    public function showFormation($id)
    {
        $formation = Formation::where('formateur_id', Auth::id())
            ->with(['modules.contenus', 'inscriptions.user'])
            ->findOrFail($id);

        return view('formateur.formation-show', compact('formation'));
    }

    /**
     * Statistiques détaillées d'une formation
     */
    public function formationStats($id)
    {
        $formation = Formation::where('formateur_id', Auth::id())->findOrFail($id);

        $stats = [
            'total_inscrits' => $formation->inscriptions()->count(),
            'en_cours' => $formation->inscriptions()->where('statut', 'en_cours')->count(),
            'termines' => $formation->inscriptions()->where('statut', 'termine')->count(),
            'note_moyenne' => $formation->note_moyenne,
            'total_evaluations' => $formation->total_evaluations,
            'distribution_notes' => $formation->distribution_notes,
        ];

        return response()->json($stats);
    }
}