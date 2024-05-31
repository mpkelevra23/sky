<?php

namespace App\Observers;

use App\Models\Profile;

class ProfileObserver
{
    /**
     * Handle the Profile "created" event.
     */
    public function created(Profile $profile): void
    {
        $profile->blog()->create();
    }

    /**
     * Handle the Profile "retrieved" event.
     */
    public function retrieved(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "updated" event.
     */
    public function updated(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "deleting" event.
     */
    public function deleting(Profile $profile): void
    {
        $profile->blog()->each(static function ($blog) {
            $blog->delete();
        });
        $profile->subscriptions()->detach();
        $profile->comments()->each(static function ($comment) {
            $comment->delete();
        });
        $profile->notifications()->each(static function ($notification) {
            $notification->delete();
        });
        $profile->image()->each(static function ($image) {
            $image->delete();
        });
        $profile->likedPosts()->detach();
        $profile->likedComments()->detach();
        $profile->favoritePosts()->detach();
        $profile->favoriteBlogs()->detach();
    }

    /**
     * Handle the Profile "deleted" event.
     */
    public function deleted(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "restored" event.
     */
    public function restored(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "force deleted" event.
     */
    public function forceDeleted(Profile $profile): void
    {
        //
    }
}
