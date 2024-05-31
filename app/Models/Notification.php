<?php

namespace App\Models;

use App\Observers\NotificationObserver;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([NotificationObserver::class])]
class Notification extends Model
{
    use HasFactory, SoftDeletes, Loggable;

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function logs(): MorphMany
    {
        return $this->morphMany(Log::class, 'loggable');
    }
}
