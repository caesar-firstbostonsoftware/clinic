<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSecondChemistries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_chemistries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('visit_id');
            $table->integer('doc_id');
            $table->string('or_no');
            $table->date('sec_chem_date');
            $table->text('tsh')->nullable();
            $table->text('t3')->nullable();
            $table->text('t4')->nullable();
            $table->text('psa')->nullable();
            $table->text('bilirubin_total')->nullable();
            $table->text('bilirubin_direct')->nullable();
            $table->text('bilirubin_indirect')->nullable();
            $table->text('protien_total')->nullable();
            $table->text('protien_albumin')->nullable();
            $table->text('protien_globulin')->nullable();
            $table->text('protien_ag_ratio')->nullable();
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
        Schema::dropIfExists('second_chemistries');
    }
}
