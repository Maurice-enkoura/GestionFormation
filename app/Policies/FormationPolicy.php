<?php

namespace App\Policies;

use App\Models\Formation;
use App\Models\User;

class FormationPolicy
{
    /**
     * Vérifie si l'utilisateur peut voir la formation
     */
    public function view(User $user, Formation $formation)
    {
        // Un formateur peut voir ses propres formations
        return $formation->formateur_id === $user->id;
    }

    /**
     * Vérifie si l'utilisateur peut mettre à jour la formation
     */
    public function update(User $user, Formation $formation)
    {
        return $formation->formateur_id === $user->id;
    }

    /**
     * Vérifie si l'utilisateur peut supprimer la formation
     */
    public function delete(User $user, Formation $formation)
    {
        return $formation->formateur_id === $user->id;
    }
}
