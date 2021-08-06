<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsitesettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websitesettings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('website_name');
            $table->string('website_logo');
            $table->string('locktimeout');
            $table->string('email');
            $table->string('address');
            $table->string('mobile');
            $table->string('fb_link');
            $table->string('twi_link');
            $table->string('yout_link');
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
        Schema::dropIfExists('websitesettings');
    }
}
