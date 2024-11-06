<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyRutInUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Hacer que 'rut' sea nullable
            $table->string('rut')->nullable()->change();
            
            // Asegurar que 'rut' sea único
            $table->unique('rut', 'usuarios_rut_unique')->change();
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
            // Revertir 'rut' a no nullable
            $table->string('rut')->nullable(false)->change();
            
            // Eliminar la restricción única
            $table->dropUnique('usuarios_rut_unique');
        });
    }
}
