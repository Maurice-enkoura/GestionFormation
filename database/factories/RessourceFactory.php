<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Formation;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ressource>
 */
class RessourceFactory extends Factory
{
    public function definition(): array
    {
        $type = $this->faker->randomElement(['pdf', 'video', 'document']);

        return [
            'titre' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'type' => $type,
            'fichier_path' => 'ressources/' . $this->faker->uuid . '.' . $type,
            'taille' => $this->faker->numberBetween(200, 5000) . ' Ko',

            'formation_id' => Formation::factory(),

            // On prend un utilisateur formateur existant
            'formateur_id' => User::where('role', 'formateur')
                ->inRandomOrder()
                ->first()?->id ?? User::factory(),
        ];
    }
}
