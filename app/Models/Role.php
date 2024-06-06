<?php

namespace App\Models;

use App\Models\Traits\Loggable;
use App\Observers\RoleObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([RoleObserver::class])]
class Role extends Model
{
    use HasFactory, SoftDeletes, Loggable;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
