<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientXrayLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_xray_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('xray_id');
            $table->integer('user_id');
            $table->date('date');
            $table->enum('action', array('Create', 'Edit'))->nullable();
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
        Schema::dropIfExists('patient_xray_logs');
    }
}
