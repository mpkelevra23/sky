<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Notification\StoreRequest;
use App\Http\Requests\Api\Notification\UpdateRequest;
use App\Http\Resources\Notification\NotificationResource;
use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): array
    {
        return NotificationResource::collection(NotificationService::index())->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): array
    {
        $notification = NotificationService::store($request->validated());

        return NotificationResource::make($notification)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification): array
    {
        return NotificationResource::make($notification)->resolve();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Notification $notification): array
    {
        $notification = NotificationService::update($notification, $request->validated());

        return NotificationResource::make($notification->fresh())->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification): JsonResponse
    {
        $notification->delete();

        return response()->json([
            'message' => 'Notification deleted successfully',
        ]);
    }
}
