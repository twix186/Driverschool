<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCardsTable extends Migration
{
    public function up()
    {
        Schema::create('student_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id', 'student_fk_1450057')->references('id')->on('users');
            $table->unsignedInteger('instructor_id')->nullable();
            $table->foreign('instructor_id', 'instructor_fk_1450058')->references('id')->on('users');
            $table->unsignedInteger('group_id')->nullable();
            $table->foreign('group_id', 'group_fk_1450059')->references('id')->on('groups');
            $table->unsignedInteger('car_id')->nullable();
            $table->foreign('car_id', 'car_fk_1450060')->references('id')->on('cars');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_cards');
    }
}