<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Resources\Comment\CommentResource;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(): array
    {
        return CommentResource::collection(Comment::all())->resolve();
    }

    public function show(Comment $comment): array
    {
        return CommentResource::make($comment)->resolve();
    }

    public function store(): string
    {
        // Создание нового комментария c помощью фабрики
        Comment::factory()->create();
        return 'Comment stored';
    }

    public function update(Comment $comment): string
    {
        $comment->update(
            [
                'content' => 'Updated content',
            ]
        );
        $comment->save();
        return "Comment $comment->id updated";
    }

    public function destroy(Comment $comment): string
    {
        $comment->delete();
        return "Comment $comment->id has been deleted";
    }
}
