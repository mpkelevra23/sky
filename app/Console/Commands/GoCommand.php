<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Console\Command;

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
//        $comment = Comment::find(6);
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
    }
}
