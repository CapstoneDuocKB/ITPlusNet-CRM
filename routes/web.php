<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\SoporteController;
use App\Http\Controllers\BodegasController;
use App\Http\Controllers\CajasController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\ComunasController;
use App\Http\Controllers\DireccionesController;
use App\Http\Controllers\RegionesController;
use App\Http\Controllers\EstadosSoporteController;
use App\Http\Controllers\TiposSoporteController;
use App\Http\Controllers\DificultadesSoporteController;


// Route::get('/soportes/create', [SoporteController::class, 'create'])->name('soportes.create');
// Route::post('/soportes/upload', [SoporteController::class, 'upload'])->name('soportes.upload');
// Route::post('/soportes', [SoporteController::class, 'store'])->name('soportes.store');
// Route::get('/soportes', [SoporteController::class, 'index'])->name('soportes.index');
// Route::get('/soportes/read', [SoporteController::class, 'read'])->name('soportes.read');

Route::post('/soportes/upload', [SoporteController::class, 'upload'])->name('soportes.upload');


Route::resource('soportes', SoporteController::class);

Route::resource('bodegas', BodegasController::class);

Route::resource('cajas', CajasController::class);

Route::resource('sucursales', SucursalesController::class);

Route::resource('empresas', EmpresasController::class);

Route::resource('comunas', ComunasController::class);

Route::resource('direcciones', DireccionesController::class);

Route::resource('regiones', RegionesController::class);

Route::resource('estados_soporte', EstadosSoporteController::class);

Route::resource('tipos_soporte', TiposSoporteController::class);

Route::resource('dificultades_soporte', DificultadesSoporteController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Ruta para el perfil del usuario (esto ya lo maneja Jetstream por defecto)
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');
});
