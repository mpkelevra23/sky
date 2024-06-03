<?php

namespace App\Models;

use App\Models\Traits\Loggable;
use App\Observers\ImageObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([ImageObserver::class])]
class Image extends Model
{
    use HasFactory, SoftDeletes, Loggable;

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function logs(): MorphMany
    {
        return $this->morphMany(Log::class, 'loggable');
    }
}
