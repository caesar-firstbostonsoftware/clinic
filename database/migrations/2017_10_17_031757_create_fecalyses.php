<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFecalyses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fecalyses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('visit_id');
            $table->integer('doc_id');

            $table->date('date_reg');
            $table->string('or_no')->nullable();
            $table->text('req_doc')->nullable();

            $table->enum('routine', array('No', 'Yes'))->default('No');
            $table->string('consistency')->nullable();
            $table->string('color')->nullable();
            $table->string('red_cell')->nullable();
            $table->string('ascari')->nullable();
            $table->string('pus_cell')->nullable();
            $table->string('trichuri')->nullable();

            $table->enum('amoeba', array('No', 'Yes'))->default('No');
            $table->string('amoeba_desc')->nullable();
            $table->string('hookworm')->nullable();

            $table->text('feca_other')->nullable();
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
        Schema::dropIfExists('fecalyses');
    }
}
