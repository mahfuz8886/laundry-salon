<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliverymanExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveryman_experiences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('deliveryman_id')->nullable();
            $table->string('company_name', 255)->nullable();
            $table->string('designation', 255)->nullable();
            $table->date('start_date', 255)->nullable();
            $table->date('end_date', 255)->nullable();
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
        Schema::dropIfExists('deliveryman_experiences');
    }
}
