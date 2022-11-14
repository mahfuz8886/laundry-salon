<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id');
            $table->string('year',20);
            $table->string('month',20);
            $table->double('salary', 20,2)->nullable();
            $table->double('bonus', 20,2)->nullable();
            $table->double('fine', 20,2)->nullable();
            $table->date('pay_date')->nullable();
            $table->string('payment_via',30)->nullable();
            $table->tinyInteger('origin')->nullable()->comment('1:laundry,2:salon,3:pos');
            $table->tinyInteger('status')->nullable('1=paid, 0=unpaid');
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
        Schema::dropIfExists('salaries');
    }
}
