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

    // Vista protegida "normal" (no Livewire)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('dashboard');
});

require __DIR__.'/auth.php';
