<?php

namespace App\Models;

use App\Http\Filters\PostFilter;
use App\Models\Traits\HasFilter;
use App\Models\Traits\Loggable;
use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Класс Post содержит методы для работы с постами.
 */
#[ObservedBy([PostObserver::class])]
class Post extends Model
{
    use HasFactory, SoftDeletes, Loggable, HasFilter;

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function profile(): BelongsTo
    {
        return $this->blog->profile();
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function likedProfiles(): MorphToMany
    {
        return $this->morphToMany(Profile::class, 'likeable');
    }

    public function favoriteProfiles(): MorphToMany
    {
        return $this->morphToMany(Profile::class, 'favoritable');
    }

    public function logs(): MorphMany
    {
        return $this->morphMany(Log::class, 'loggable');
    }

//    /**
//     * Filter posts
//     * В Laravel методы, которые начинаются с scope, являются глобальными методами запроса, которые можно вызывать командой Post::filter().
//     * Для повышения абстракции и читаемости кода, метод scopeFilter следует вынести в трейт HasFilter и использовать его в моделях.
//     *
//     * @param Builder $builder
//     * @param array $data
//     * @return Builder
//     */
//    public function scopeFilter(Builder $builder, array $data): Builder
//    {
//        return (new PostFilter())->apply($builder, $data);
//    }
}
