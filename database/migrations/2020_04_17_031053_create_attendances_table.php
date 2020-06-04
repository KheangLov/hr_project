<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->dateTime('request_date', 0);
            $table->tinyInteger('leave_time');
            $table->decimal('total_leave_date', 8, 2);
            $table->string('reason', 255);
            $table->string('first_app_comment', 255)->nullable();
            $table->string('second_app_comment', 255)->nullable();
            $table->string('remaining_leave', 255)->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('leave_type');
            $table->date('back_date')->nullable();
            $table->unsignedBigInteger('supervisor_id');
            $table->foreign('supervisor_id')->references('id')->on('users');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('second_app_id');
            $table->foreign('second_app_id')->references('id')->on('users');
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
