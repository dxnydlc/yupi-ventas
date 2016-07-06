<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAddCampos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name', 100)->after('name')->nullable();
            $table->integer('dni')->after('last_name')->nullable();
            $table->string('type', 100)->after('email')->nullable();
            $table->string('user', 100)->after('type')->nullable();
            
            $table->string('direccion', 200)->after('user')->nullable();
            $table->string('cargo', 200)->after('direccion')->nullable();
            $table->string('telefono', 200)->after('cargo')->nullable();
            $table->string('token', 200)->after('telefono')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
