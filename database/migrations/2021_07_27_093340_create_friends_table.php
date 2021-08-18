<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->id('friend_id');
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('name');
            $table->string('link');
            $table->string('domain')->nullable();
            $table->integer('sort')->default(0);
            $table->integer('status')->default(0);
            $table->integer('lock')->default(0);
            $table->string('category')->nullable();
            $table->string('ico')->nullable();
            $table->unsignedBigInteger('come')->default(0);
            $table->unsignedBigInteger('all_come')->default(0);
            $table->unsignedBigInteger('out')->default(0);
            $table->unsignedBigInteger('all_out')->default(0);
            $table->text('info')->nullable();
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
        Schema::dropIfExists('friends');
    }
}
