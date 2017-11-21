<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOgtt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ogtts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('visit_id');
            $table->integer('doc_id');

            $table->date('date_reg');
            $table->string('or_no')->nullable();

            $table->enum('fifty_gram', array('No', 'Yes'))->default('No');
            $table->enum('first_hour', array('No', 'Yes'))->default('No');
            $table->string('first_hour_result')->nullable();

            $table->enum('seventy_five_gram', array('No', 'Yes'))->default('No');
            $table->enum('fasting', array('No', 'Yes'))->default('No');
            $table->string('fasting_result')->nullable();
            $table->enum('sv_first_hour', array('No', 'Yes'))->default('No');
            $table->string('sv_first_hour_result')->nullable();
            $table->enum('sv_second_hour', array('No', 'Yes'))->default('No');
            $table->string('sv_second_hour_result')->nullable();

            $table->enum('one_hundred_gram', array('No', 'Yes'))->default('No');
            $table->enum('oh_fasting', array('No', 'Yes'))->default('No');
            $table->string('oh_fasting_result')->nullable();
            $table->enum('oh_first_hour', array('No', 'Yes'))->default('No');
            $table->string('oh_first_hour_result')->nullable();
            $table->enum('oh_second_hour', array('No', 'Yes'))->default('No');
            $table->string('oh_second_hour_result')->nullable();
            $table->enum('oh_third_hour', array('No', 'Yes'))->default('No');
            $table->string('oh_third_hour_result')->nullable();

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
        Schema::dropIfExists('ogtts');
    }
}
