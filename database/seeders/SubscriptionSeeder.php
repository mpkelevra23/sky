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
        $profiles = Profile::all();
        $blogs = Blog::all();

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
