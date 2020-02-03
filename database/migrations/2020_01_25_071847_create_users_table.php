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
            $table->string('name');
            $table->string('username')->primary();
            $table->string('email')->unique();
            $table->string('provider');
            $table->string('provider_id');
            $table->string('profile_pic_url');
            $table->boolean('home_participant')->default(0);
            $table->string('institution');
            $table->string('user_type')->default('player');
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
}
