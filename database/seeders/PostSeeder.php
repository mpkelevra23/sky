<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = Blog::all();
        $categories = Category::all();
        $tags = Tag::all();

        /*
         * Способ, где мы создаем посты и сразу привязываем к ним категории и теги с помощью hasAttached
         */
//        $blogs->each(function ($blog) use ($categories, $tags) {
//            Post::factory()
//                ->count(random_int(1, 3))
//                ->for($blog)
//                ->hasAttached($categories->random(rand(1, $categories->count())))
//                ->hasAttached($tags->random(rand(1, $tags->count())))
//                ->create();
//        });

        /*
         * Способ, где мы создаем посты и привязываем к ним категории и теги с помощью attach у созданных постов
         */
        $tagProbability = 10;
        $categoryProbability = 25;

        $blogs->each(function ($blog) use ($categories, $tags, $tagProbability, $categoryProbability) {
            Post::factory()
                ->count(random_int(1, 5)) // Создаем от 1 до 5 постов для каждого блога
                ->for($blog) // Привязываем посты к текущему блогу
                ->create()
                ->each(function ($post) use ($categories, $tags, $tagProbability, $categoryProbability) {
                    // Для каждого поста привязываем категории и теги
                    $categories->each(function ($category) use ($post, $categoryProbability) {
                        if (random_int(1, 100) <= $categoryProbability) {
                            $post->categories()->attach($category);
                        }
                    });

                    $tags->each(function ($tag) use ($post, $tagProbability) {
                        if (random_int(1, 100) <= $tagProbability) {
                            $post->tags()->attach($tag);
                        }
                    });
                });
        });

    }
}
