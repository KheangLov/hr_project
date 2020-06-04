<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClickAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('click_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
            $table->time('real_time_in')->nullable();
            $table->time('real_time_out')->nullable();
            $table->integer('total_time')->nullable();
            $table->tinyInteger('status');
            $table->string('staff_note', 255)->nullable();
            $table->string('hr_note', 255)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('click_attendances');
    }
}
