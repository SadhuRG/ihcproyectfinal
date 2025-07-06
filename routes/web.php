<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\UserProfile;
use App\Livewire\ProfileDashboard;
use App\Livewire\ProfilePedidos;
use App\Livewire\ProfilePedidoDetalles;
use App\Livewire\ProfileDirecciones;
use App\Livewire\ProfileDeseos;
use App\Livewire\Books\BookDetail;

Route::view('/', '/welcome');

// 📚 Esta ruta debe ir FUERA del grupo protegido
Route::get('/libro/{bookId}', BookDetail::class)->name('book.detail');

Route::middleware(['auth', 'verified'])->group(function () {
    // Vista de usuario (sin redirección automática)
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');

    // ========== SISTEMA COMPLETO DE PERFIL ==========
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', ProfileDashboard::class)->name('dashboard');
        Route::get('/datos', UserProfile::class)->name('datos');
        Route::get('/pedidos', ProfilePedidos::class)->name('pedidos');
        Route::get('/pedidos/{orderId}', \App\Livewire\ProfilePedidoDetalles::class)->name('pedido.detalles');
        Route::get('/direcciones', ProfileDirecciones::class)->name('direcciones');
        Route::get('/deseos', ProfileDeseos::class)->name('deseos');
    });

    // ========== RUTA ANTIGUA DEL PERFIL ==========
    Route::get('user-profile', UserProfile::class)->middleware(['auth'])->name('user-profile');

    // ========== RUTAS DE ADMINISTRACIÓN ==========
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('dashboard');

    Route::get('/pedidos', function () {
        return view('pedidos');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('pedidos');

    Route::get('/ediciones', function () {
        return view('ediciones');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('ediciones');

    Route::get('/soporte', function () {
        return view('soporte');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('soporte');

    Route::get('/reportes', function () {
        return view('reportes');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('reportes');
});

require __DIR__ . '/auth.php';
