<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = Profile::all();

        $notificationProbability = 50;

        $profiles->each(function ($profile) use ($notificationProbability) {
            if (random_int(1, 100) <= $notificationProbability) {
                Notification::factory()
                    ->count(random_int(1, 3))
                    ->for($profile)
                    ->create();
            }
        });
    }
}
