<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_levels', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->integer('current_level')->default(1);
            $table->boolean('question_revealed')->default(false);
            $table->integer('total_score')->default(0);
            $table->foreign('username')->references('username')->on('users');
            $table->foreign('current_level')->references('question_no')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_levels');
    }
}
