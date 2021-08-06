<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatemastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatemasters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid')->nullable();
            $table->integer('OrgID')->nullable();
            $table->integer('JobID')->nullable();
            $table->string('FirstName')->nullable();
            $table->string('LastName')->nullable();
            $table->string('Email')->nullable();
            $table->string('AlternateEmail')->nullable();
            $table->string('Phone')->nullable();
            $table->string('AlternatePhone')->nullable();
            $table->string('Source')->nullable();
            $table->string('CurrentCTC')->nullable();
            $table->string('NoticePeriod')->nullable();
            $table->string('CurrentCompany')->nullable();
            $table->string('CurrentDesignation')->nullable();
            $table->string('TotalExperience')->nullable();
            $table->text('Tags')->nullable();
            $table->text('Skills')->nullable();
            $table->string('Status')->nullable();
            $table->text('CVText')->nullable();
            $table->text('CVKeywords')->nullable();
            $table->string('UploadedCVPath')->nullable();
            $table->integer('CreatedBy')->nullable();
            $table->integer('UpdatedBy')->nullable();
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
        Schema::dropIfExists('candidatemasters');
    }
}
