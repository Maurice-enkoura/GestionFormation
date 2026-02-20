<?php
// app/Http/Controllers/Apprenant/EvaluationController.php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Formation;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    /**
     * Afficher le formulaire d'évaluation
     */
    public function create(Formation $formation)
    {
        // Vérifier que l'apprenant est inscrit à cette formation
        $inscription = Inscription::where('user_id', Auth::id())
            ->where('formation_id', $formation->id)
            ->firstOrFail();
        
        // Vérifier s'il a déjà évalué
        $dejaEvalue = Evaluation::where('user_id', Auth::id())
            ->where('formation_id', $formation->id)
            ->exists();
        
        if ($dejaEvalue) {
            return redirect()->route('apprenant.formation.show', $formation)
                ->with('info', 'Vous avez déjà évalué cette formation.');
        }
        
        return view('apprenant.evaluations.create', compact('formation'));
    }

    /**
     * Enregistrer une évaluation
     */
    public function store(Request $request, Formation $formation)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:500',
        ]);

        Evaluation::create([
            'user_id' => Auth::id(),
            'formation_id' => $formation->id,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
            'est_publiee' => false, // En attente de modération
        ]);

        return redirect()->route('apprenant.formation.show', $formation)
            ->with('success', 'Merci pour votre évaluation ! Elle sera publiée après modération.');
    }

    /**
     * Modifier une évaluation existante
     */
    public function edit(Evaluation $evaluation)
    {
        if ($evaluation->user_id != Auth::id()) {
            abort(403);
        }
        
        return view('apprenant.evaluations.edit', compact('evaluation'));
    }

    /**
     * Mettre à jour une évaluation
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        if ($evaluation->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:500',
        ]);

        $evaluation->update([
            'note' => $request->note,
            'commentaire' => $request->commentaire,
            'est_publiee' => false, // Remettre en modération
        ]);

        return redirect()->route('apprenant.formation.show', $evaluation->formation_id)
            ->with('success', 'Votre évaluation a été mise à jour.');
    }
}