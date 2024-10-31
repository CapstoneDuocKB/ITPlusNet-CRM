<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Sucursal;
use App\Models\Bodega;
use App\Models\Caja;
use App\Models\Usuario;

class ApiService
{
    public function cargarDatos()
    {
        // Cargar Sucursales
        $sucursales = Http::get('https://migestor.cl/api-shivsai/sucursal.php')->json();
        foreach ($sucursales as $data) {
            Sucursal::updateOrCreateFromApiData($data);
        }

        // Cargar Bodegas
        $bodegas = Http::get('https://migestor.cl/api-shivsai/bodega.php')->json();
        foreach ($bodegas as $data) {
            Bodega::updateOrCreateFromApiData($data);
        }

        // Cargar Cajas
        $cajas = Http::get('https://migestor.cl/api-shivsai/caja.php')->json();
        foreach ($cajas as $data) {
            Caja::updateOrCreateFromApiData($data);
        }

        // Cargar Usuarios
        $usuarios = Http::get('https://migestor.cl/api-shivsai/usuario.php')->json();
        foreach ($usuarios as $data) {
            Usuario::updateOrCreateFromApiData($data);
        }
    }
}
