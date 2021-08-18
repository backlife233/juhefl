<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->boolean('verified')->default(false);
            $table->integer('coin')->default(0);
            $table->string('login_ip')->nullable();
            $table->string('my_code', 20)->nullable();
            $table->json('my_text')->nullable();
            $table->datetime('vip_at')->nullable();
            $table->tinyInteger('user_status')->default(1);
            $table->unsignedBigInteger('inviter_id')->nullable();
            $table->dateTime('final_at')->nullable();
            $table->string('final_ip')->nullable();

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
        Schema::dropIfExists('users');
    }
}
