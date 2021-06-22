<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTakeExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('take_exams', function (Blueprint $table) {
            $table->id();
            $table->integer('userID');
            $table->integer('examID');
            $table->integer('class');
            $table->string('session');
            $table->string('term');
            $table->string('year');
            $table->integer('subject');
            $table->integer('questionID')->nullable();
            $table->integer('answerID')->nullable();
            $table->string('subjective_answer')->nullable();
            $table->string('essay_answer')->nullable();
            $table->integer('status')->default(0);
            $table->integer('isConfirmed')->default(0);
            $table->string('picture')->nullable();
            $table->string('status')->default(0);
            $table->string('isConfirmed')->default(0);
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
        Schema::dropIfExists('take_exams');
    }
}
