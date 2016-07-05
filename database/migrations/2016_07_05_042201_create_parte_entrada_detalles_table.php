<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParteEntradaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parte_entrada_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pe')->nullable();
            $table->string('producto', 200)->nullable();
            $table->integer('id_producto')->nullable();
            $table->string('laboratorio', 200)->nullable();
            $table->date('vencimiento')->nullable();
            $table->string('lote', 200)->nullable();
            $table->integer('cantidad')->nullable();
            $table->decimal('compra', 10, 2)->nullable();
            $table->decimal('venta', 10, 2)->nullable();
            $table->integer('utilidad')->nullable();
            $table->integer('fraccion')->nullable();
            $table->text('token')->nullable();
            $table->softDeletes();
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
        Schema::drop('parte_entrada_detalle');
    }
}
