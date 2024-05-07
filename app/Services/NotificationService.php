<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Collection;

class NotificationService
{
    /**
     * Notification index
     *
     * @return Collection
     */
    public static function index(): Collection
    {
        return Notification::all();
    }

    /**
     * Notification store
     *
     * @param array $data
     * @return Notification
     */
    public static function store(array $data): Notification
    {
        return Notification::create($data);
    }

    /**
     * Notification update
     *
     * @param Notification $notification
     * @param array $data
     * @return Notification
     */
    public static function update(Notification $notification, array $data): Notification
    {
        $notification->update($data);
        $notification->save();
        $notification->fresh();

        return $notification;
    }
}
