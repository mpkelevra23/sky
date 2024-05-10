<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $blogs = Blog::all();

        $subscriptionProbability = 10;

        $users->each(function ($user) use ($blogs, $subscriptionProbability) {
            $blogs->each(function ($blog) use ($user, $subscriptionProbability) {
                if (random_int(1, 100) <= $subscriptionProbability) {
                    Subscription::factory()
                        ->for($user)
                        ->for($blog)
                        ->create();
                }
            });
        });
    }
}
