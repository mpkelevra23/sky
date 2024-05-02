<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): array
    {
        return PostResource::collection(Post::all())->resolve();
    }

    public function show(Post $post): array
    {
        return PostResource::make($post)->resolve();
    }

    public function store()
    {
        // Создание нового поста c помощью фабрики
        Post::factory()->create();
        return 'Post stored';
    }

    public function update(Post $post): string
    {
        $post->update(
            [
                'title' => 'Updated title',
                'content' => 'Updated content',
            ]
        );
        $post->save();
        return "Post $post->id updated";
    }

    public function destroy(Post $post): string
    {
        $post->delete();
        return "Post $post->id has been deleted";
    }
}
