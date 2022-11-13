<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbulancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambulances', function (Blueprint $table) {
            $table->id();
            $table->string("name", 150);
            $table->string("username")->unique();
            $table->string("ambulance_type");
            $table->string("phone");
            $table->string("email");
            $table->string("password");
            $table->text("map_link")->nullable();
            $table->bigInteger('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('districts')->onDelete('cascade');
            $table->string("address");
            $table->string("car_license")->nullable();
            $table->string("driver_license")->nullable();
            $table->string("driver_nid")->nullable();
            $table->string("driver_address")->nullable();
            $table->string("image")->nullable();
            $table->longText("details")->nullable();
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
        Schema::dropIfExists('ambulances');
    }
}
