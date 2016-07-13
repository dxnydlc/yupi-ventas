<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposProdLote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('producto_lote', function (Blueprint $table) {
            $table->decimal('compra', 10, 2)->nullable()->after('precio');
            $table->integer('utilidad')->nullable()->after('compra');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producto_lote', function (Blueprint $table) {
            //
        });
    }
}
