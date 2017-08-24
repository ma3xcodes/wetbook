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
            $table->string('user_name')->unique();
            $table->string('first_name');
            //$table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->date('birthday')->nullable();
            $table->string('password');
            $table->enum('status', [0,1,2,3,4])->default(1);
            $table->enum('role', ['s_admin','admin','user'])->default('user'); //Role s_admin=super admin, admin=admin, user=user
            $table->ipAddress('registered_ip')->nullable();
            $table->boolean('online')->default(false);
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
