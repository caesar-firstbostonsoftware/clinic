<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDateRegToPatientServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_services', function($table) {
            $table->date('date_reg');
            $table->enum('status', array('Pending', 'Done', 'Canceled'))->default('Pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_services', function($table) {
            $table->dropColumn('date_reg');
            $table->dropColumn('status');
        });
    }
}
