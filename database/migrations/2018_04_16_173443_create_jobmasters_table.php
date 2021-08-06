<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobmastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobmasters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('OrgID');
            $table->string('JobTitle');
            $table->text('Description');
            $table->text('Department');
            $table->integer('HiringManagerID');
            $table->integer('SalaryFrom');
            $table->integer('SalaryTo');
            $table->integer('Positions');
            $table->string('ExpectedJoiningDate');
            $table->text('Tags');
            $table->text('Skills');
            $table->string('Location');
            $table->text('Keywords');
            $table->integer('IsActive');
            $table->string('Status');
            $table->integer('CreatedBy');
            $table->integer('UpdatedBy');
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
        Schema::dropIfExists('jobmasters');
    }
}
