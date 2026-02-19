<?php
// app/Http/Controllers/Formateur/FormationController.php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\Module;
use App\Models\Contenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FormationController extends Controller
{
    /**
     * Afficher la liste des formations du formateur
     */
    public function index()
    {
        $formateur = Auth::user();
        
        $formations = Formation::where('formateur_id', $formateur->id)
            ->withCount(['modules', 'inscriptions'])
            ->latest()
            ->paginate(10);
        
        return view('formateur.formations.index', compact('formations'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('formateur.formations.create');
    }

    /**
     * Enregistrer une nouvelle formation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'image_url' => 'nullable|url',
        ]);

        $validated['formateur_id'] = Auth::id();
        
        $formation = Formation::create($validated);

        return redirect()->route('formateur.formations.show', $formation)
            ->with('success', 'Formation créée avec succès.');
    }

    /**
     * Afficher les détails d'une formation
     */
    public function show(Formation $formation)
    {
        $this->authorize('view', $formation);
        
        $formation->load(['modules.contenus', 'inscriptions.user']);
        
        $stats = [
            'total_modules' => $formation->modules->count(),
            'total_contenus' => $formation->modules->sum(function($module) {
                return $module->contenus->count();
            }),
            'total_inscriptions' => $formation->inscriptions->count(),
        ];
        
        return view('formateur.formations.show', compact('formation', 'stats'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Formation $formation)
    {
        $this->authorize('update', $formation);
        
        return view('formateur.formations.edit', compact('formation'));
    }

    /**
     * Mettre à jour une formation
     */
    public function update(Request $request, Formation $formation)
    {
        $this->authorize('update', $formation);
        
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'image_url' => 'nullable|url',
        ]);

        $formation->update($validated);

        return redirect()->route('formateur.formations.show', $formation)
            ->with('success', 'Formation mise à jour avec succès.');
    }

    /**
     * Supprimer une formation
     */
    public function destroy(Formation $formation)
    {
        $this->authorize('delete', $formation);
        
        $formation->delete();

        return redirect()->route('formateur.formations.index')
            ->with('success', 'Formation supprimée avec succès.');
    }



    
}