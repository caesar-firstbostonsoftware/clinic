<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('visit_id');
            $table->enum('allergy', array('No', 'Yes'))->default('No');
            $table->text('allergy_desc')->nullable();
            $table->enum('alcohol', array('No', 'Yes'))->default('No');
            $table->string('alcohol_desc')->nullable();
            $table->enum('smoke', array('No', 'Yes'))->default('No');
            $table->string('smoke_desc')->nullable();
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
        Schema::dropIfExists('social_histories');
    }
}
