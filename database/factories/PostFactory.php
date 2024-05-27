<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use App\Models\File;
use App\Models\Image;
use App\Models\Profile;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    private const ADD_IMAGE_PROBABILITY = 75;
    private const ADD_FILE_PROBABILITY = 25;
    private const ADD_LIKE_PROBABILITY = 90;
    private const ADD_FAVORITE_PROBABILITY = 75;

    protected static Collection $categories;
    protected static Collection $tags;
    protected static Collection $profiles;

    public static function initialize(): void
    {
        // Инициализация свойств пустыми коллекциями
        self::$categories = self::$categories ?? new Collection();
        self::$tags = self::$tags ?? new Collection();
        self::$profiles = self::$profiles ?? new Collection();

        // Кэшируем категории
        if (self::$categories->isEmpty()) {
            self::$categories = Category::all();
        }

        // Кэшируем теги
        if (self::$tags->isEmpty()) {
            self::$tags = Tag::all();
        }

        // Кэшируем профили
        if (self::$profiles->isEmpty()) {
            self::$profiles = Profile::all();
        }
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'is_published' => fake()->boolean(),
            'created_at' => now(),
        ];
    }

    /**
     * Настройка фабрики для поста.
     *
     * @return PostFactory
     */
    public function configure(): PostFactory
    {
        self::initialize();

        return $this->afterCreating(function (Post $post) {
            $this->handleImages($post);
            $this->handleFiles($post);
            $this->handleCategories($post);
            $this->handleTags($post);
            $this->handleLikes($post);
            $this->handleFavorites($post);
        });
    }

    /**
     * Добавляем изображения к посту с вероятностью ADD_IMAGE_PROBABILITY
     *
     * @param Post $post
     * @return void
     * @throws RandomException
     */
    private function handleImages(Post $post): void
    {
        if (random_int(1, 100) <= self::ADD_IMAGE_PROBABILITY) {
            $this->addImages($post);
        }
    }

    /**
     * Добавляем файлы к посту с вероятностью ADD_FILE_PROBABILITY
     *
     * @param Post $post
     * @return void
     * @throws RandomException
     */
    private function handleFiles(Post $post): void
    {
        if (random_int(1, 100) <= self::ADD_FILE_PROBABILITY) {
            $this->addFiles($post);
        }
    }

    /**
     * Добавляем от 1 до 3 категорий к посту.
     *
     * @param Post $post
     * @return void
     * @throws RandomException
     */
    private function handleCategories(Post $post): void
    {
        self::$categories->random(random_int(1, 3))->each(function ($category) use ($post) {
            $this->addCategory($post, $category);
        });
    }

    /**
     * Добавляем от 1 до 5 тегов к посту.
     *
     * @param Post $post
     * @return void
     * @throws RandomException
     */
    private function handleTags(Post $post): void
    {
        self::$tags->random(random_int(1, 5))->each(function ($tag) use ($post) {
            $this->addTag($post, $tag);
        });
    }

    /**
     * Добавляем лайки к посту с вероятностью ADD_LIKE_PROBABILITY
     *
     * @param Post $post
     * @return void
     * @throws RandomException
     */
    private function handleLikes(Post $post): void
    {
        if (random_int(1, 100) <= self::ADD_LIKE_PROBABILITY) {
            $this->addLike($post);
        }
    }

    /**
     * Добавляем пост в избранное у случайных профилей с вероятностью ADD_FAVORITE_PROBABILITY.
     *
     * @param Post $post
     * @return void
     * @throws RandomException
     */
    protected function handleFavorites(Post $post): void
    {
        if (random_int(1, 100) <= self::ADD_FAVORITE_PROBABILITY) {
            $this->addFavorite($post);
        }
    }

    /**
     * Добавляем изображения к посту.
     *
     * @param Post $post
     * @return void
     * @throws RandomException
     */
    private function addImages(Post $post): void
    {
        $post->images()->saveMany(Image::factory()->count(random_int(1, 3))->make());
    }

    /**
     * Добавляем файлы к посту.
     *
     * @param Post $post
     * @return void
     * @throws RandomException
     */
    private function addFiles(Post $post): void
    {
        $post->files()->saveMany(File::factory()->count(random_int(1, 3))->make());
    }

    /**
     * Добавляем категорию к посту.
     *
     * @param Post $post
     * @param Category $category
     * @return void
     */
    private function addCategory(Post $post, Category $category): void
    {
        $post->categories()->attach($category, ['created_at' => now()]);
    }

    /**
     * Добавляем тег к посту.
     *
     * @param Post $post
     * @param Tag $tag
     * @return void
     */
    private function addTag(Post $post, Tag $tag): void
    {
        $post->tags()->attach($tag, ['created_at' => now()]);
    }

    /**
     * Добавляем лайки к посту от случайных профилей.
     *
     * @param Post $post
     * @return void
     * @throws RandomException
     */
    private function addLike(Post $post): void
    {
        // От 1 до 3 случайных профилей лайкают пост
        self::$profiles->random(random_int(1, 3))->each(function ($profile) use ($post) {
            $profile->likedPosts()->attach($post, ['created_at' => now()]);
        });
    }

    /**
     * Добавляем пост в избранное у случайных профилей.
     *
     * @param Post $post
     * @return void
     * @throws RandomException
     */
    private function addFavorite(Post $post): void
    {
        // От 1 до 3 случайных профилей добавляют пост в избранное
        self::$profiles->random(random_int(1, 3))->each(function ($profile) use ($post) {
            $profile->favoritePosts()->attach($post, ['created_at' => now()]);
        });
    }
}
