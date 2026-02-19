<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Module;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contenu>
 */
class ContenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'module_id' => Module::factory(),
            'type' => $this->faker->randomElement(['video','document']),
            'url' => $this->faker->url(),
            'description' => $this->faker->sentence(),
        ];
    }
}
