<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_exams', function (Blueprint $table) {
            $table->id();
            $table->integer('examtype');
            $table->integer('question_type');
            $table->integer('class');
            $table->integer('subject');
            $table->string('session');
            $table->string('term');
            $table->string('year');
            $table->string('examname');
            $table->string('hour');
            $table->string('mins');
            $table->string('time');
            $table->string('instruction');
            $table->integer('active_status')->default(0);
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
        Schema::dropIfExists('create_exams');
    }
}
