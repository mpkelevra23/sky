<?php

namespace App\Observers;

use App\Models\Blog;

class BlogObserver
{
    /**
     * Handle the Blog "created" event.
     */
    public function created(Blog $blog): void
    {
        //
    }

    /**
     * Handle the Blog "updated" event.
     */
    public function updated(Blog $blog): void
    {
        //
    }

    /**
     * Handle the Blog "deleting" event.
     */
    public function deleting(Blog $blog): void
    {
        // удаляем все посты блога отдельно с помощью callback
        $blog->posts()->each(static function ($post) {
            $post->delete();
        });
        $blog->subscribers()->detach();
        $blog->image()->each(static function ($image) {
            $image->delete();
        });
        $blog->favoriteProfiles()->detach();
    }

    /**
     * Handle the Blog "deleted" event.
     */
    public function deleted(Blog $blog): void
    {
        //
    }

    /**
     * Handle the Blog "restored" event.
     */
    public function restored(Blog $blog): void
    {
        //
    }

    /**
     * Handle the Blog "force deleted" event.
     */
    public function forceDeleted(Blog $blog): void
    {
        //
    }
}
