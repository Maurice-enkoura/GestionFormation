<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Formation;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inscription>
 */
class InscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'formation_id' => Formation::factory(),
            'user_id' => User::where('role','apprenant')->inRandomOrder()->first()?->id ?? User::factory(),
            'date_inscription' => now(),
            'statut' => $this->faker->randomElement(['en_cours','valide']),
        ];
    }
}
