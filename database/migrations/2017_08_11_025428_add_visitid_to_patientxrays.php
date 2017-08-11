<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisitidToPatientxrays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patientxrays', function($table) {
            $table->integer('visitid');
            $table->enum('status', array('New', 'Old'))->default('New');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patientxrays', function($table) {
            $table->dropColumn('visitid');
            $table->dropColumn('status');
        });
    }
}
