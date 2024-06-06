<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Список ролей для таблицы roles
        $roles = [
            ['name' => 'user', 'description' => 'Пользователь'],
            ['name' => 'admin', 'description' => 'Администратор'],
            ['name' => 'moderator', 'description' => 'Модератор'],
            ['name' => 'editor', 'description' => 'Редактор'],
        ];

        // Создаем записи в таблице roles c помощью фабрики
        foreach ($roles as $role) {
            Role::factory()->create($role);
        }
    }
}
