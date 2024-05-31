<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\File;
use App\Models\Image;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
//      lesson 4
//        $post = Post::first();
//        $blog = Blog::find($post->blog_id);

//        $post = Post::with('blog')->first();
//        $blog = $post->blog;

//        $user = User::first();
//        $profile = Profile::where('user_id', $user->id)->first();

//        $post = Post::first();
//        $category = Category::first();

//      User
//        $user = User::first();
//        $blog = $user->blog;
//        $profile = $user->profile;
//        $subscription = $user->blogs;
//        $posts = $user->blog->posts;
//        $comments = $user->comments;
//        $notifications = $user->notifications;
//
//        dd(
////            $user,
////            $blog,
////            $profile,
////            $subscription,
////            $posts,
////            $comments,
////            $notifications
//        );

//      Profile
//        $profile = Profile::first();
//        $user = $profile->user;
//        $blog = $profile->user->blog;
//        $posts = $profile->user->blog->posts;
//
//        dd(
////            $profile,
////            $user,
////            $blog,
////            $posts
//        );

//      Blog
//        $blog = Blog::find(4);
//        $user = $blog->user;
//        $posts = $blog->posts;
//        $subscribers = $blog->users;
//
//        dd(
////            $blog,
////            $user,
////            $posts,
////            $subscribers
//        );

//      Post
//        $post = Post::first();
//        $blog = $post->blog;
//        $category = $post->categories;
//        $comments = $post->comments;
//        $tags = $post->tags;
//        $user = $post->blog->user;
//
//        dd(
////            $post,
////            $blog,
////            $category,
////            $comments,
////            $tags,
////            $user
//        );

//      Comment
//        $comment = Comment::first();
//        $post = $comment->post;
//        $user = $comment->user;
//        $children = $comment->children;
//        $comment = Comment::where('parent_id', !null)->first();
//        $parent = $comment->parent;
//
//        dd(
////            $comment,
////            $post,
////            $user,
////            $parent,
////            $children
//        );

//      Category
//        $category = Category::first();
//        $posts = $category->posts;
//
//        dd(
////            $category,
////            $posts
//        );

//      Tag
//        $tag = Tag::first();
//        $posts = $tag->posts;
//
//        dd(
////            $tag,
////            $posts
//        );

//      Notification
//        $notification = Notification::first();
//        $user = $notification->user;
//
//        dd(
////            $notification,
////            $user
//        );

//      lesson 5
//      Blog
//        $blog = Blog::first();
//        dd(
//            $blog->comments,
//            $blog->subscribers->count(),
//        );

//      User
//        $user = User::first();
//        dd(
//            $user->blog,
////            $user->blog->posts->last()
//        );

//      Post
//        $post = Post::find(25);
//        $post->images()->saveMany([
//            new Image([
//                'url' => 'https://example.com/image1.jpg'
//            ]),
//            new Image([
//                'url' => 'https://example.com/image2.jpg'
//            ]),
//            new Image([
//                'url' => 'https://example.com/image3.jpg'
//            ]),
//        ]);
//
//        $post->files()->saveMany([
//            new File([
//                'name' => 'file1',
//                'path' => '/path/to',
//                'extension' => 'jpg'
//            ]),
//            new File([
//                'name' => 'file2',
//                'path' => '/path/to',
//                'extension' => 'mp4'
//            ]),
//            new File([
//                'name' => 'file3',
//                'path' => '/path/to',
//                'extension' => 'csv'
//            ]),
//        ]);
//
//        $postFiles = $post->files->map(function ($file) {
//            return $file->path . '/' . $file->name . '.' . $file->extension;
//        })->toArray();
//
//        dd(
//            $post->blog->posts->last()->comments->last()->profile->user->email,
//            $post->profile,
//            $post->images,
//            $post->images->pluck('url')->toArray(),
//            $post->files,
//            $postFiles
//        );

//      Profile
//        $profile = Profile::first();
//        $profile->image()->save(
//            new Image([
//                'url' => 'https://example.com/image.jpg'
//            ])
//        );

//        dd(
//            $profile->image->url,
//            $profile->posts->count(),
//            $profile->likedComments()->pluck('content')
//        );

//      Comment
//        $comment = Comment::first();
//
//        $comment->file()->updateOrCreate(
//            [],
//            [
//                'name' => 'file',
//                'path' => '/path/to',
//                'extension' => 'jpg'
//            ]
//        );
//
//        $commentFiles = $comment->file->path . '/' . $comment->file->name . '.' . $comment->file->extension;
//
//        dd(
//            $comment->blog,
//            $comment->file,
//            $commentFiles,
//            $comment->likedProfiles()->pluck('first_name')
//        );

//      Image
//        $image = Image::first();
//        dd(
//            $image->imageable
//        );

//        lesson 8
//        /*
//         * Создать пользователя, чтобы проверить работу Observer метода created, после создания пользователя должен создаться профиль пользователя.
//         * Также проверяем работу логгера, после создания пользователя должна создаться запись в логах.
//         */
//        User::create([
//            'name' => 'John Doe',
//            'email' => 'test@test.com',
//            'password' => Hash::make('qwerty'),
//        ]);
//
//        // Обновляем профиль пользователя и проверяем работу логгера
//        $profile = Profile::first();
//        $profile->update([
//            'first_name' => 'John',
//            'last_name' => 'Doe',
//        ]);
//
//        // Достаём последнего пользователя и удаляем его, проверяем работу логгера
//        User::latest()->first()->delete();
//
//        // Создаём новый блог и проверяем работу логгера
//        Tag::create([
//            'name' => 'Laravel',
//        ]);
    }
}
