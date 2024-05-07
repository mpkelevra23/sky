<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Blog\StoreRequest;
use App\Http\Requests\Api\Blog\UpdateRequest;
use App\Http\Resources\Blog\BlogResource;
use App\Models\Blog;
use App\Services\BlogService;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): array
    {
        return BlogResource::collection(BlogService::index())->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): array
    {
        $blog = BlogService::store($request->validated());

        return BlogResource::make($blog)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog): array
    {
        return BlogResource::make($blog)->resolve();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Blog $blog): array
    {
        $blog = BlogService::update($blog, $request->validated());

        return BlogResource::make($blog->fresh())->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog): JsonResponse
    {
        $blog->delete();

        return response()->json([
            'message' => 'Blog deleted successfully',
        ]);
    }
}
