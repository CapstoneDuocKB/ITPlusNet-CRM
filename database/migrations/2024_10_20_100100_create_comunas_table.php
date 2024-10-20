<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComunasTable extends Migration
{
    public function up()
    {
        Schema::create('comunas', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('nombre', 100);
            $table->char('region_id', 36);
            $table->foreign('region_id')->references('id')->on('regiones')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comunas');
    }
}
