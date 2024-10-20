<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionesTable extends Migration
{
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('calle');
            $table->string('numero', 20);
            $table->char('comuna_id', 36);
            $table->timestamps();

            $table->foreign('comuna_id')->references('id')->on('comunas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('direcciones');
    }
}
