<?php
// app/Http/Controllers/Admin/FormationController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormationController extends Controller
{
    /**
     * Affiche la liste des formations
     */
    public function index(Request $request)
    {
        $query = Formation::with('formateur', 'modules');
        
        // Filtre par recherche
        if ($request->filled('search')) {
            $query->where('titre', 'like', '%' . $request->search . '%');
        }
        
        // Filtre par formateur
        if ($request->filled('formateur_id')) {
            $query->where('formateur_id', $request->formateur_id);
        }
        
        $formations = $query->latest()->paginate(15);
        
        $formateurs = User::where('role', 'formateur')->get();
        
        $stats = [
            'total' => Formation::count(),
            'publiees' => Formation::count(),
            'inscriptions' => Formation::withCount('inscriptions')->get()->sum('inscriptions_count'),
        ];
        
        return view('admin.formations.index', compact('formations', 'formateurs', 'stats'));
    }
    
    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $formateurs = User::where('role', 'formateur')->get();
        return view('admin.formations.create', compact('formateurs'));
    }
    
    /**
     * Enregistre une nouvelle formation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'formateur_id' => 'required|exists:users,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);
        
        $formation = Formation::create($validated);
        
        return redirect()->route('admin.formations.edit', $formation)
            ->with('success', 'Formation créée avec succès. Vous pouvez maintenant ajouter des modules.');
    }
    
    /**
     * Affiche les détails d'une formation
     */
    public function show(Formation $formation)
    {
        $formation->load(['formateur', 'modules.contenus', 'inscriptions.user']);
        
        $stats = [
            'total_inscrits' => $formation->inscriptions()->count(),
            'progression_moyenne' => 75, // À calculer selon votre logique
            'nombre_modules' => $formation->modules->count(),
            'nombre_contenus' => $formation->modules->sum(function($module) {
                return $module->contenus->count();
            }),
        ];
        
        return view('admin.formations.show', compact('formation', 'stats'));
    }
    
    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Formation $formation)
    {
        $formation->load('modules.contenus');
        $formateurs = User::where('role', 'formateur')->get();
        
        return view('admin.formations.edit', compact('formation', 'formateurs'));
    }
    
    /**
     * Met à jour une formation
     */
    public function update(Request $request, Formation $formation)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'formateur_id' => 'required|exists:users,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);
        
        $formation->update($validated);
        
        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation modifiée avec succès.');
    }
    
    /**
     * Supprime une formation
     */
    public function destroy(Formation $formation)
    {
        $formation->delete();
        
        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation supprimée avec succès.');
    }
    
    /**
     * Affiche les statistiques d'une formation
     */
    public function statistiques(Formation $formation)
    {
        $formation->loadCount('inscriptions');
        
        // Statistiques des inscriptions par mois
        $inscriptionsParMois = $formation->inscriptions()
            ->select(DB::raw('MONTH(created_at) as mois'), DB::raw('COUNT(*) as total'))
            ->whereYear('created_at', now()->year)
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();
        
        $stats = [
            'total_inscrits' => $formation->inscriptions_count,
            'taux_completion' => 75, // À calculer
            'progression_modules' => $formation->modules->map(function($module) {
                return [
                    'titre' => $module->titre,
                    'completion' => rand(60, 100) // À remplacer par vraies données
                ];
            }),
            'inscriptions_mensuelles' => $inscriptionsParMois,
        ];
        
        return view('admin.formations.statistiques', compact('formation', 'stats'));
    }
}