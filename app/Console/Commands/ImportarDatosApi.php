<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sucursal;
use App\Models\Bodega;
use App\Models\Caja;
use App\Models\Usuario;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImportarDatosApi extends Command
{
    protected $signature = 'importar:datos-api';
    protected $description = 'Importa datos desde la API externa hacia la base de datos local';

    public function handle()
    {
        try {
            // Importar Sucursales
            $this->info('Importando Sucursales...');
            $sucursales = $this->obtenerDatosApi('https://migestor.cl/api-shivsai/sucursal.php');

            foreach ($sucursales as $data) {
                Sucursal::updateOrCreateFromApiData($data);
            }
            $this->info('Sucursales importadas exitosamente.');

            // Importar Bodegas
            $this->info('Importando Bodegas...');
            $bodegas = $this->obtenerDatosApi('https://migestor.cl/api-shivsai/bodega.php');

            foreach ($bodegas as $data) {
                Bodega::updateOrCreateFromApiData($data);
            }
            $this->info('Bodegas importadas exitosamente.');

            // Importar Cajas
            $this->info('Importando Cajas...');
            $cajas = $this->obtenerDatosApi('https://migestor.cl/api-shivsai/caja.php');

            foreach ($cajas as $data) {
                Caja::updateOrCreateFromApiData($data);
            }
            $this->info('Cajas importadas exitosamente.');

            // Importar Usuarios
            $this->info('Importando Usuarios...');
            $usuarios = $this->obtenerDatosApi('https://migestor.cl/api-shivsai/usuario.php');

            foreach ($usuarios as $data) {
                Usuario::updateOrCreateFromApiData($data);
            }
            $this->info('Usuarios importados exitosamente.');

            $this->info('Proceso ETL completado con éxito.');
            return 0; // Exit code 0 significa éxito
        } catch (\Exception $e) {
            // Manejar excepciones y registrar errores
            Log::error('Error durante el proceso ETL: ' . $e->getMessage());
            $this->error('Ocurrió un error durante el proceso ETL. Revisa los logs para más detalles.');
            return 1; // Exit code 1 significa error
        }
    }

    /**
     * Método para obtener datos desde una API.
     *
     * @param string $url
     * @return array
     */
    private function obtenerDatosApi(string $url): array
    {
        $response = Http::retry(3, 100)->get($url);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception("Fallo al obtener datos de la API: {$url}");
    }
}
