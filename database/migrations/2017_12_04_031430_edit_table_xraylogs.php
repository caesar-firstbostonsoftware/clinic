<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTableXraylogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_xray_logs', function($table) {
            $table->dropColumn('action');
        });
        Schema::table('patient_xray_logs', function($table) {
            $table->string('action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_xray_logs', function($table) {
            $table->dropColumn('action');
        });
        Schema::table('patient_xray_logs', function($table) {
            $table->enum('action', array('Create', 'Edit'));
        });
    }
}
