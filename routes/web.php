<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\UserProfile;
use App\Livewire\ProfileDashboard;
use App\Livewire\ProfilePedidos;
use App\Livewire\ProfileDirecciones;
use App\Livewire\ProfileDeseos;

Route::view('/', '/welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    // Vista de usuario (sin redirección automática)
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');

    // ========== RUTAS DEL SISTEMA DE PERFIL ==========
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', ProfileDashboard::class)->name('dashboard');
        Route::get('/datos', UserProfile::class)->name('datos');
        Route::get('/pedidos', ProfilePedidos::class)->name('pedidos');
        Route::get('/direcciones', ProfileDirecciones::class)->name('direcciones');
        Route::get('/deseos', ProfileDeseos::class)->name('deseos');
    });

    // ========== RUTA ANTIGUA DEL PERFIL (mantener por compatibilidad) ==========
    Route::get('user-profile', UserProfile::class)->middleware(['auth'])->name('user-profile');

    // ========== RUTAS DE ADMINISTRACIÓN ==========
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
