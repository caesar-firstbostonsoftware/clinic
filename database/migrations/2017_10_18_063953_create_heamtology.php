<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeamtology extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hematologies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('visit_id');
            $table->integer('doc_id');

            $table->date('date_reg');
            $table->string('or_no')->nullable();

            $table->enum('cbc', array('No', 'Yes'))->default('No');
            $table->enum('hematocrit', array('No', 'Yes'))->default('No');
            $table->string('hematocrit_desc')->nullable();
            $table->enum('hemoglobin', array('No', 'Yes'))->default('No');
            $table->string('hemoglobin_desc')->nullable();
            $table->enum('wbc', array('No', 'Yes'))->default('No');
            $table->string('wbc_desc')->nullable();

            $table->string('dc_band')->nullable();
            $table->string('dc_pmn')->nullable();
            $table->string('dc_baso')->nullable();
            $table->string('dc_eos')->nullable();
            $table->string('dc_mono')->nullable();
            $table->string('dc_lymph')->nullable();

            $table->enum('protime', array('No', 'Yes'))->default('No');
            $table->string('control_desc')->nullable();
            $table->string('patient_desc')->nullable();
            $table->string('a_desc')->nullable();
            $table->string('inr_desc')->nullable();

            $table->enum('cellindice', array('No', 'Yes'))->default('No');
            $table->string('mcv_desc')->nullable();
            $table->string('mch_desc')->nullable();
            $table->string('mchc_desc')->nullable();

            $table->enum('clottinglw', array('No', 'Yes'))->default('No');
            $table->string('clottinglw_time')->nullable();
            $table->enum('clotting', array('No', 'Yes'))->default('No');
            $table->string('clotting_time')->nullable();
            $table->enum('bleedingdm', array('No', 'Yes'))->default('No');
            $table->string('bleedingdm_time')->nullable();
            $table->enum('clot', array('No', 'Yes'))->default('No');
            $table->string('clot_retraction')->nullable();
            $table->enum('platelet', array('No', 'Yes'))->default('No');
            $table->string('platelet_count')->nullable();
            $table->enum('esr', array('No', 'Yes'))->default('No');
            $table->string('esr_desc')->nullable();
            $table->enum('grp', array('No', 'Yes'))->default('No');
            $table->string('grp_desc')->nullable();
            $table->string('rh_desc')->nullable();
            $table->enum('smp', array('No', 'Yes'))->default('No');
            $table->string('smp_desc')->nullable();
            $table->enum('retic', array('No', 'Yes'))->default('No');
            $table->string('retic_desc')->nullable();
            $table->enum('rbc', array('No', 'Yes'))->default('No');
            $table->string('rbc_desc')->nullable();

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
        Schema::dropIfExists('hematologies');
    }
}
