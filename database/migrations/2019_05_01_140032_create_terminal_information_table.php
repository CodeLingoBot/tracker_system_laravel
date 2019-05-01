<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminal_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('gas_oil')->nullable();
            $table->boolean('gps_track')->nullable();
            $table->boolean('active')->nullable();
            $table->boolean('charge')->nullable();
            $table->boolean('acc')->nullable();
            $table->boolean('defense')->nullable();
            $table->string('voltage')->nullable();
            $table->string('gsm_signal')->nullable();
            $table->string('alarm_terminal')->nullable();
            $table->string('alarm_language')->nullable();
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
        Schema::dropIfExists('terminal_information');
    }
}
