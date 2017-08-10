<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientxrays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patientxrays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->string('or_no');
            $table->integer('physician_id');
            $table->date('xray_date');
            $table->enum('finding', array('Normal', 'Not Normal'))->default('Normal');
            $table->text('finding_info');
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
        Schema::dropIfExists('patientxrays');
    }
}
