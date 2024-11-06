<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeFieldsNullableInUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Hacer que los campos sean nullable
            $table->string('rut')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('telefono')->nullable()->change();
            $table->uuid('direccion_id')->nullable()->change();
            $table->uuid('empresa_id')->nullable()->change();
            $table->boolean('activo')->nullable()->change();
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Revertir los cambios
            $table->string('rut')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('telefono')->nullable(false)->change();
            $table->uuid('direccion_id')->nullable(false)->change();
            $table->uuid('empresa_id')->nullable(false)->change();
            $table->boolean('activo')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
        });
    }
}
