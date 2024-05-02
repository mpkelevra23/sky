<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->unique()->numberBetween(1, 10),
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'status' => fake()->randomElement(['sent', 'pending', 'failed']),
            'created_at' => now(),
        ];
    }
}
