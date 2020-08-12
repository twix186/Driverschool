<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->boolean('theory')->default(0)->nullable();
            $table->boolean('training_ground')->default(0)->nullable();
            $table->boolean('town')->default(0)->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id', 'student_fk_1450169')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exams');
    }
}