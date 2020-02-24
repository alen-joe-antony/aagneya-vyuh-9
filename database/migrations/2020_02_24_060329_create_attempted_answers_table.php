<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttemptedAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempted_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->integer('level');
            $table->string('attempt');
            $table->string('mode');
            $table->string('proxymeter_state')->nullable();
            $table->timestamp('timestamp')->useCurrent();
            $table->foreign('username')->references('username')->on('users');
            $table->foreign('level')->references('question_no')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attempted_answers');
    }
}
