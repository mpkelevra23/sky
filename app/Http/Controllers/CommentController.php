<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Resources\Comment\CommentResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CommentController extends Controller
{
    public function index(): Response
    {
        $comments = CommentResource::collection(Comment::all())->resolve();
        return Inertia::render('Comment/Index', compact('comments'));
    }

    public function show(Comment $comment): Response
    {
        $comment = CommentResource::make($comment)->resolve();
        return Inertia::render('Comment/Show', compact('comment'));
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
