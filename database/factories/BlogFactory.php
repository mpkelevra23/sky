<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Blog>
 */
class BlogFactory extends Factory
{
    private const ADD_FAVORITE_PROBABILITY = 75;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'created_at' => now(),
        ];
    }

    /**
     * Настройка фабрики для блога.
     *
     * @return BlogFactory
     */
    public function configure()
    {
        return $this->afterCreating(function (Blog $blog) {
            $this->handleFavorites($blog);
        });
    }

    /**
     * Добавляет блог в избранное у случайных профилей с вероятностью ADD_FAVORITE_PROBABILITY.
     *
     * @param Blog $blog
     * @return void
     * @throws RandomException
     */
    private function handleFavorites(Blog $blog): void
    {
        if (random_int(1, 100) <= self::ADD_FAVORITE_PROBABILITY) {
            $this->addFavorite($blog);
        }
    }

    /**
     * Добавляет блог в избранное у случайных профилей.
     *
     * @param Blog $blog
     * @return void
     * @throws RandomException
     */
    private function addFavorite(Blog $blog): void
    {
        // От 1 до 3 случайных профилей добавляют блог в избранное
        Profile::inRandomOrder()->limit(random_int(1, 3))->get()->each(function ($profile) use ($blog) {
            $profile->favoriteBlogs()->attach($blog, ['created_at' => now()]);
        });
    }
}
