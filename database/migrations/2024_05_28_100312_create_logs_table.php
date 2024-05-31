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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            // Полиморфные связи
            $table->morphs('loggable');
            // Тип события (создание, обновление, удаление)
            $table->string('event');
            // Старые значения. Формат JSON
            $table->json('old_values')->nullable();
            // Новые значения. Формат JSON
            $table->json('new_values')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
