<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles', function (Blueprint $table) {

            $table->integer('id_envio')->unsigned();
            $table->string('chassis')->unsigned();
            $table->date('fecha_envio')->nullable();
            $table->date('fecha_entrega_estimada')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('estado')->nullable();

            $table->timestamps();

            $table->primary(['id_envio', 'chassis']);

            $table->foreign('id_envio')->references('id_envio')->on('envios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles');
    }
}
