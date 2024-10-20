<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalesTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('nombre', 100);
            $table->boolean('activa')->default(true);
            $table->char('direccion_id', 36)->nullable();
            $table->char('empresa_id', 36)->nullable();
            $table->foreign('direccion_id')->references('id')->on('direcciones')->onDelete('set null');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('set null');
            // No incluimos timestamps si no los usas en el modelo
        });
    }

    /**
     * Revierte las migraciones.
     */
    public function down()
    {
        Schema::dropIfExists('sucursales');
    }
}
