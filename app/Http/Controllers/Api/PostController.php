<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\StoreRequest;
use App\Http\Requests\Api\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;

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
    public function index(): array
    {
        return PostResource::collection(PostService::index())->resolve();
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
