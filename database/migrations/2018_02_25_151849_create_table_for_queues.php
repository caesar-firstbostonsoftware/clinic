<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableForQueues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('for_queues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('admin_panel_id');
            $table->integer('admin_panel_sub_id');
            $table->integer('visit_id')->nullable();
            $table->string('department');
            $table->date('date_reg');
            $table->enum('status', array('Pending', 'Done', 'Canceled'))->default('Pending');
            $table->decimal('price_amount')->nullable();
            $table->integer('qty')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('for_queues');
    }
}
