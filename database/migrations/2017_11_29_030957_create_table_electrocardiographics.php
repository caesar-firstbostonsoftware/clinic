<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableElectrocardiographics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electrocardiographics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('visit_id');
            $table->string('req_doc')->nullable();
            $table->string('or_no');
            $table->date('ecg_date');
            $table->text('diagnosis')->nullable();
            $table->text('auricular_rate')->nullable();
            $table->text('venticular_rate')->nullable();
            $table->text('rhythm')->nullable();
            $table->text('pr_interval')->nullable();
            $table->text('qrs_interval')->nullable();
            $table->text('electrical_axis')->nullable();
            $table->text('significant_finding')->nullable();
            $table->text('interpretation')->nullable();
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
        Schema::dropIfExists('electrocardiographics');
    }
}
