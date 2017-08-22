<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastMedicalHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('past_medical_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('visit_id');
            $table->enum('surgery', array('No', 'Yes'))->default('No');
            $table->enum('hypertension', array('No', 'Yes'))->default('No');
            $table->enum('diabetes_mellitus', array('No', 'Yes'))->default('No');
            $table->enum('previous_hospitalization', array('No', 'Yes'))->default('No');
            $table->enum('diseases_diagnosed', array('No', 'Yes'))->default('No');
            $table->enum('vaccination', array('No', 'Yes'))->default('No');
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
        Schema::dropIfExists('past_medical_histories');
    }
}
