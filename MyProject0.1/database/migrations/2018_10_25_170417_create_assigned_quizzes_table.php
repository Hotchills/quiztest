<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignedQuizzesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('assigned_quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quiz_id')->unsigned();
            $table->integer('guestuser_id')->unsigned();
            $table->string('code');
            $table->string('grade');
            $table->string('time');
            $table->date('start_at');
            $table->timestamps();
        });


        Schema::table('assigned_quizzes', function (Blueprint $table) {
            $table->foreign('guestuser_id')->references('id')->on('guest_users')->onDelete('cascade');
             $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('assigned_quizzes', function (Blueprint $table) {
            $table->dropForeign(['guestuser_id']);
            $table->dropForeign(['quiz_id']);
        });

        Schema::dropIfExists('assigned_quizzes');
    }

}
