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
        Schema::create('category_post', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('category_id')->index()->constrained('categories')->onDelete('cascade');
            // Лучше отказаться от каскадного удаления, и использовать observer для удаления связи
            $table->foreignId('category_id')->index()->constrained('categories');
//            $table->foreignId('post_id')->index()->constrained('posts')->onDelete('cascade');
            // Лучше отказаться от каскадного удаления, и использовать observer для удаления связи
            $table->foreignId('post_id')->index()->constrained('posts');
            $table->unique(['category_id', 'post_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_post');
    }
};
