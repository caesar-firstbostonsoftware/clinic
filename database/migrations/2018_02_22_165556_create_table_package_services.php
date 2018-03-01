<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePackageServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package_id');
            $table->integer('main_id');
            $table->integer('service_id');
            $table->decimal('price')->nullable();
            $table->date('date_reg');
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
        Schema::dropIfExists('package_services');
    }
}
