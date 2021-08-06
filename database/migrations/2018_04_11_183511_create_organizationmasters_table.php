<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationmastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizationmasters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('OrgName');
            $table->string('Address1');
            $table->string('Address2');
            $table->string('City');
            $table->string('State');
            $table->string('AdminEmailID');
            $table->integer('CreatedBy');
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
        Schema::dropIfExists('organizationmasters');
    }
}
