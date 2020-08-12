<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturesTable extends Migration
{
    public function up()
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->integer('audience')->nullable();
            $table->unsignedInteger('group_id')->nullable();
            $table->foreign('group_id', 'group_fk_1449959')->references('id')->on('groups');
            $table->unsignedInteger('lecturer_id')->nullable();
            $table->foreign('lecturer_id', 'lecturer_fk_1449960')->references('id')->on('users');
            $table->unsignedInteger('subject_id')->nullable();
            $table->foreign('subject_id', 'subject_fk_1449961')->references('id')->on('subjects');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lectures');
    }
}