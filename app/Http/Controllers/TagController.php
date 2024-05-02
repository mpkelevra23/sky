<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(): array
    {
        return TagResource::collection(Tag::all())->resolve();
    }

    public function show(Tag $tag): array
    {
        return TagResource::make($tag)->resolve();
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
