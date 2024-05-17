<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\File;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    private const CREATE_COMMENT_PROBABILITY = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = Profile::all();
        $posts = Post::all();

        /*
         * Для каждого поста, каждый профиль, может оставить от 1 до 3 комментариев с вероятностью CREATE_COMMENT_PROBABILITY
         */
        $posts->each(function ($post) use ($profiles) {
            $profiles->each(function ($profile) use ($post) {
                if (random_int(1, 100) <= self::CREATE_COMMENT_PROBABILITY) {
                    Comment::factory()
                        ->count(random_int(1, 3))
                        ->for($profile)
                        ->for($post)
                        ->create();
                }
            });
        });
    }
}
