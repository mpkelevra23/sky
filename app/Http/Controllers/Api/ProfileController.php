<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\StoreRequest;
use App\Http\Requests\Api\Profile\UpdateRequest;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Profile;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): array
    {
        return ProfileResource::collection(ProfileService::index())->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): array
    {
        $profile = ProfileService::store($request->validated());

        return ProfileResource::make($profile)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile): array
    {
        return ProfileResource::make($profile)->resolve();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Profile $profile): array
    {
        $profile = ProfileService::update($profile, $request->validated());

        return ProfileResource::make($profile->fresh())->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile): JsonResponse
    {
        $profile->delete();

        return response()->json([
            'message' => 'Profile deleted successfully',
        ]);
    }
}
