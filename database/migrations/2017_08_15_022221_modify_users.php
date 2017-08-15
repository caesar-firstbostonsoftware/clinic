<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->integer('doc_id');
            $table->string('username');
        });
        Schema::table('users', function($table) {
            $table->dropColumn('name');
            $table->dropColumn('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('doc_id');
            $table->dropColumn('username');
        });
        Schema::table('users', function($table) {
            $table->string('name');
            $table->string('email');
        });
    }
}
