<?php
// app/Policies/EvaluationPolicy.php

namespace App\Policies;

use App\Models\Evaluation;
use App\Models\User;

class EvaluationPolicy
{
    /**
     * Vérifier si un utilisateur peut créer une évaluation
     */
    public function create(User $user, $formation)
    {
        // L'utilisateur doit être un apprenant inscrit à la formation
        return $user->role === 'apprenant' && 
               $user->inscriptions()->where('formation_id', $formation->id)->exists();
    }

    /**
     * Vérifier si un utilisateur peut modifier une évaluation
     */
    public function update(User $user, Evaluation $evaluation)
    {
        // Seul l'auteur peut modifier son évaluation
        return $user->id === $evaluation->user_id;
    }

    /**
     * Vérifier si un utilisateur peut supprimer une évaluation
     */
    public function delete(User $user, Evaluation $evaluation)
    {
        // L'auteur ou un admin peut supprimer
        return $user->id === $evaluation->user_id || $user->role === 'admin';
    }

    /**
     * Vérifier si un utilisateur peut voir les évaluations
     */
    public function view(User $user, Evaluation $evaluation)
    {
        // Tout le monde peut voir les évaluations publiées
        if ($evaluation->est_publiee) {
            return true;
        }
        
        // Sinon, seulement l'auteur ou le formateur concerné
        return $user->id === $evaluation->user_id || 
               $user->id === $evaluation->formateur_id ||
               $user->role === 'admin';
    }
}