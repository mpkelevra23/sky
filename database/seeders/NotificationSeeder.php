<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $notificationProbability = 50;

        $users->each(function ($user) use ($notificationProbability) {
            if (random_int(1, 100) <= $notificationProbability) {
                Notification::factory()
                    ->count(random_int(1, 3))
                    ->for($user)
                    ->create();
            }
        });
    }
}
