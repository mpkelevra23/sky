<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TagController extends Controller
{
    public function index(): Response
    {
        $tags = TagResource::collection(Tag::all())->resolve();
        return Inertia::render('Tag/Index', compact('tags'));
    }

    public function show(Tag $tag): Response
    {
        $tag = TagResource::make($tag)->resolve();
        return Inertia::render('Tag/Show', compact('tag'));
    }

    public function store(): string
    {
        // Создание нового тега c помощью фабрики
        Tag::factory()->create();
        return 'Tag stored';
    }

    public function update(Tag $tag): string
    {
        $tag->update(
            [
                'name' => 'Updated name',
            ]
        );
        $tag->save();
        return "Tag $tag->id updated";
    }

    public function destroy(Tag $tag): string
    {
        $tag->delete();
        return "Tag $tag->id has been deleted";
    }
}
