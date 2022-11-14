<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreatepagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('createpages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_area');
            $table->string('pageName');
            $table->string('pageName_bn');
            $table->string('slug');
            $table->string('title');
            $table->string('title_bn');
            $table->text('text');
            $table->text('text_bn');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('createpages');
    }
}
