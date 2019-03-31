<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraFieldsVehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('board')->nullable();
            $table->string('sim_card')->nullable();
            $table->bigInteger('tracker_type_id')->unsigned()->nullable()->index();
            $table->foreign('tracker_type_id')->references('id')->on('tracker_types')->onDelete('cascade');
            $table->integer('final_user_id')->unsigned()->nullable()->index();
            $table->foreign('final_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('model_id')->unsigned()->nullable()->index();
            $table->foreign('model_id')->references('id')->on('vehicle_models')->onDelete('cascade');
            $table->float('odometer')->nullable();
            $table->integer('year')->nullable();
            $table->string('color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            //
        });
    }
}
