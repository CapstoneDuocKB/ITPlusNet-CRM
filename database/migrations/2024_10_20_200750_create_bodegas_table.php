<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodegasTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     */
    public function up()
    {
        Schema::create('bodegas', function (Blueprint $table) {
            $table->char('id', 36)->primary(); // Clave primaria UUID
            $table->string('nombre', 100);
            $table->boolean('activa')->default(true);
            $table->char('sucursal_id', 36);
            $table->foreign('sucursal_id')->references('id')->on('sucursales')->onDelete('cascade');
            // No incluimos timestamps ya que $timestamps = false en el modelo
        });
    }

    /**
     * Revierte las migraciones.
     */
    public function down()
    {
        Schema::dropIfExists('bodegas');
    }
}
