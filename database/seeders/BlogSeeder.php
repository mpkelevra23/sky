<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Image;
use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = Profile::all();

        $profiles->each(function ($profile) {
            Blog::factory()
                ->for($profile)
                ->has(Image::factory())
                ->create();
        });
    }
}
