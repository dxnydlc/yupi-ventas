<?php

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
            $table->string('name');
            $table->string('last_name', 100)->nullable();
            $table->integer('dni')->nullable();
            $table->string('email')->unique();
            $table->string('type', 100)->nullable();
            $table->string('user', 100)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->string('cargo', 200)->nullable();
            $table->string('telefono', 200)->nullable();
            $table->string('token', 200)->nullable();
            $table->string('password');
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
        Schema::drop('users');
    }
}
