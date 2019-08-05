<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
          $table->increments('id');
          $table->bigInteger('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->string('NationalID');
          $table->string('photo')->nullable();
          $table->string('gender');
          $table->string('country');
          $table->string('gov');
          $table->string('university');
          $table->string('faculty');
          $table->string('graduation_year');
          $table->string('acc_grade');
          $table->string('school_name')->nullable();
          $table->string('field_of_teaching');
          $table->string('educational_zone')->nullable();
          $table->string('position')->nullable();
          $table->string('experience')->nullable();
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
        Schema::table('teachers', function (Blueprint $table) {
            //
        });
    }
}
