<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToPatientVisits11222017 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_visits', function($table) {
            $table->string('senior_id_no')->nullable();
            $table->string('pwd_id_no')->nullable();
            $table->decimal('discount')->default(0.00);
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
            $table->dropColumn('senior_id_no');
            $table->dropColumn('pwd_id_no');
            $table->dropColumn('discount');
        });
    }
}
