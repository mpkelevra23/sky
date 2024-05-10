<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = Profile::all();
        $posts = Post::all();

        $randomProbability = 10;

        /*
         * Для каждого поста создаем комментарии от случайных пользователей
         */
        $posts->each(function ($post) use ($profiles, $randomProbability) {
            $profiles->each(function ($profile) use ($post, $randomProbability) {
                if (random_int(1, 100) <= $randomProbability) {
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
