<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminstratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminstrators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('school_adminstrations')->onDelete('cascade');
            $table->string('name');
            $table->string('photo');
            $table->string('email');
            $table->string('phone');
            $table->string('about');
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
        Schema::dropIfExists('adminstrators');
    }
}
