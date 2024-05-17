<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Blog extends Model
{
    use HasFactory;

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class, 'subscriptions');
    }

    public function comments(): HasManyThrough
    {
        // Способ с использованием метода hasManyThrough
//        return $this->hasManyThrough(Comment::class, Post::class);
        // Способ с использованием метода hasManyThrough с firstKey, secondKey, localKey и secondLocalKey и условие where
//        return $this->hasManyThrough(
//            Comment::class,
//            Post::class,
//            'blog_id',
//            'post_id',
//            'id',
//            'id'
//        )->where('comments.content', 'like', '%ll%');
        // Способ с использованием метода through и has
        return $this->through('posts')->has('comments');
        // Способ с использованием метода through, has и условие where
//        return $this->through('posts')
//            ->has('comments')
//            ->where('comments.content', 'like', '%ll%');
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function favoriteProfiles(): MorphToMany
    {
        return $this->morphToMany(Profile::class, 'favoritable');
    }
}
