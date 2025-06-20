<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', '/welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    // Redirección automática tras login
    Route::get('/welcome', function () {
        $user = auth()->user();

        if ($user->hasRole('superadministrador')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('administrador')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('colaborador')) {
            return redirect()->route('dashboard');
        }

        return view('welcome');
    })->name('welcome');

    Route::post('/welcome', function () {
    Auth::logout();
    return redirect('/');
    })->name('logout');

    Route::view('user-profile', 'user-profile')
    ->middleware(['auth'])
    ->name('user-profile');


    // Vista protegida "normal" (no Livewire)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('dashboard');

    // Ruta para el componente de pedidos
    Route::get('/pedidos', function () {
        return view('pedidos');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('pedidos');
});

require __DIR__.'/auth.php';
