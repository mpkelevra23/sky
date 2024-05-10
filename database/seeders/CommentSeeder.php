<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();

        $randomProbability = 10;

        /*
         * Для каждого поста создаем комментарии от случайных пользователей
         */
        $posts->each(function ($post) use ($users, $randomProbability) {
            $users->each(function ($user) use ($post, $randomProbability) {
                if (random_int(1, 100) <= $randomProbability) {
                    Comment::factory()
                        ->count(random_int(1, 3))
                        ->for($user)
                        ->for($post)
                        ->create();
                }
            });
        });
    }
}
