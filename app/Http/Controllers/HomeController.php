<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\User;
use App\Models\Inscription;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Page d'accueil
     */
    public function index()
    {
        // Statistiques générales
        $stats = [
            'total_formations' => Formation::count(),
            'total_apprenants' => User::where('role', 'apprenant')->count(),
            'total_formateurs' => User::where('role', 'formateur')->count(),
            'total_inscriptions' => Inscription::count(),
        ];

        // Dernières formations (avec pagination)
        $formations = Formation::with(['formateur', 'modules'])
                        ->latest()
                        ->paginate(6);

        // Formations les plus populaires
        $formationsPopulaires = Formation::withCount('inscriptions')
                                ->with('formateur')
                                ->orderBy('inscriptions_count', 'desc')
                                ->take(3)
                                ->get();

        // Top formateurs
        $topFormateurs = User::where('role', 'formateur')
                        ->withCount('formations')
                        ->orderBy('formations_count', 'desc')
                        ->take(4)
                        ->get();

        // Derniers avis / témoignages
        $temoignages = Evaluation::with(['user', 'formation'])
                        ->where('est_publiee', true)
                        ->latest()
                        ->take(3)
                        ->get();

        return view('home', compact(
            'stats',
            'formations',
            'formationsPopulaires',
            'topFormateurs',
            'temoignages'
        ));
    }

    /**
     * Page de liste des formations
     */
    public function formations(Request $request)
    {
        $formations = Formation::with('formateur')
                        ->latest()
                        ->paginate(12);

        return view('formations.index', compact('formations'));
    }

    /**
     * Recherche de formations
     */
    public function search(Request $request)
    {
        $query = Formation::with('formateur');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $formations = $query->latest()->paginate(12)->withQueryString();

        $searchTerm = $request->search;

        return view('formations.search', compact('formations', 'searchTerm'));
    }

    /**
     * Détail d'une formation
     */
    public function showFormation($id)
    {
        $formation = Formation::with(['formateur', 'modules.contenus', 'evaluations.user'])
                     ->findOrFail($id);

        // Note moyenne
        $noteMoyenne = $formation->evaluations()->avg('note') ?? 0;
        
        // Formations similaires (par exemple dernières ajoutées)
        $formationsSimilaires = Formation::where('id', '!=', $formation->id)
                               ->with('formateur')
                               ->take(3)
                               ->get();

        return view('formations.show', compact('formation', 'noteMoyenne', 'formationsSimilaires'));
    }
}
