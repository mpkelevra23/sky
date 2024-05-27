<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Profile;
use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получаем профили, у которых нет подписок
        $profiles = Profile::doesntHave('subscriptions')->get();

        // Получаем блоги, у которых нет подписчиков
        $blogs = Blog::doesntHave('subscribers')->get();

        $subscriptionProbability = 10;

        $profiles->each(function ($profile) use ($blogs, $subscriptionProbability) {
            $blogs->each(function ($blog) use ($profile, $subscriptionProbability) {
                if (random_int(1, 100) <= $subscriptionProbability) {
                    Subscription::factory()
                        ->for($profile)
                        ->for($blog)
                        ->create();
                }
            });
        });
    }
}
