<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturesAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('lectures_attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('check')->default(0)->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id', 'student_fk_1450033')->references('id')->on('users');
            $table->unsignedInteger('date_of_lecture_id')->nullable();
            $table->foreign('date_of_lecture_id', 'date_of_lecture_fk_1450034')->references('id')->on('lectures');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lectures_attendances');
    }
}