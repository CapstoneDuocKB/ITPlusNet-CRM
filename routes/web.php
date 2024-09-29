<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\SoporteController;

Route::get('/soportes/create', [SoporteController::class, 'create'])->name('soportes.create');
Route::post('/soportes/upload', 'SoporteController@upload')->name('soportes.upload');
Route::post('/soportes', [SoporteController::class, 'store'])->name('soportes.store');
Route::get('/soportes', [SoporteController::class, 'index'])->name('soportes.index');



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
