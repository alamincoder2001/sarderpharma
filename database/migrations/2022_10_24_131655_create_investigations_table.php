<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investigations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("appointment_id");
            $table->foreign("appointment_id")->references("id")->on("appointments")->onDelete("cascade");
            $table->unsignedBigInteger("test_id");
            $table->foreign("test_id")->references("id")->on("tests")->onDelete("cascade");

            $table->unsignedBigInteger("admin_id")->nullable();
            $table->foreign("admin_id")->references("id")->on("admins")->onDelete("cascade");
            
            $table->string("date");
            $table->float("unit_amount");
            $table->integer("discount");
            $table->float("total_amount");
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
        Schema::dropIfExists('investigations');
    }
}
