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
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // трейт WithoutModelEvents используется для отключения событий модели
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
         * Вызываем метод call() и передаем ему массив с классами сидеров, которые хотим выполнить.
         * Основной вариант
         */
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,
            BlogSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            SubscriptionSeeder::class,
            NotificationSeeder::class,
        ]);


//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

//        User::factory()
//            ->count(10)
//            ->has(Profile::factory())
//            /*
//             * Необходимо указать имя связи, чтобы фабрика знала, как связать пользователя с блогом (один ко многим),
//             * из-за того, что в модели User есть 2 типа связи с блогом (один ко многим и многие ко многим)
//             */
//            ->has(Blog::factory(), 'blog')
////            ->has(Blog::factory(), 'blogs')
//            ->create();
//
//        $blogs = Blog::all();
//
//        foreach ($blogs as $blog) {
//            Post::factory()
//                ->count(rand(1, 3))
//                ->for($blog)
//                ->has(Category::factory()->count(rand(1, 3)))
//                ->create();
//        }

//        User::factory(10)->create();
//
//        Blog::factory()
//            ->count(10)
//            ->for(User::all()->random())
//            ->create();

//        Profile::factory(10)->create();
//        Blog::factory(10)->create();
//        Category::factory(10)->create();
//        Tag::factory(10)->create();
//        Notification::factory(10)->create();
//        Post::factory(10)->create();
//        Subscription::factory(10)->create();
//        Comment::factory(10)->create();

//        User::factory(10)->create();
//        Profile::factory(10)->create();
//        Blog::factory(10)->create();
//        $categories = Category::factory(10)->create();
//        Tag::factory(10)->create();
//        Notification::factory(10)->create();
//
//        // Создаем посты и связываем их с категориями
//        $posts = Post::factory(10)->create()->each(function ($post) use ($categories) {
//            // Аттачим случайные категории к каждому посту
//            $post->categories()->attach(
//                $categories->random(rand(1, 3))->pluck('id')->toArray()
//            );
//        });
//
//        Subscription::factory(10)->create();
//        Comment::factory(10)->create();

    }
}
