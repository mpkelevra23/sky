<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Достаем всех пользователей, у которых нет профиля
        $users = User::doesntHave('profile')->get();

        $users->each(function ($user) {
            Profile::factory()
                ->for($user)
                ->has(Image::factory())
                ->create();
        });
    }
}
