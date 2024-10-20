<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('rut', 12)->unique();
            $table->string('nombre', 50);
            $table->string('razon_social', 150);
            $table->char('direccion_id', 36);
            $table->string('color', 20);
            $table->string('ruta_logo', 255);
            $table->boolean('activa')->default(true);
            $table->timestamps();

            $table->foreign('direccion_id')->references('id')->on('direcciones')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
