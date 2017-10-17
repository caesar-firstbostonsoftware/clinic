<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChemistry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chemistries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('visit_id');
            $table->integer('doc_id');

            $table->date('date_reg');
            $table->string('or_no')->nullable();

            $table->enum('blood_sugar', array('No', 'Yes'))->default('No');
            $table->enum('fasting', array('No', 'Yes'))->default('No');
            $table->string('fasting_result')->nullable();
            $table->enum('hours_ppbs', array('No', 'Yes'))->default('No');
            $table->string('ppbs_result')->nullable();
            $table->enum('random', array('No', 'Yes'))->default('No');
            $table->string('random_result')->nullable();
            $table->enum('hbaic', array('No', 'Yes'))->default('No');
            $table->string('hbaic_result')->nullable();

            $table->enum('kidney_function', array('No', 'Yes'))->default('No');
            $table->enum('creatinine', array('No', 'Yes'))->default('No');
            $table->string('creatinine_result')->nullable();
            $table->enum('bun', array('No', 'Yes'))->default('No');
            $table->string('bun_result')->nullable();
            $table->enum('uric_acid', array('No', 'Yes'))->default('No');
            $table->string('uric_acid_result')->nullable();

            $table->enum('liver_function', array('No', 'Yes'))->default('No');
            $table->enum('sgpt', array('No', 'Yes'))->default('No');
            $table->string('sgpt_result')->nullable();
            $table->enum('sgot', array('No', 'Yes'))->default('No');
            $table->string('sgot_result')->nullable();
            $table->enum('alk_phos', array('No', 'Yes'))->default('No');
            $table->string('alk_phos_result')->nullable();

            $table->enum('lipid_profile', array('No', 'Yes'))->default('No');
            $table->enum('hdl_cholesterol', array('No', 'Yes'))->default('No');
            $table->string('hdl_cholesterol_result')->nullable();
            $table->enum('triglycerides', array('No', 'Yes'))->default('No');
            $table->string('triglycerides_result')->nullable();
            $table->enum('total_cholesterol', array('No', 'Yes'))->default('No');
            $table->string('total_cholesterol_result')->nullable();
            $table->enum('ldl_cholesterol', array('No', 'Yes'))->default('No');
            $table->string('ldl_cholesterol_result')->nullable();
            $table->enum('tc_hdl_ratio', array('No', 'Yes'))->default('No');
            $table->string('tc_hdl_ratio_result')->nullable();

            $table->enum('electrolytes', array('No', 'Yes'))->default('No');
            $table->enum('sodium', array('No', 'Yes'))->default('No');
            $table->string('sodium_result')->nullable();
            $table->enum('potassium', array('No', 'Yes'))->default('No');
            $table->string('potassium_result')->nullable();
            $table->enum('calcium', array('No', 'Yes'))->default('No');
            $table->string('calcium_result')->nullable();

            $table->text('chem_other')->nullable();
            $table->text('remark')->nullable();

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
        Schema::dropIfExists('chemistries');
    }
}
