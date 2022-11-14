<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePickupmanAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickupman_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pickupman_id')->nullable();
            $table->bigInteger('thana_id')->nullable();
            $table->bigInteger('area_id')->nullable();
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
        Schema::dropIfExists('pickupman_areas');
    }
}
