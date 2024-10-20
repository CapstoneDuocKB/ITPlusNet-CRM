<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDificultadesSoporteTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     */
    public function up()
    {
        Schema::create('dificultades_soporte', function (Blueprint $table) {
            $table->char('id', 36)->primary(); // Clave primaria UUID
            $table->string('nombre', 20);
            $table->string('descripcion', 255)->nullable();
            $table->float('uf');
            // No incluimos timestamps ya que $timestamps = false en el modelo
        });
    }

    /**
     * Revierte las migraciones.
     */
    public function down()
    {
        Schema::dropIfExists('dificultades_soporte');
    }
}
