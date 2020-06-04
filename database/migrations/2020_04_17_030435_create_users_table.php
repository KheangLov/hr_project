<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('name_khmer');
            $table->string('gender');
            $table->date('dob');
            $table->tinyInteger('status');
            $table->text('id_card')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->decimal('annual_leave', 8, 2);
            $table->string('back_account');
            $table->decimal('salary', 8, 2);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('address', 255);
            $table->text('contact')->nullable();
            $table->string('emer_contact_name')->nullable();
            $table->string('emer_contact_relation')->nullable();
            $table->string('emer_contact_phone')->nullable();
            $table->text('contract')->nullable();
            $table->text('profile')->nullable();
            $table->string('hobby', 255)->nullable();
            $table->string('home_town', 255)->nullable();
            $table->string('self_intro', 255)->nullable();
            $table->string('goal', 255)->nullable();
            $table->string('education', 255)->nullable();
            $table->integer('supervisor_id')->nullable();
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
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
