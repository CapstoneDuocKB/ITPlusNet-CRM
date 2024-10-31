<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiService;

class CargarDatosApi extends Command
{
    protected $signature = 'api:cargar-datos';
    protected $description = 'Carga datos desde la API en la base de datos';

    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        parent::__construct();
        $this->apiService = $apiService;
    }

    public function handle()
    {
        $this->info('Iniciando la carga de datos desde la API...');
        $this->apiService->cargarDatos();
        $this->info('Datos cargados exitosamente.');
    }
}
