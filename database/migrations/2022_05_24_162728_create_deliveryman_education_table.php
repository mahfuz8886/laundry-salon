<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliverymanEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveryman_education', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('deliveryman_id')->nullable();
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
        Schema::dropIfExists('deliveryman_education');
    }
}
