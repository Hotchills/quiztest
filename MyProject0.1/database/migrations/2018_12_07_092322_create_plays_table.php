<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('answer')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->text('body')->nullable();
            $table->string('info_string')->nullable();
            $table->integer('info_int')->nullable();
            $table->timestamps();
            
        });
        Schema::table('plays', function (Blueprint $table) {
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{

        Schema::table('plays', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
        });

        Schema::dropIfExists('plays');
    }
}
