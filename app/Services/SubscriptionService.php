<?php

namespace App\Services;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Collection;

class SubscriptionService
{
    /**
     * Subscription index
     *
     * @return Collection
     */
    public static function index(): Collection
    {
        return Subscription::all();
    }

    /**
     * Subscription store
     *
     * @param array $data
     * @return Subscription
     */
    public static function store(array $data): Subscription
    {
        return Subscription::create($data);
    }

    /**
     * Subscription update
     *
     * @param Subscription $subscription
     * @param array $data
     * @return Subscription
     */
    public static function update(Subscription $subscription, array $data): Subscription
    {
        $subscription->update($data);
        $subscription->save();
        $subscription->fresh();

        return $subscription;
    }
}
