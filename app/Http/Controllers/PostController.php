<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostDetailResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = PostResource::collection(Post::all())->resolve();
        return Inertia::render('Post/Index', compact('posts'));
    }

    public function show(Post $post): Response
    {
        $post = PostDetailResource::make($post)->resolve();
        return Inertia::render('Post/Show', compact('post'));
    }

    public function store(): string
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
