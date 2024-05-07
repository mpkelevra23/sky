<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        // Надо разобраться с unique()->numberBetween(1, 10)

        User::factory(10)->create();
        Profile::factory(10)->create();
        Blog::factory(10)->create();
        Category::factory(10)->create();
        Tag::factory(10)->create();
        Notification::factory(10)->create();
        Post::factory(10)->create();
        Subscription::factory(10)->create();
        Comment::factory(10)->create();
    }
}
