<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Evaluation;
use App\Models\Formation;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evaluation>
 */
class EvaluationFactory extends Factory
{
    public function definition(): array
    {
        // Choisir un formateur existant
        $formateur = User::where('role', 'formateur')->inRandomOrder()->first();

        // Choisir un apprenant existant différent du formateur
        $apprenant = User::where('role', 'apprenant')
            ->where('id', '!=', $formateur->id)
            ->inRandomOrder()
            ->first();

        // Formation liée au formateur choisi
        $formation = Formation::where('formateur_id', $formateur->id)
            ->inRandomOrder()
            ->first();

        return [
            'formation_id' => $formation?->id ?? Formation::factory(),
            'user_id' => $apprenant?->id ?? User::factory(),
            'formateur_id' => $formateur?->id ?? User::factory(),
            'note' => $this->faker->numberBetween(1, 5),
            'commentaire' => $this->faker->optional()->paragraph(),
            'est_publiee' => $this->faker->boolean(80), // 80% publiées
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

