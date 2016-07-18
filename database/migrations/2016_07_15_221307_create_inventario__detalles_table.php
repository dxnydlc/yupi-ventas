<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarioDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_inventario')->nullable();
            $table->integer('id_producto')->nullable();
            $table->string('producto')->nullable();
            $table->string('lote')->nullable();
            $table->string('laboratorio')->nullable();
            $table->date('vencimiento')->nullable();
            $table->decimal('compra', 10, 2)->nullable();
            $table->decimal('venta', 10, 2)->nullable();
            $table->integer('stock')->nullable();
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
        Schema::drop('inventario_detalle');
    }
}
