<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_stocks', function (Blueprint $table) {

            $table->increments('id_stock');
            $table->string('cod_marca')->unsigned();
            $table->string('cod_modelo')->unsigned();
            $table->string('cod_master')->unsigned();
            $table->string('regional')->unsigned();
            $table->integer('stock_min');
            $table->integer('stock_asignado');
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
        Schema::dropIfExists('stocks');
    }
}
