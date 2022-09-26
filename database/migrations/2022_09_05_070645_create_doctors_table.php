<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            //personal details
            $table->string("name");
            $table->string("username")->unique();
            $table->string("email");
            $table->string('password');
            $table->text("education");
            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->string("image")->nullable();
            //chamber
            $table->string("chamber_name")->nullable();
            $table->string("address")->nullable();
            //address details
            $table->string("availability");
            $table->string("from");
            $table->string("to");
            $table->string("phone");
            $table->string("first_fee");
            $table->string("second_fee");
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('districts')->onDelete('cascade');
            $table->string('hospital_id')->nullable();
            $table->string('diagnostic_id')->nullable();
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
        Schema::dropIfExists('doctors');
    }
}
