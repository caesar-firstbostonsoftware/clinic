<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToUrinalyses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('urinalyses', function($table) {
            $table->enum('pregnancy_test', array('No', 'Yes'))->default('No');
            $table->text('preg_remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('urinalyses', function($table) {
            $table->dropColumn('pregnancy_test');
            $table->dropColumn('preg_remark');
        });
    }
}
