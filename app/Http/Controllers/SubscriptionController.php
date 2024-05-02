<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Http\Resources\Subscription\SubscriptionResource;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(): array
    {
        return SubscriptionResource::collection(Subscription::all())->resolve();
    }

    public function show(Subscription $subscription): array
    {
        return SubscriptionResource::make($subscription)->resolve();
    }

    public function store(): string
    {
        // Создание новой подписки c помощью фабрики
        Subscription::factory()->create();
        return 'Subscription stored';
    }

    public function update(Subscription $subscription): string
    {
        $subscription->update(
            [
                'user_id' => 1,
                'blog_id' => 1,
            ]
        );
        $subscription->save();
        return "Subscription $subscription->id updated";
    }

    public function destroy(Subscription $subscription): string
    {
        $subscription->delete();
        return "Subscription $subscription->id has been deleted";
    }
}
