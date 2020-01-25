<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolvedQuestionStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solved_question_stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->integer('question_no');
            $table->timestamp('start_time')->useCurrent();
            $table->timestamp('finish_time')->nullable();
            $table->time('time_taken')->nullable();
            $table->integer('attempts')->default(0);
            $table->unique(['username', 'question_no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solved_question_stats');
    }
}
