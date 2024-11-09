<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacionablesTable extends Migration
{
    public function up()
    {
        Schema::create('relacionables', function (Blueprint $table) {
            $table->uuid('usuario_id');
            $table->morphs('relacionable'); // Crea 'relacionable_type' y 'relacionable_id'
            $table->timestamps();

            // Índices y claves foráneas
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->index(['relacionable_type', 'relacionable_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('relacionables');
    }
}
