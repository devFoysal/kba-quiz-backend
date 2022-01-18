<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizSubmitAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_submit_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('participantId');
            $table->unsignedBigInteger('answerId');
            $table->bigInteger('time');
            $table->foreign('participantId')->references('id')->on('participants')->onDelete('cascade');
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
        Schema::dropIfExists('quiz_submit_answers');
    }
}