<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionss', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('options');
            $table->integer('correct_option');
            $table->integer('quiz');
            $table->integer('points');

            $table->foreign('quiz')->references('id')->on('quizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionss');
    }
}
