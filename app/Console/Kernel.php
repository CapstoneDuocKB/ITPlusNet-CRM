<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Registra aquí tus comandos personalizados
        Commands\ImportarDatosApi::class,
    ];

    /**
     * Define la programación de comandos para la aplicación.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Programar el comando ETL para que se ejecute diariamente
        $schedule->command('importar:datos-api')->daily();
    }

    /**
     * Registra los comandos de Artisan para la aplicación.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
