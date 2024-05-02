<?php

namespace App\Http\Controllers;

use App\Http\Resources\Blog\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(): array
    {
        return BlogResource::collection(Blog::all())->resolve();
    }

    public function show(Blog $blog): array
    {
        return BlogResource::make($blog)->resolve();
    }

    public function store(): string
    {
        // Создание нового блога c помощью фабрики
        Blog::factory()->create();
        return 'Blog stored';
    }

    public function update(Blog $blog): string
    {
        $blog->update(
            [
                'title' => 'Updated title',
                'description' => 'Updated description',
            ]
        );
        $blog->save();
        return "Blog $blog->id updated";
    }

    public function destroy(Blog $blog): string
    {
        $blog->delete();
        return "Blog $blog->id has been deleted";
    }
}
