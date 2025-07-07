<div class="min-h-screen bg-gradient-to-br from-indigo-50 pt-2 via-white to-purple-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">MI PERFIL</h1>
                    <p class="mt-1 text-sm text-gray-600">Lista de Deseos</p>
                </div>
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('profile.dashboard') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                        ← Volver
                    </a>
                    @if(auth()->user()->hasAnyRole(['superadministrador', 'administrador', 'colaborador']))
                        <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                            ← Volver al Dashboard
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Navegación de Secciones -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Lista de Deseos</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <!-- Mi Cuenta -->
                <a href="{{ route('profile.dashboard') }}"
                   class="flex flex-col items-center p-4 bg-gray-50 border-2 border-gray-200 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Mi Cuenta</span>
                </a>

                <!-- Mis Datos -->
                <a href="{{ route('profile.datos') }}"
                   class="flex flex-col items-center p-4 bg-gray-50 border-2 border-gray-200 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Mis Datos</span>
                </a>

                <!-- Mis Pedidos -->
                <a href="{{ route('profile.pedidos') }}"
                   class="flex flex-col items-center p-4 bg-gray-50 border-2 border-gray-200 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Mis Pedidos</span>
                </a>

                <!-- Mis Direcciones -->
                <a href="{{ route('profile.direcciones') }}"
                   class="flex flex-col items-center p-4 bg-gray-50 border-2 border-gray-200 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Mis Direcciones</span>
                </a>

                <!-- Mi Lista de Deseos - Activo -->
                <a href="{{ route('profile.deseos') }}"
                   class="flex flex-col items-center p-4 bg-red-50 border-2 border-red-200 rounded-lg hover:bg-red-100 transition-colors duration-200">
                    <svg class="w-8 h-8 text-red-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span class="text-sm font-medium text-red-900">Lista de Deseos</span>
                </a>
            </div>
        </div>

        <!-- Búsqueda -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h3 class="text-lg font-semibold text-gray-900">Mis Libros Favoritos</h3>

                <!-- Búsqueda -->
                <div class="relative">
                    <input wire:model.live="searchTerm" type="text" placeholder="Buscar por título o autor..."
                        class="w-full sm:w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Notificaciones -->
        @if(session('cart_success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-green-800">{{ session('cart_success') }}</span>
                </div>
            </div>
        @endif

        @if(session('wishlist_success'))
            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-blue-800">{{ session('wishlist_success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-red-800">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Lista de Libros Favoritos -->
        @forelse($favoriteBooks as $book)
            @php
                $edition = $book->editions->first();
                $authors = $book->authors->map(function($author) {
                    return trim($author->apellido . ', ' . $author->nombre);
                })->join('; ');
                $price = $edition ? ($edition->precio_promocional ?? $edition->precio) : 0;
            @endphp

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                    <!-- Imagen del Libro -->
                    <div class="flex-shrink-0">
                        @if($edition && $edition->url_portada && $edition->url_portada !== '/images/covers/default.jpg')
                            <img src="{{ $edition->url_portada }}" alt="{{ $book->titulo }}"
                                 class="w-24 h-32 object-cover rounded-lg shadow-sm">
                        @else
                            <!-- Placeholder cuando no hay imagen -->
                            <div class="w-24 h-32 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Información del Libro -->
                    <div class="flex-grow">
                        <div class="flex items-start justify-between mb-2">
                            <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $book->titulo }}</h4>

                            <!-- Botón Eliminar de Favoritos -->
                            <button wire:click="removeFromWishlist({{ $book->id }})"
                                onclick="return confirm('¿Eliminar este libro de tu lista de deseos?')"
                                class="text-red-500 hover:text-red-700 transition-colors duration-200"
                                title="Eliminar de favoritos">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>

                        <p class="text-gray-600 mb-4">{{ $authors }}</p>

                        @if($book->descripcion)
                            <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ Str::limit($book->descripcion, 150) }}</p>
                        @endif
                    </div>

                    <!-- Precio y Acciones -->
                    <div class="flex flex-col items-center space-y-4 min-w-[200px]">
                        @if($edition)
                            <!-- Precio -->
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">s/{{ number_format($price, 2) }}</div>
                                @if($edition->precio_promocional && $edition->precio_promocional < $edition->precio)
                                    <div class="text-sm text-gray-500 line-through">s/{{ number_format($edition->precio, 2) }}</div>
                                @endif
                            </div>

                            <!-- Selector de Cantidad -->
                            <div class="flex items-center space-x-2">
                                <label class="text-sm font-medium text-gray-700">Cantidad:</label>
                                <select wire:model="quantities.{{ $book->id }}"
                                    wire:change="updateQuantity({{ $book->id }}, $event.target.value)"
                                    class="w-16 px-2 py-1 border border-gray-300 rounded text-center focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Botón Añadir al Carrito -->
                            <button wire:click="addToCart({{ $book->id }})"
                                class="w-full px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                                </svg>
                                <span>Añadir al Carrito</span>
                            </button>
                        @else
                            <!-- Sin ediciones disponibles -->
                            <div class="text-center">
                                <div class="text-lg font-medium text-gray-500 mb-2">No disponible</div>
                                <p class="text-sm text-gray-400">Sin ediciones disponibles</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <!-- Estado Vacío -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <div class="mx-auto w-24 h-24 bg-gradient-to-br from-red-400 to-pink-600 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                    @if($searchTerm)
                        No se encontraron libros
                    @else
                        Tu lista de deseos está vacía
                    @endif
                </h3>
                <p class="text-gray-600 mb-6">
                    @if($searchTerm)
                        No encontramos libros que coincidan con "{{ $searchTerm }}". Intenta con otros términos de búsqueda.
                    @else
                        Aún no has agregado libros a tu lista de deseos. Explora nuestro catálogo y guarda tus libros favoritos.
                    @endif
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @if($searchTerm)
                        <button wire:click="$set('searchTerm', '')"
                            class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Limpiar Búsqueda
                        </button>
                    @endif
                    <a href="{{ route('welcome') }}"
                       class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Explorar Libros
                    </a>
                </div>
            </div>
        @endforelse

        <!-- Paginación -->
        @if($favoriteBooks->hasPages())
            <div class="mt-8">
                {{ $favoriteBooks->links() }}
            </div>
        @endif
    </div>
</div>
