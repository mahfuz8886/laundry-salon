<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliverymenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliverymen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email',100)->nullable();
            $table->string('phone')->nullable();
            $table->string('alternative_phone')->nullable();
            $table->double('per_parcel_amount', 20,2)->nullable()->default(0);
            $table->string('nid_no')->nullable();
            $table->string('image')->nullable();
            $table->string('designation')->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('fathers_profession')->nullable();
            $table->string('fathers_nid_no')->nullable();
            $table->string('fathers_mobile_no')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('mothers_profession')->nullable();
            $table->string('mothers_nid_no')->nullable();
            $table->string('mothers_mobile_no')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('guaranteer_information')->nullable();
            $table->string('guaranteer_name')->nullable();
            $table->string('guaranteer_relation')->nullable();
            $table->string('guaranteer_nid_no')->nullable();
            $table->string('guaranteer_mobile_no')->nullable();
            $table->text('guaranteer_present_address')->nullable();
            $table->text('guaranteer_permanent_address')->nullable();
            $table->integer('division_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('thana_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->string('password')->nullable();
            $table->string('passwordReset')->nullable();
            $table->string('photo')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('location')->nullable();
            $table->string('api_token')->nullable();
            $table->tinyInteger('api_role')->default(2);
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
        Schema::dropIfExists('deliverymen');
    }
}
