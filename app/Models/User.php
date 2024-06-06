<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Traits\Loggable;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes, Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function blog(): HasManyThrough
    {
        // Способ с использованием метода hasOneThrough
//        return $this->hasManyThrough(Blog::class, Profile::class);
        // Способ с использованием метода through и has
        return $this->through('profile')->has('blog');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function logs(): MorphToMany
    {
        return $this->morphToMany(Log::class, 'loggable');
    }

    /**
     * Determine if the user has the admin role.
     * Определить, есть ли у пользователя роль администратора.
     * В laravel для того, чтобы получить значение атрибута, необходимо использовать метод get{Attribute}Attribute.
     * В данном случае, для получения значения атрибута is_admin, необходимо использовать метод getIsAdminAttribute.
     *
     * @return bool
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->roles->contains('name', 'admin');
    }

    /**
     * Determine if the user has the given role.
     * Определить, есть ли у пользователя указанная роль.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->roles->contains('name', $role);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * Возвращает идентификатор, который будет храниться в утверждении субъекта JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     * Возвращает массив ключевых значений, содержащий любые пользовательские утверждения, которые должны быть добавлены к JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
