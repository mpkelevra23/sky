<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Subscription\StoreRequest;
use App\Http\Requests\Api\Subscription\UpdateRequest;
use App\Http\Resources\Subscription\SubscriptionResource;
use App\Models\Subscription;
use App\Services\SubscriptionService;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): array
    {
        return SubscriptionResource::collection(SubscriptionService::index())->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): array
    {
        $subscription = SubscriptionService::store($request->validated());

        return SubscriptionResource::make($subscription)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription): array
    {
        return SubscriptionResource::make($subscription)->resolve();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Subscription $subscription): array
    {
        $subscription = SubscriptionService::update($subscription, $request->validated());

        return SubscriptionResource::make($subscription->fresh())->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription): JsonResponse
    {
        $subscription->delete();

        return response()->json([
            'message' => 'Subscription deleted successfully',
        ]);
    }
}
