<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Message;
use App\Models\User;
use App\Models\Formation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Prendre des utilisateurs existants
        $sender = User::inRandomOrder()->first();
        $receiver = User::where('id', '!=', $sender->id)->inRandomOrder()->first();

        return [
            'sender_id' => $sender ? $sender->id : User::factory(),
            'receiver_id' => $receiver ? $receiver->id : User::factory(),
            'message' => $this->faker->sentence(10),
            'lu' => $this->faker->boolean(30), // 30% chance que le message soit lu
            'formation_id' => Formation::inRandomOrder()->first()?->id ?? Formation::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

