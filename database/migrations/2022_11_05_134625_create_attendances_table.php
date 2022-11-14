<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id')->nullable();
            $table->tinyInteger('origin')->nullable()->comment('1:laundry,2:salon,3:pos');
            $table->tinyInteger('present')->nullable()->comment('1=present, 0=absent');
            $table->date('date')->nullable();
            $table->time('in_time')->nullable();
            $table->time('out_time')->nullable();
            $table->tinyInteger('late')->nullable()->comment('1=true, 0=false');
            $table->string('note')->nullable();
            $table->integer('user_id')->nullable()->comment('who insert this record');
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
        Schema::dropIfExists('attendances');
    }
}
