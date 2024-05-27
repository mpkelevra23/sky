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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('profile_id')->index()->constrained('profiles')->onDelete('cascade');
            // Лучше отказаться от каскадного удаления, и использовать observer для удаления подписки
            $table->foreignId('profile_id')->index()->constrained('profiles');
//            $table->foreignId('blog_id')->index()->constrained('blogs')->onDelete('cascade');
            // Лучше отказаться от каскадного удаления, и использовать observer для удаления подписки
            $table->foreignId('blog_id')->index()->constrained('blogs');
            $table->unique(['profile_id', 'blog_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
