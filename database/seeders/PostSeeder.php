<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\File;
use App\Models\Image;
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
        // Достаем все блоги, у которых нет постов
        $blogs = Blog::doesntHave('posts')->get();

        $blogs->each(function ($blog) {
            Post::factory()
                ->count(random_int(1, 3)) // Создаем от 1 до 3 постов для каждого блога
                ->for($blog) // Привязываем посты к текущему блогу
                ->create();
        });


//        $categories = Category::all();
//        $tags = Tag::all();

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
//        $tagProbability = 10;
//        $categoryProbability = 25;
//        $imageProbability = 75;
//        $fileProbability = 25;
//
//
//        $blogs->each(function ($blog) use (
//            $categories,
//            $tags,
//            $tagProbability,
//            $categoryProbability,
//            $imageProbability,
//            $fileProbability
//        ) {
//            Post::factory()
//                ->count(random_int(1, 5)) // Создаем от 1 до 5 постов для каждого блога
//                ->for($blog) // Привязываем посты к текущему блогу
////                ->has(Image::factory()->count(random_int(1, 3))) // Первый вариант создания от 1 до 3 изображений для каждого поста
////                ->has(File::factory()->count(random_int(1, 3))) // Первый вариант создания от 1 до 3 файлов для каждого поста
//                ->create()
//                ->each(function ($post) use (
//                    $categories,
//                    $tags,
//                    $tagProbability,
//                    $categoryProbability,
//                    $imageProbability,
//                    $fileProbability
//                ) {
//
//                    // Второй вариант создания от 1 до 3 изображений для поста с вероятностью $imageProbability
//                    if (random_int(1, 100) <= $imageProbability) {
//                        $post->images()->saveMany(Image::factory()->count(random_int(1, 3))->make());
//                    }
//
//                    // Второй вариант создания от 1 до 3 файлов для поста с вероятностью $fileProbability
//                    (random_int(1, 100) <= $fileProbability) ? $post->files()->saveMany(File::factory()->count(random_int(1, 2))->make()) : null;
//
//                    // Для каждого поста привязываем категории с вероятностью $categoryProbability
//                    $categories->each(function ($category) use ($post, $categoryProbability) {
//                        if (random_int(1, 100) <= $categoryProbability) {
//                            $post->categories()->attach($category);
//                        }
//                    });
//
//                    // Для каждого поста привязываем теги с вероятностью $tagProbability
//                    $tags->each(function ($tag) use ($post, $tagProbability) {
//                        if (random_int(1, 100) <= $tagProbability) {
//                            $post->tags()->attach($tag);
//                        }
//                    });
//                });
//        });

    }
}
