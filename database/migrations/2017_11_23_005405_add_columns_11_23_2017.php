<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumns11232017 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_visits', function($table) {
            $table->dropColumn('senior_id_no');
            $table->dropColumn('pwd_id_no');
        });
        Schema::table('patients', function($table) {
            $table->string('senior_id_no')->nullable();
            $table->string('pwd_id_no')->nullable();
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
            $table->string('senior_id_no')->nullable();
            $table->string('pwd_id_no')->nullable();
        });
        Schema::table('patients', function($table) {
            $table->dropColumn('senior_id_no');
            $table->dropColumn('pwd_id_no');
        });
    }
}
