<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('data_position')->nullable();
            $table->string('length_gps')->nullable();
            $table->string('satelite_gps')->nullable();
            $table->double('speed')->nullable();
            $table->string('latitude_hemisphere')->nullable();
            $table->string('longitude_hemisphere')->nullable();
            $table->string('course')->nullable();
            $table->string('status')->nullable();
            $table->string('course_status')->nullable();
            $table->string('gps_real_time')->nullable();
            $table->double('latitude_decimal')->nullable();
            $table->double('longitude_decimal')->nullable();
            $table->string('imei');
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
        Schema::dropIfExists('location_information');
    }
}
