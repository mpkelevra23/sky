<?php

namespace App\Models;

use App\Observers\CategoryObserver;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[ObservedBy([CategoryObserver::class])]
class Category extends Model
{
    use HasFactory, Loggable;

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    public function logs(): MorphMany
    {
        return $this->morphMany(Log::class, 'loggable');
    }
}
