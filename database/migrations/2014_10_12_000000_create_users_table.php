<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->string('avatar')->default('images/avatar-default.jpg');
            $table->date('date_birth')->default(date('Y/m/d',strtotime('2000/1/1')));
            $table->string('gender')->default('mate');
            $table->boolean('is_block')->default(false);
            $table->string('country')->default('no country');
            $table->integer('num_posts')->default(0);
            $table->integer('num_followers')->default(0);
            $table->integer('num_followers_me')->default(0);
            $table->rememberToken();
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
};
