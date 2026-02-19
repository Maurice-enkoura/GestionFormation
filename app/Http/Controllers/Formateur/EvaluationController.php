<?php
// app/Http/Controllers/Formateur/EvaluationController.php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    /**
     * Afficher la liste des évaluations
     */
    public function index(Request $request)
    {
        $formateur = Auth::user();
        
        $formationsIds = Formation::where('formateur_id', $formateur->id)->pluck('id');
        
        $query = Evaluation::whereIn('formation_id', $formationsIds)
            ->with(['formation', 'user']);
        
        // Filtre par formation
        if ($request->filled('formation_id')) {
            $query->where('formation_id', $request->formation_id);
        }
        
        $evaluations = $query->latest()->paginate(15);
        
        $formations = Formation::where('formateur_id', $formateur->id)->get();
        
        return view('formateur.evaluations.index', compact('evaluations', 'formations'));
    }

    /**
     * Afficher les détails d'une évaluation
     */
    public function show(Evaluation $evaluation)
    {
        $formateur = Auth::user();
        
        // Vérifier que l'évaluation concerne une formation du formateur
        if ($evaluation->formation->formateur_id != $formateur->id) {
            abort(403);
        }
        
        $evaluation->load(['formation', 'user']);
        
        return view('formateur.evaluations.show', compact('evaluation'));
    }
}