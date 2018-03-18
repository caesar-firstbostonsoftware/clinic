<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUserIdToLabtests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fecalyses', function($table) {
            $table->integer('user_id')->nullable();
        });
        Schema::table('chemistries', function($table) {
            $table->integer('user_id')->nullable();
        });
        Schema::table('ogtts', function($table) {
            $table->integer('user_id')->nullable();
        });
        Schema::table('hematologies', function($table) {
            $table->integer('user_id')->nullable();
        });
        Schema::table('aptts', function($table) {
            $table->integer('user_id')->nullable();
        });
        Schema::table('serologies', function($table) {
            $table->integer('user_id')->nullable();
        });
        Schema::table('second_chemistries', function($table) {
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fecalyses', function($table) {
            $table->dropColumn('user_id');
        });
        Schema::table('chemistries', function($table) {
            $table->dropColumn('user_id');
        });
        Schema::table('ogtts', function($table) {
            $table->dropColumn('user_id');
        });
        Schema::table('hematologies', function($table) {
            $table->dropColumn('user_id');
        });
        Schema::table('aptts', function($table) {
            $table->dropColumn('user_id');
        });
        Schema::table('serologies', function($table) {
            $table->dropColumn('user_id');
        });
        Schema::table('second_chemistries', function($table) {
            $table->dropColumn('user_id');
        });
    }
}
