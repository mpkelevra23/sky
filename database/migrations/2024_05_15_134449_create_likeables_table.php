<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('likeables', function (Blueprint $table) {
            $table->id();
            // Создаём внешний ключ для таблицы profiles
            $table->foreignId('profile_id')->index()->constrained('profiles');
            // Создает 2 поля: likeable_id и likeable_type и индекс для них
            $table->morphs('likeable');
            $table->timestamps();

            // Создаём составной уникальный индекс, чтобы пользователь мог поставить лайк только один раз
            $table->unique(['profile_id', 'likeable_id', 'likeable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likeables');
    }
};
