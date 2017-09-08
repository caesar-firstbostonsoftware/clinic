<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('visit_id');
            $table->date('date_start');
            $table->text('drug');
            $table->text('frequency');
            $table->integer('quantity');
            $table->enum('status', array('Active', 'Not Active'))->default('Active');
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
        Schema::dropIfExists('medications');
    }
}
