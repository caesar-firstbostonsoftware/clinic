<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhysicalExams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physical_exams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('visit_id');
            $table->text('gen_survey')->nullable();
            $table->string('bp')->nullable();
            $table->string('hr')->nullable();
            $table->string('rr')->nullable();
            $table->string('temp')->nullable();
            $table->text('head')->nullable();
            $table->text('neck')->nullable();
            $table->text('chest_lung')->nullable();
            $table->text('heart')->nullable();
            $table->text('abdomen')->nullable();
            $table->text('back')->nullable();
            $table->text('extremity')->nullable();
            $table->text('neuro_exam')->nullable();
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
        Schema::dropIfExists('physical_exams');
    }
}
