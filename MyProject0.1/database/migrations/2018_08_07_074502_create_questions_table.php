<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            $table->string('type');
            $table->integer('quiz_id')->unsigned();
            $table->integer('question_nr')->nullable();
            $table->integer('duplicate')->unsigned();
            $table->timestamps();
        });
        Schema::table('questions', function (Blueprint $table)
        {
  $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('questions');
      Schema::table('questions', function (Blueprint $table) {
   $table->dropForeign(['quiz_id']);
});

    }
}
