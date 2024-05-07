<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Comment\StoreRequest;
use App\Http\Requests\Api\Comment\UpdateRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): array
    {
        return CommentResource::collection(CommentService::index())->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): array
    {
        $comment = CommentService::store($request->validated());

        return CommentResource::make($comment)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment): array
    {
        return CommentResource::make($comment)->resolve();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Comment $comment): array
    {
        $comment = CommentService::update($comment, $request->validated());

        return CommentResource::make($comment->fresh())->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully',
        ]);
    }
}
