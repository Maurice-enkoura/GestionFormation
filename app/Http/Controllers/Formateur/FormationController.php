<?php
// app/Http/Controllers/Formateur/FormationController.php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\Module;
use App\Models\Contenu;
use App\Models\Inscription;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormationController extends Controller
{
    /**
     * Affiche la liste des formations du formateur
     */
    public function index()
    {
        $formateur = Auth::user();
        $formations = Formation::where('formateur_id', $formateur->id)
            ->withCount(['inscriptions', 'modules'])
            ->latest()
            ->paginate(10);

        // Récupérer les activités récentes pour les notifications
        $formationsIds = Formation::where('formateur_id', $formateur->id)->pluck('id');
        $activites = $this->getActivitesRecentes($formationsIds);

        return view('formateur.formations.index', compact('formateur', 'formations', 'activites'));
    }

    /**
     * Récupère les activités récentes
     */
    private function getActivitesRecentes($formationsIds)
    {
        if ($formationsIds->isEmpty()) {
            return collect([]);
        }

        // Nouvelles inscriptions
        $inscriptions = Inscription::whereIn('formation_id', $formationsIds)
            ->with(['user', 'formation'])
            ->latest()
            ->take(5)
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
            ->take(5)
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
            ->take(5)
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

        // Fusionner, trier par date et limiter
        $activites = $inscriptions->concat($evaluations)->concat($completions)
            ->sortByDesc('created_at')
            ->take(7)
            ->values();

        return $activites;
    }

    /**
     * Affiche le formulaire de création d'une formation
     */
    public function create()
    {
        $formateur = Auth::user();
        return view('formateur.formations.create', compact('formateur'));
    }

    /**
     * Enregistre une nouvelle formation
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
        ]);

        $formation = Formation::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'formateur_id' => Auth::id(),
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
        ]);

        return redirect()->route('formateur.formations.show', $formation)
            ->with('success', 'Formation créée avec succès !');
    }

    /**
     * Affiche les détails d'une formation
     */
    public function show($id)
    {
        $formation = Formation::where('formateur_id', Auth::id())
            ->with(['modules.contenus', 'inscriptions.user'])
            ->findOrFail($id);

        $formateur = Auth::user();

        return view('formateur.formations.show', compact('formation', 'formateur'));
    }

    /**
     * Affiche le formulaire d'édition d'une formation
     */
    public function edit($id)
    {
        $formation = Formation::where('formateur_id', Auth::id())->findOrFail($id);
        $formateur = Auth::user();

        return view('formateur.formations.edit', compact('formation', 'formateur'));
    }

    /**
     * Met à jour une formation
     */
    public function update(Request $request, $id)
    {
        $formation = Formation::where('formateur_id', Auth::id())->findOrFail($id);

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
        ]);

        $formation->update($request->all());

        return redirect()->route('formateur.formations.show', $formation)
            ->with('success', 'Formation mise à jour avec succès !');
    }

    /**
     * Supprime une formation
     */
    public function destroy($id)
    {
        $formation = Formation::where('formateur_id', Auth::id())->findOrFail($id);
        $formation->delete();

        return redirect()->route('formateur.formations.index')
            ->with('success', 'Formation supprimée avec succès !');
    }

    // Dans FormationController
public function statistiques($id)
{
    $formation = Formation::where('formateur_id', Auth::id())->findOrFail($id);
    
    $stats = [
        'inscriptions_par_jour' => $formation->inscriptions()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(30)
            ->get(),
        'completion_rate' => $formation->inscriptions()
            ->where('statut', 'termine')
            ->count() / max($formation->inscriptions()->count(), 1) * 100,
        'modules_les_plus_vus' => $formation->modules()
            ->withCount('vues')
            ->orderBy('vues_count', 'desc')
            ->take(5)
            ->get(),
    ];
    
    return view('formateur.formations.statistiques', compact('formation', 'stats'));
}
}