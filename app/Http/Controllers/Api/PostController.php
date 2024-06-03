<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Api\Post\IndexRequest;
use App\Http\Requests\Api\Post\StoreRequest;
use App\Http\Requests\Api\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

/**
 * Контроллер PostController содержит методы для работы с постами.
 * Валидацию данных необходимо проводить в контроллере. Мы даём гарантию сервису, что данные уже прошли валидацию.
 */
class PostController extends Controller
{
//    Пример внедрения сервиса в контроллер через конструктор класса
//
//    private PostService $postService;
//
//    public function __construct(PostService $postService)
//    {
//        $this->postService = $postService;
//    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request): array
    {
        // Получаем валидированные данные
        $data = $request->validated();

//        // Делаем запрос к базе данных с использованием query builder и метода when
//        $posts = Post::query()
//            ->when($data['title'], fn(Builder $query, string $title) => $query->where('title', 'ilike', "%$title%"))
//            ->when($data['content'], fn(Builder $query, string $content) => $query->where('content', 'ilike', "%$content%"))
//            ->when($data['is_published'], fn(Builder $query, bool $isPublished) => $query->where('is_published', $isPublished))
//            ->when($data['created_at_from'], fn(Builder $query, string $createdAtFrom) => $query->whereDate('created_at', '>=', $createdAtFrom))
//            ->when($data['created_at_to'], fn(Builder $query, string $createdAtTo) => $query->whereDate('created_at', '<=', $createdAtTo))
//            // Для того чтобы получить посты, у которых хотя бы одна категория соответствует переданным в массиве $categoryIds можно использовать whereHas и whereRelation
////            ->when($data['category_ids'], fn(Builder $query, array $categoryIds) => $query->whereRelation('categories', 'categories.id', $categoryIds))
//            // Для того чтобы получить посты, у которых все категории строго соответствуют переданным в массиве $categoryIds надо использовать "="
////            ->when($data['category_ids'], fn(Builder $query, array $categoryIds) => $query->whereHas('categories', fn(Builder $query) => $query->whereIn('categories.id', $categoryIds), "=", count($categoryIds)))
//            ->when($data['category_ids'], function ($query, $categoryIds) {
//                $query->whereHas('categories', function ($query) use ($categoryIds) {
//                    $query->whereIn('categories.id', $categoryIds);
//                }, '=', count($categoryIds));
//            })
//            ->get();

//        // Фильтрация постов с использованием PostFilter
//        $filter = new PostFilter();
//
//        // Применяем фильтр к запросу и получаем коллекцию постов
//        $posts = $filter->apply(Post::query(), $data)->get();

        // Фильтрация постов с использованием scope метода
//        $posts = Post::filter($data)->get();

        // Фильтрация постов с использованием сервиса
        $posts = PostService::index($data);

        return PostResource::collection($posts)->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): array
    {
        $post = PostService::store($request->validated());

        return PostResource::make($post)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): array
    {
        return PostResource::make($post)->resolve();
    }

//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(UpdateRequest $request, Post $post): array
//    {
//        $post->update($request->validated());
//
//        return PostResource::make($post->fresh())->resolve();
//    }

    /**
     * Update the specified resource in storage.
     * Пример использования сервиса для обновления поста
     * Если в контроллере используется сервис, то в контроллере не должно быть обращения к модели. Модель должна быть доступна только через сервис.
     *
     * @param UpdateRequest $request
     * @param Post $post
     * @return array
     */
    public function update(UpdateRequest $request, Post $post): array
    {
        $post = PostService::update($post, $request->validated());

        return PostResource::make($post)->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully',
        ]);
    }
}
