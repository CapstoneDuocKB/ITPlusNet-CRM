<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionesTable extends Migration
{
    public function up()
    {
        Schema::create('regiones', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('nombre', 100);
        });
    }

    public function down()
    {
        Schema::dropIfExists('regiones');
    }
}
