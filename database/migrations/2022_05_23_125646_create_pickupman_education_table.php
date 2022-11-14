<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePickupmanEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickupman_education', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pickupman_id')->nullable();
            $table->string('exam_name', 255)->nullable();
            $table->string('group', 255)->nullable();
            $table->string('gpa', 255)->nullable();
            $table->string('year', 255)->nullable();
            $table->string('board', 255)->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('pickupman_education');
    }
}
