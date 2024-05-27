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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('profile_id')->index()->constrained('profiles')->onDelete('cascade');
            // Лучше отказаться от каскадного удаления, и использовать observer для удаления комментария
            $table->foreignId('profile_id')->index()->constrained('profiles');
//            $table->foreignId('post_id')->index()->constrained('posts')->onDelete('cascade');
            // Лучше отказаться от каскадного удаления, и использовать observer для удаления комментария
            $table->foreignId('post_id')->index()->constrained('posts');
            $table->text('content');
//            $table->foreignId('parent_id')->nullable()->index()->constrained('comments')->onDelete('cascade');
            // Лучше отказаться от каскадного удаления, и использовать observer для удаления комментария
            $table->foreignId('parent_id')->nullable()->index()->constrained('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
