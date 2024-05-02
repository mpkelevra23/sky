<?php

namespace App\Http\Controllers;

use App\Http\Resources\Notification\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(): array
    {
        return NotificationResource::collection(Notification::all())->resolve();
    }

    public function show(Notification $notification): array
    {
        return NotificationResource::make($notification)->resolve();
    }

    public function store(): string
    {
        // Создание нового уведомления c помощью фабрики
        Notification::factory()->create();
        return 'Notification stored';
    }

    public function update(Notification $notification): string
    {
        $notification->update(
            [
                'title' => 'Updated title',
                'status' => 'Updated status',
            ]
        );
        $notification->save();
        return "Notification $notification->id updated";
    }

    public function destroy(Notification $notification): string
    {
        $notification->delete();
        return "Notification $notification->id has been deleted";
    }
}
