<div class="min-h-screen bg-gradient-to-br from-indigo-50 pt-20 via-white to-purple-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">MI PERFIL</h1>
                    <p class="mt-1 text-sm text-gray-600">Mis pedidos</p>
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
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Mis pedidos</h2>
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

                <!-- Mis Pedidos - Activo -->
                <a href="{{ route('profile.pedidos') }}"
                   class="flex flex-col items-center p-4 bg-indigo-50 border-2 border-indigo-200 rounded-lg hover:bg-indigo-100 transition-colors duration-200">
                    <svg class="w-8 h-8 text-indigo-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="text-sm font-medium text-indigo-900">Mis Pedidos</span>
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

                <!-- Mi Lista de Deseos -->
                <a href="{{ route('profile.deseos') }}"
                   class="flex flex-col items-center p-4 bg-gray-50 border-2 border-gray-200 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Lista de Deseos</span>
                </a>
            </div>
        </div>

        <!-- Filtros y Búsqueda -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <!-- Filtros de Estado -->
                <div class="flex space-x-2">
                    <button wire:click="filterByStatus('all')"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ $selectedStatus === 'all' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Todos
                    </button>
                    <button wire:click="filterByStatus('completed')"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ $selectedStatus === 'completed' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Finalizados
                    </button>
                    <button wire:click="filterByStatus('pending')"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ $selectedStatus === 'pending' ? 'bg-yellow-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Pendientes
                    </button>
                </div>

                <!-- Búsqueda -->
                <div class="relative">
                    <input wire:model.live="searchTerm" type="text" placeholder="Buscar por título..."
                        class="w-full sm:w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Notificación de Carrito -->
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

        <!-- Lista de Pedidos -->
        <div class="space-y-6">
            @forelse($orders as $order)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <!-- Header del Pedido -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                @if($order->estado)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        Finalizado
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        Pendiente
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="text-sm text-gray-600 mt-2 sm:mt-0">
                            Pedido realizado el: {{ $order->fecha_orden ? $order->fecha_orden->format('d/m/Y') : $order->created_at->format('d/m/Y') }}
                        </div>
                    </div>

                    <!-- Productos del Pedido -->
                    <div class="space-y-4">
                        @foreach($order->editions as $edition)
                            <div class="flex flex-col sm:flex-row items-start sm:items-center border border-gray-200 rounded-lg p-4">
                                <!-- Imagen del Libro -->
                                <div class="flex-shrink-0 mb-4 sm:mb-0 sm:mr-6">
                                    @if($edition->url_portada && $edition->url_portada !== '/images/covers/default.jpg')
                                        <img src="{{ $edition->url_portada }}" alt="{{ $edition->book->titulo }}"
                                             class="w-20 h-28 object-cover rounded-lg shadow-sm">
                                    @else
                                        <!-- Placeholder cuando no hay imagen -->
                                        <div class="w-20 h-28 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Información del Libro -->
                                <div class="flex-grow">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-1">
                                        {{ $edition->book->titulo }}
                                    </h4>
                                    <p class="text-sm text-gray-600 mb-2">
                                        {{ $edition->book->authors->pluck('nombre')->map(function($nombre, $index) use ($edition) {
                                            $apellido = $edition->book->authors[$index]->apellido ?? '';
                                            return trim($apellido . ', ' . $nombre);
                                        })->join('; ') }}
                                    </p>

                                    <!-- Precio y Cantidad -->
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex items-center space-x-4 mb-2 sm:mb-0">
                                            <span class="text-lg font-bold text-gray-900">
                                                s/{{ number_format($edition->precio_promocional ?? $edition->precio, 2) }}
                                            </span>
                                            <span class="text-sm text-gray-600">
                                                x{{ $edition->pivot->cantidad }}
                                            </span>
                                        </div>

                                        <!-- Total del Producto -->
                                        <div class="text-right">
                                            <div class="text-lg font-bold text-gray-900">
                                                Total: s/{{ number_format(($edition->precio_promocional ?? $edition->precio) * $edition->pivot->cantidad, 2) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botón Añadir al Carrito -->
                                <div class="flex-shrink-0 mt-4 sm:mt-0 sm:ml-6">
                                    <button wire:click="addToCart({{ $edition->id }}, {{ $edition->pivot->cantidad }})"
                                        class="w-full sm:w-auto px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                                        </svg>
                                        <span>Añadir al Carrito</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total del Pedido -->
                    <div class="border-t border-gray-200 pt-4 mt-6">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-700">Total del Pedido:</span>
                            <span class="text-2xl font-bold text-gray-900">s/{{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Estado Vacío -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <div class="mx-auto w-24 h-24 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No tienes pedidos aún</h3>
                    <p class="text-gray-600 mb-6">
                        @if($selectedStatus === 'all')
                            Parece que aún no has realizado ningún pedido.
                        @elseif($selectedStatus === 'completed')
                            No tienes pedidos finalizados.
                        @elseif($selectedStatus === 'pending')
                            No tienes pedidos pendientes.
                        @endif
                        @if($searchTerm)
                            <br>Intenta con otros términos de búsqueda.
                        @endif
                    </p>
                    <a href="{{ route('welcome') }}"
                       class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Explorar Libros
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        @if($orders->hasPages())
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
