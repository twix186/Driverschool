<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->date('date_of_start')->nullable();
            $table->date('date_of_end')->nullable();
            $table->unsignedInteger('learning_plan_id')->nullable();
            $table->foreign('learning_plan_id', 'learning_plan_fk_1449850')->references('id')->on('learning_plans');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
}