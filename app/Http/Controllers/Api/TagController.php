<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tag\StoreRequest;
use App\Http\Requests\Api\Tag\UpdateRequest;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): array
    {
        return TagResource::collection(TagService::index())->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): array
    {
        $tag = TagService::store($request->validated());

        return TagResource::make($tag)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag): array
    {
        return TagResource::make($tag)->resolve();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Tag $tag): array
    {
        $tag = TagService::update($tag, $request->validated());

        return TagResource::make($tag->fresh())->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag): JsonResponse
    {
        $tag->delete();

        return response()->json([
            'message' => 'Tag deleted successfully',
        ]);
    }
}
