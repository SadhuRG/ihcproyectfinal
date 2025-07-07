<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', '/welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    // Vista de usuario (sin redirección automática)
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');

    // La ruta de logout ya está definida en auth.php, así que la removemos de aquí

    Route::view('user-profile', 'user-profile')
    ->middleware(['auth'])
    ->name('user-profile');

    // Vista de ayuda para el usuario
    Route::view('user-helper', 'user-helper')
    ->middleware(['auth'])
    ->name('user-helper');

    // Vista protegida "normal" (no Livewire)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('dashboard');

    // Ruta para el componente de pedidos
    Route::get('/pedidos', function () {
        return view('pedidos');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('pedidos');

    // Ruta para el componente de ediciones
    Route::get('/ediciones', function () {
        return view('ediciones');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('ediciones');

    // Ruta para el componente de soporte
    Route::get('/soporte', function () {
        return view('soporte');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('soporte');

    // Ruta para el componente de reportes
    Route::get('/reportes', function () {
        return view('reportes');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('reportes');
});

require __DIR__.'/auth.php';