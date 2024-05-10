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
            $table->string('image')->nullable();
            $table->boolean('is_published')->default(false);
            $table->foreignId('blog_id')->index()->constrained('blogs')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->index()->constrained('posts')->onDelete('cascade');
            $table->foreignId('tag_id')->index()->constrained('tags')->onDelete('cascade');
            $table->unique(['post_id', 'tag_id']);
            $table->timestamps();
        });

        Schema::create('category_post', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->index()->constrained('categories')->onDelete('cascade');
            $table->foreignId('post_id')->index()->constrained('posts')->onDelete('cascade');
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
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('posts');
    }
};
