<?php

namespace Database\Factories;

use App\Models\Comment;
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
            'content' => fake()->sentence(),
            'created_at' => now(),
        ];
    }

    /**
     * Indicate that the comment is a reply to another comment.
     */
    public function configure(): CommentFactory
    {
        return $this->afterCreating(function (Comment $comment) {

            $parentRandomProbability = 75;

            $randomComment = Comment::inRandomOrder()->first();

            if ($randomComment->id !== $comment->id) {
                $comment->parent_id = random_int(1, 100) <= $parentRandomProbability ? $randomComment->id : null;
            } else {
                $comment->parent_id = null;
            }
            $comment->save();
        });
    }
}
