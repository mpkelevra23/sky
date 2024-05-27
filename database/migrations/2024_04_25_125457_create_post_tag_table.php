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
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('post_id')->index()->constrained('posts')->onDelete('cascade');
            // Лучше отказаться от каскадного удаления, и использовать observer для удаления связи
            $table->foreignId('post_id')->index()->constrained('posts');
//            $table->foreignId('tag_id')->index()->constrained('tags')->onDelete('cascade');
            // Лучше отказаться от каскадного удаления, и использовать observer для удаления связи
            $table->foreignId('tag_id')->index()->constrained('tags');
            $table->unique(['post_id', 'tag_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tag');
    }
};
