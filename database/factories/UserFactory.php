<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static Collection $roles;

    public static function initialize(): void
    {
        // Инициализация свойства пустой коллекцией
        self::$roles = self::$roles ?? new Collection();

        // Кэшируем роли
        if (self::$roles->isEmpty()) {
            self::$roles = Role::all();
        }
    }

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Настройка фабрики для профиля.
     *
     * @return UserFactory
     */
    public function configure(): UserFactory
    {
        static::initialize();

        return $this->afterCreating(function (User $user) {
            $this->handleRoles($user);
        });
    }

    /**
     * Добавляет роль с id 1 и случайное количество других ролей к профилю.
     *
     * @param User $user
     * @return void
     * @throws RandomException
     */
    private function handleRoles(User $user): void
    {
        // Добавляем роль с id 1
        $user->roles()->attach(1);

        // Выбираем случайное количество других ролей
        self::$roles->where('id', '!=', 1)
            ->random(random_int(0, self::$roles->count() - 1))
            ->each(function (Role $role) use ($user) {
                $user->roles()->attach($role);
            });
    }
}
