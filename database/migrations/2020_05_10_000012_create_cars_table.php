<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('license_plate')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('gearbox_type')->nullable();
            $table->integer('year_of_issue')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_1449840')->references('id')->on('categories');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}