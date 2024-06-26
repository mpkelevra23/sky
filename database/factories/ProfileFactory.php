<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
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
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'avatar' => fake()->imageUrl(),
            'bio' => fake()->sentence(),
            'created_at' => now(),
        ];
    }
}
