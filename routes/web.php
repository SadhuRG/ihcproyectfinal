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
// Agregar esta ruta en routes/web.php

Route::get('/categoria/{categoria}', function ($categoria) {
    // Mapear URL amigables a nombres reales de categorías
    $categoriaMap = [
        'ficcion' => 'Ficción y Literatura',
        'no-ficcion' => 'No Ficción',
        'desarrollo' => 'Desarrollo Personal',
        'tecnico' => 'Técnico y Educativo',
        'arte' => 'Arte y Cultura',
        'infantil' => 'Infantil y Juvenil',
        'religion' => 'Religión y Espiritualidad',

        // Subcategorías específicas
        'literatura-contemporanea' => 'Literatura Contemporánea',
        'novela-historica' => 'Novela Histórica',
        'ciencia-ficcion' => 'Ciencia Ficción',
        'fantasia' => 'Fantasía',
        'misterio-y-suspense' => 'Misterio y Suspense',
        'romance' => 'Romance',
        'poesia' => 'Poesía',
        'teatro' => 'Teatro',
        'biografia-y-memorias' => 'Biografía y Memorias',
        'ensayo' => 'Ensayo',
        'filosofia' => 'Filosofía',
        'historia' => 'Historia',
        'ciencias-sociales' => 'Ciencias Sociales',
        'politica-y-actualidad' => 'Política y Actualidad',
        'negocios-y-economia' => 'Negocios y Economía',
        'psicologia' => 'Psicología',
        'salud-y-bienestar' => 'Salud y Bienestar',
        'tecnologia-e-informatica' => 'Tecnología e Informática',
        'educacion' => 'Educación',
        'arte-y-fotografia' => 'Arte y Fotografía',
        'cocina-y-gastronomia' => 'Cocina y Gastronomía',
        'viajes-y-geografia' => 'Viajes y Geografía'
    ];

    $nombreCategoria = $categoriaMap[$categoria] ?? ucwords(str_replace('-', ' ', $categoria));

    return view('categoria', [
        'categoria' => $nombreCategoria,
        'slug' => $categoria
    ]);
})->name('categoria.show');

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
    // Vista de ayuda para el usuario
    Route::view('user-helper', 'user-helper')
    ->middleware(['auth'])
    ->name('user-helper');

    // ========== RUTAS DE ADMINISTRACIÓN ==========
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('dashboard');

    // Ruta de ayuda para administradores
    Route::get('/admin-help', function () {
        return view('admin-help');
    })->middleware('checkAnyRole:superadministrador,administrador,colaborador')->name('admin-help');

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
