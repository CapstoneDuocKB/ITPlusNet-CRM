<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ChatGPTController;

// Ruta pública inicial
Route::get('/', function () {
    return view('welcome');
});

// Rutas para autenticación y permisos
// Route::middleware(['auth'])->group(function () {  
//     Route::get('/soportes/create', [SoporteController::class, 'create'])->name('soportes.create');
//     Route::post('/soportes/upload', [SoporteController::class, 'upload'])->name('soportes.upload');
//     Route::post('/soportes', [SoporteController::class, 'store'])->name('soportes.store');
//     Route::get('/soportes/index', [SoporteController::class, 'index'])->name('soportes.index');
//     Route::get('/soportes/read', [SoporteController::class, 'read'])->name('soportes.read');
//     Route::get('/soportes/show', [SoporteController::class, 'show'])->name('soportes.show');

// });

// Ruta para el formulario inicial del chat
Route::get('/chat', [ChatGPTController::class, 'showChat'])->name('chat.show');

// Ruta para enviar un mensaje a ChatGPT (a través del POST)
Route::post('/chat', [ChatGPTController::class, 'askChatGPT'])->name('chat.ask');

// Ruta para crear un soporte (el controlador SoporteController manejará la creación del soporte y luego redirigirá al chat)
Route::post('/soportes', [SoportesController::class, 'store'])->name('soportes.store')->middleware('auth');
// Route::post('/soportes/upload', [SoporteController::class, 'upload'])->name('soportes.upload');
// Route::resource('soportes', SoporteController::class);
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    
    // Ruta para el perfil del usuario (esto ya lo maneja Jetstream por defecto)
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');
});
