<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => fake()->unique()->numberBetween(1, 10),
            'user_id' => fake()->unique()->numberBetween(1, 10),
            'content' => fake()->sentence(),
            'created_at' => now(),
        ];
    }
}
