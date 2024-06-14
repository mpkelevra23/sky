<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use App\Models\Traits\Loggable;
use App\Observers\ProfileObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([ProfileObserver::class])]
class Profile extends Model
{
    use HasFactory, SoftDeletes, Loggable, HasFilter;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function blog(): HasOne
    {
        return $this->hasOne(Blog::class);
    }

    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class, 'subscriptions');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function posts(): HasManyThrough
    {
        return $this->hasManyThrough(Post::class, Blog::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function likedPosts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'likeable');
    }

    public function likedComments(): MorphToMany
    {
        return $this->morphedByMany(Comment::class, 'likeable');
    }

    public function favoritePosts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'favoritable');
    }

    public function favoriteBlogs(): MorphToMany
    {
        return $this->morphedByMany(Blog::class, 'favoritable');
    }

    public function logs(): MorphMany
    {
        return $this->morphMany(Log::class, 'loggable');
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
