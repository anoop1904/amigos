<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_type')->unsigned()->comment('1 for admin 2 for student 3 for other');
            $table->integer('OrgID')->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('Phone');
            $table->string('Designation');
            $table->integer('CreatedBy');
            $table->integer('UpdatedBy')->nullable();
            $table->integer('RoleID')->unsigned();
            $table->foreign('OrgID')->references('id')->on('organizationmasters');
            $table->foreign('RoleID')->references('id')->on('rolemasters');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
