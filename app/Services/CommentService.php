<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentService
{
    /**
     * Comment index
     *
     * @return Collection
     */
    public static function index(): Collection
    {
        return Comment::all();
    }

    /**
     * Comment store
     *
     * @param array $data
     * @return Comment
     */
    public static function store(array $data): Comment
    {
        return Comment::create($data);
    }

    /**
     * Comment update
     *
     * @param Comment $comment
     * @param array $data
     * @return Comment
     */
    public static function update(Comment $comment, array $data): Comment
    {
        $comment->update($data);
        $comment->save();
        $comment->fresh();

        return $comment;
    }

}
