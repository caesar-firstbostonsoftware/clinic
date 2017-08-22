<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToSurgeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surgeries', function($table) {
            $table->integer('counter');
        });
        Schema::table('hospitalizations', function($table) {
            $table->integer('counter');
        });
        Schema::table('diseases', function($table) {
            $table->integer('counter');
        });
        Schema::table('vaccinations', function($table) {
            $table->integer('counter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surgeries', function($table) {
            $table->dropColumn('counter');
        });
        Schema::table('hospitalizations', function($table) {
            $table->dropColumn('counter');
        });
        Schema::table('diseases', function($table) {
            $table->dropColumn('counter');
        });
        Schema::table('vaccinations', function($table) {
            $table->dropColumn('counter');
        });
    }
}
