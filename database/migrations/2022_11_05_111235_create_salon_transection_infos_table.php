<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalonTransectionInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salon_transection_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('issue_date')->nullable();
            $table->tinyInteger('payment_method')->nullable()->comment('1=cash, 2=bank, 3=mobile banking');
            $table->string('invoice_no', 20)->nullable();
            $table->double('total', 20,2)->nullable();
            $table->tinyInteger('type')->nullable()->comment('1=income, 2=expanse');
            $table->tinyInteger('status')->nullable()->comment('1=Active, 0=In Active');
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
        Schema::dropIfExists('salon_transection_infos');
    }
}
