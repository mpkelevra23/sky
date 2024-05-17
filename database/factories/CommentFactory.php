<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\File;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    private const SET_PARENT_COMMENT_PROBABILITY = 50;
    private const ADD_FILE_PROBABILITY = 25;
    private const ADD_LIKE_PROBABILITY = 50;

    protected static Collection $profiles;

    /**
     * Инициализация фабрики комментариев.
     *
     * @return void
     */
    public static function initialize(): void
    {
        // Инициализация свойства пустой коллекцией
        self::$profiles = self::$profiles ?? new Collection();

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
            'content' => fake()->sentence(),
            'created_at' => now(),
        ];
    }

    /**
     * Настройка фабрики для комментариев.
     *
     * @return CommentFactory
     */
    public function configure(): CommentFactory
    {
        self::initialize();

        return $this->afterCreating(function (Comment $comment) {
            $this->handleParentComment($comment);
            $this->handleFile($comment);
            $this->handleLike($comment);
        });
    }

    /**
     * Устанавливаем родительский комментарий с вероятностью SET_PARENT_COMMENT_PROBABILITY
     *
     * @param Comment $comment
     * @return void
     * @throws RandomException
     */
    private function handleParentComment(Comment $comment): void
    {
        if (random_int(1, 100) <= self::SET_PARENT_COMMENT_PROBABILITY) {
            $this->setParentComment($comment);
        }
    }

    /**
     * Добавляем файл к комментарию с вероятностью ADD_FILE_PROBABILITY
     *
     * @param Comment $comment
     * @return void
     * @throws RandomException
     */
    private function handleFile(Comment $comment): void
    {
        if (random_int(1, 100) <= self::ADD_FILE_PROBABILITY) {
            $this->addFile($comment);
        }
    }

    /**
     * Добавляем лайк к комментарию с вероятностью ADD_LIKE_PROBABILITY
     *
     * @param Comment $comment
     * @return void
     * @throws RandomException
     */
    private function handleLike(Comment $comment): void
    {
        if (random_int(1, 100) <= self::ADD_LIKE_PROBABILITY) {
            $this->addLike($comment);
        }
    }

    /**
     * Устанавливаем родительский комментарий для текущего комментария
     *
     * @param Comment $comment
     * @return bool
     */
    private function setParentComment(Comment $comment): bool
    {
        /*
         * Находим случайный комментарий, который принадлежит тому же посту, что и текущий комментарий
         * и который был опубликован раньше текущего комментария
         */
        $randomParentComment = Comment::where('post_id', $comment->post_id)
            ->where('id', '<', $comment->id)
            ->inRandomOrder()
            ->first();

        // Для текущего комментария устанавливаем parent_id случайного комментария
        if ($randomParentComment) {
            $comment->parent_id = $randomParentComment->id;
            return $comment->save();
        }

        return false;
    }

    /**
     * Добавляем файл к комментарию
     *
     * @param Comment $comment
     * @return Model|false
     */
    public function addFile(Comment $comment): Model|false
    {
        // Создаем и привязываем файл к комментарию
        return $comment->file()->save(File::factory()->make());
    }

    /**
     * Добавляем лайк к комментарию
     *
     * @param Comment $comment
     * @return void
     * @throws RandomException
     */
    public function addLike(Comment $comment): void
    {
        // От 1 до 3 случайных профилей лайкают комментарий
        self::$profiles->random(random_int(1, 3))->each(function ($profile) use ($comment) {
            $profile->likedComments()->attach($comment, ['created_at' => now()]);
        });
    }
}
