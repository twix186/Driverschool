<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticeReservationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('practice_reservation', function (Blueprint $table) {
            $table->unsignedInteger('practice_id');
            $table->foreign('practice_id', 'practice_id_fk_1469003')->references('id')->on('practices')->onDelete('cascade');
            $table->unsignedInteger('reservation_id');
            $table->foreign('reservation_id', 'reservation_id_fk_1469003')->references('id')->on('reservations')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('practice_reservation');
    }
}