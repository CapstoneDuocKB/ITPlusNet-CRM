<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelacionesToUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Añadir columnas para las relaciones
            $table->string('sucursal_id')->nullable()->after('empresa_id');
            $table->string('caja_id')->nullable()->after('sucursal_id');
            $table->string('bodega_id')->nullable()->after('caja_id');

            // Definir claves foráneas
            $table->foreign('sucursal_id')->references('id')->on('sucursales')->onDelete('set null');
            $table->foreign('caja_id')->references('id')->on('cajas')->onDelete('set null');
            $table->foreign('bodega_id')->references('id')->on('bodegas')->onDelete('set null');
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
            // Eliminar claves foráneas
            $table->dropForeign(['sucursal_id']);
            $table->dropForeign(['caja_id']);
            $table->dropForeign(['bodega_id']);

            // Eliminar columnas
            $table->dropColumn(['sucursal_id', 'caja_id', 'bodega_id']);
        });
    }
}
