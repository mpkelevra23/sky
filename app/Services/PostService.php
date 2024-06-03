<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

/**
 * Здесь описаны методы с бизнес-логикой для работы с постами. В том случае, если методы в контроллере становятся слишком сложными, их можно вынести в сервисы.
 * Название методов может совпадать с названиями методов в контроллере.
 * Методы могут быть статическими, чтобы не создавать объект сервиса. Или можно внедрить сервис в контроллер через конструктор класса.
 * Валидацию данных необходимо проводить в контроллере. Мы даём гарантию сервису, что данные уже прошли валидацию.
 */
class PostService
{
//    Пример внедрения модели в сервис через конструктор класса
//
//    private Post $post;
//
//    public function __construct(Post $post)
//    {
//        $this->post = $post;
//    }

    /**
     * Post index
     *
     * @param $data
     * @return Collection
     */
    public static function index($data): Collection
    {
        return Post::filter($data)->get();
    }

    /**
     * Post store
     *
     * @param array $data
     * @return Post
     */
    public static function store(array $data): Post
    {
        return Post::create($data);
    }

    /**
     * Post update
     *
     * @param Post $post
     * @param array $data
     * @return Post
     */
    public static function update(Post $post, array $data): Post
    {
        $post->update($data);
        $post->save();
        $post->fresh();

        return $post;
    }

}
