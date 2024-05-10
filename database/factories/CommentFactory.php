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
            // Define the probability of having a parent comment
            $parentRandomProbability = 50;

            // Randomly decide if the comment should have a parent based on probability
            if (random_int(1, 100) > $parentRandomProbability) {
                return; // Skip setting a parent_id if the random check fails
            }

            // Select a random comment that could be the parent
            $randomParentComment = Comment::where('post_id', $comment->post_id)
                ->where('id', '<', $comment->id)
                ->inRandomOrder()
                ->first();

            // Set the parent_id if a suitable parent comment was found
            if ($randomParentComment) {
                $comment->parent_id = $randomParentComment->id;
                $comment->save();
            }
        });
    }
}
