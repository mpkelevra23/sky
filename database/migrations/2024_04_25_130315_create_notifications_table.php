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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            // Лучше отказаться от каскадного удаления, и использовать observer для удаления уведомления
            $table->foreignId('profile_id')->constrained('profiles');
            $table->string('title');
            $table->text('content');
            $table->string('status')->default('unread');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
