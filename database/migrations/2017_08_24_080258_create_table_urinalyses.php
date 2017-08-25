<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUrinalyses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urinalyses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('visit_id');
            $table->integer('physician_id');
            $table->integer('user_id');
            $table->date('date');
            $table->string('or_no');

            $table->enum('physical', array('No', 'Yes'))->default('No');
            $table->string('color')->nullable();
            $table->string('transparency')->nullable();
            $table->string('specific_gravity')->nullable();

            $table->enum('microscopic', array('No', 'Yes'))->default('No');
            $table->string('wbc')->nullable();
            $table->string('rbc')->nullable();
            $table->string('epith_cell')->nullable();
            $table->string('bacteria')->nullable();
            $table->string('cast')->nullable();
            $table->string('cast2')->nullable();
            $table->string('crystal')->nullable();
            $table->string('crystal2')->nullable();
            $table->string('amorphous_material')->nullable();
            $table->string('mucus_thread')->nullable();
            $table->string('other')->nullable();
            $table->string('other2')->nullable();
            $table->string('other3')->nullable();

            $table->enum('chemical', array('No', 'Yes'))->default('No');
            $table->string('glucose')->nullable();
            $table->string('bilirubin')->nullable();
            $table->string('ketone')->nullable();
            $table->string('blood')->nullable();
            $table->string('ph')->nullable();
            $table->string('protein')->nullable();
            $table->string('urobilinogen')->nullable();
            $table->string('nitrites')->nullable();
            $table->string('leucocytes')->nullable();

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
        Schema::dropIfExists('urinalyses');
    }
}
