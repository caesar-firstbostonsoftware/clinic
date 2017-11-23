<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnPatientVisits11232017 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_visits', function($table) {
            $table->dropColumn('status');
        });
        Schema::table('patient_visits', function($table) {
            $table->enum('status', array('Pending', 'Paid'))->default('Pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_visits', function($table) {
            $table->dropColumn('status');
        });
        Schema::table('patient_visits', function($table) {
            $table->enum('status', array('Pending', 'Done'))->default('Pending');
        });
    }
}
