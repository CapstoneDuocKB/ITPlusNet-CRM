<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoportesTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     */
    public function up()
    {
        Schema::create('soportes', function (Blueprint $table) {
            $table->char('id', 36)->primary(); // Clave primaria UUID
            $table->unsignedInteger('numero_soporte')->unique(); // Número de soporte único
            $table->float('horas_hombre')->nullable();
            $table->float('uf')->nullable();
            $table->string('descripcion', 4000)->nullable();
            $table->string('solucion', 4000)->nullable();
            $table->string('celular', 12)->nullable();
            $table->string('email', 45)->nullable();
            $table->boolean('urgente')->default(false);
            $table->timestamps(); // Campos created_at y updated_at

            // Claves foráneas
            $table->char('bodega_id', 36);
            $table->char('caja_id', 36);
            $table->char('dificultad_soporte_id', 36);
            $table->char('estado_soporte_id', 36);
            $table->char('tipo_soporte_id', 36);

            $table->foreign('bodega_id')->references('id')->on('bodegas')->onDelete('cascade');
            $table->foreign('caja_id')->references('id')->on('cajas')->onDelete('cascade');
            $table->foreign('dificultad_soporte_id')->references('id')->on('dificultades_soporte')->onDelete('cascade');
            $table->foreign('estado_soporte_id')->references('id')->on('estados_soporte')->onDelete('cascade');
            $table->foreign('tipo_soporte_id')->references('id')->on('tipos_soporte')->onDelete('cascade');
        });
    }

    /**
     * Revierte las migraciones.
     */
    public function down()
    {
        Schema::dropIfExists('soportes');
    }
}
