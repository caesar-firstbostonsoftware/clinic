<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTypeAndWhDiscountToPatientVisits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function($table) {
            $table->enum('type', array('Walk-in', 'Company'))->default('Walk-in');
        });
        Schema::table('patient_visits', function($table) {
            $table->decimal('wh_discount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function($table) {
            $table->dropColumn('type');
        });
        Schema::table('patient_visits', function($table) {
            $table->dropColumn('wh_discount');
        });
    }
}
