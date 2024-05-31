<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "deleting" event.
     */
    public function deleting(Post $post): void
    {
        $post->comments()->each(static function ($comment) {
            $comment->delete();
        });
        $post->categories()->detach();
        $post->tags()->detach();
        $post->images()->each(static function ($image) {
            $image->delete();
        });
        $post->files()->each(static function ($file) {
            $file->delete();
        });
        $post->likedProfiles()->detach();
        $post->favoriteProfiles()->detach();
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
