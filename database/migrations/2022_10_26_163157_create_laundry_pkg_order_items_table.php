<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaundryPkgOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundry_pkg_order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id')->comment('orders table id');
            $table->integer('product_id')->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('package_id')->nullable();
            $table->double('amount', 20,2)->nullable()->default(0);
            $table->integer('max_qty')->nullable();
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
        Schema::dropIfExists('laundry_pkg_order_items');
    }
}
