<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorrectAnswersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('correct_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('answer_id')->unsigned();
            $table->integer('question_id')->unsigned();
             $table->text('body');
            $table->timestamps();
        });

        Schema::table('correct_answers', function (Blueprint $table) {
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('correct_answers', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
            $table->dropForeign(['answer_id']);
        });
        Schema::dropIfExists('correct_answers');
    }

}
