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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->boolean('is_published')->default(false);
            // TODO проверить, что softDeletes() отработает и на блог и на пост
//            $table->foreignId('blog_id')->index()->constrained('blogs')->onDelete('cascade');
            // Лучше отказаться от каскадного удаления, и использовать observer для удаления поста
            $table->foreignId('blog_id')->index()->constrained('blogs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_post');
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('posts');
    }
};
