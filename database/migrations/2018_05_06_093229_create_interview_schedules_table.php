<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('OrgID');
            $table->integer('jobid');
            $table->integer('student_id');
            $table->integer('user_id');
            $table->string('interview_date');
            $table->string('interview_time');
            $table->string('rating')->nullable();
            $table->text('feadback')->nullable();
            $table->integer('created_by');
            $table->integer('status')->comment('1 for interview pending 2 for done');
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
        Schema::dropIfExists('interview_schedules');
    }
}
