<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


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
