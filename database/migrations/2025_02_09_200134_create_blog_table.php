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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title', 100);
            $table->string('description', 255);
            $table->text('text');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id', 'FK_d_blog_user_id')->references('id')->on('users');
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title', 100);
            $table->string('description', 255);
            $table->text('text');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id', 'FK_d_news_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog');
        Schema::dropIfExists('news');
    }
};
