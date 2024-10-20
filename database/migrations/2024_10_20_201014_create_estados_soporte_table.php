<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosSoporteTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     */
    public function up()
    {
        Schema::create('estados_soporte', function (Blueprint $table) {
            $table->char('id', 36)->primary(); // Clave primaria UUID
            $table->string('nombre', 255);
            $table->string('descripcion', 255);
            // No incluimos timestamps ya que $timestamps = false en el modelo
        });
    }

    /**
     * Revierte las migraciones.
     */
    public function down()
    {
        Schema::dropIfExists('estados_soporte');
    }
}
