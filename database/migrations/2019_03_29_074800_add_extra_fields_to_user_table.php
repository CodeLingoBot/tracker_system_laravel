<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraFieldsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_company')->default(false);
            $table->string('cpf_cpnj')->nullable();
            $table->float('accession')->default(0.0);
            $table->integer('payment_day')->default(1);
            $table->integer('payment_monthy')->default(0);
            $table->string('zip_code')->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable()->index();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->string('neighborhood')->nullable();
            $table->string('address')->nullable();
            $table->string('validation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
