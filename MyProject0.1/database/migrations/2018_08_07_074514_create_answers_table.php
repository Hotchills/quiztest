<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            $table->text('aux');
            $table->integer('question_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('answers', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
        });

        Schema::dropIfExists('answers');
    }

}
