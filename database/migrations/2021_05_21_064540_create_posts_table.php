<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('cover')->nullable();
            $table->json('images')->nullable();
            $table->tinyInteger('post_status')->default(0);
            $table->tinyInteger('is_recommend')->default(0);
            $table->unsignedBigInteger('view_count')->default(0);
            $table->unsignedBigInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
