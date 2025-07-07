<div class="min-h-screen bg-gradient-to-br from-indigo-50 pt-20 via-white to-purple-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">MI PERFIL</h1>
                    <p class="mt-1 text-sm text-gray-600">Detalles de Pedido</p>
                </div>
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('profile.pedidos') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                        ← Volver a Mis Pedidos
                    </a>
                    <a href="{{ route('profile.dashboard') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                        ← Volver al Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navegación de Secciones -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Detalles de Pedido</h2>
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

        <!-- Contenido Principal del Pedido -->
        @if($order)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                <!-- Header del Pedido -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 pb-6 border-b border-gray-200">
                    <div class="flex items-center space-x-4">
                        @if($order->estado)
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-medium bg-green-100 text-green-800">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Finalizado
                            </span>
                        @else
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-medium bg-yellow-100 text-yellow-800">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                Pendiente
                            </span>
                        @endif
                    </div>
                    <div class="text-sm text-gray-600 mt-2 sm:mt-0">
                        Pedido realizado el: {{ $order->fecha_orden ? $order->fecha_orden->format('d \d\e F, Y') : $order->created_at->format('d \d\e F, Y') }}
                    </div>
                </div>

                <!-- Productos del Pedido -->
                <div class="mb-8">
                    @foreach($order->editions as $edition)
                        <div class="flex flex-col md:flex-row items-start md:items-center border border-gray-200 rounded-lg p-6 mb-4">
                            <!-- Imagen del Libro -->
                            <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                                @if($edition->url_portada && $edition->url_portada !== '/images/covers/default.jpg')
                                    <img src="{{ $edition->url_portada }}" alt="{{ $edition->book->titulo }}"
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
                                <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $edition->book->titulo }}</h4>
                                <p class="text-gray-600 mb-4">
                                    {{ $edition->book->authors->map(function($author) {
                                        return trim($author->apellido . ', ' . $author->nombre);
                                    })->join('; ') }}
                                </p>

                                <!-- Precio y Cantidad -->
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                                        <span class="text-2xl font-bold text-gray-900">
                                            s/{{ number_format($edition->precio_promocional ?? $edition->precio, 2) }}
                                        </span>
                                        <span class="text-lg text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                                            x{{ $edition->pivot->cantidad }}
                                        </span>
                                    </div>

                                    <!-- Total del Producto -->
                                    <div class="text-right">
                                        <div class="text-2xl font-bold text-gray-900">
                                            Total: s/{{ number_format(($edition->precio_promocional ?? $edition->precio) * $edition->pivot->cantidad, 2) }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botón Añadir al Carrito -->
                            <div class="flex-shrink-0 mt-6 md:mt-0 md:ml-6">
                                <button wire:click="addToCart({{ $edition->id }}, {{ $edition->pivot->cantidad }})"
                                    class="w-full md:w-auto px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
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
                <div class="border-t border-gray-200 pt-6 mb-8">
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-semibold text-gray-700">Total del Pedido:</span>
                        <span class="text-3xl font-bold text-gray-900">s/{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>

                <!-- Información Adicional -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Información del Cliente -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $order->user->name }} {{ $order->user->apellido }}</h3>
                        </div>

                        <div class="space-y-3 text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span class="text-gray-700">{{ $order->user->telefono ?: 'No especificado' }}</span>
                            </div>

                            @if($order->address)
                                <div class="flex items-start">
                                    <svg class="w-4 h-4 text-gray-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <div class="text-gray-700">
                                        <div>{{ $order->address->calle }}</div>
                                        @if($order->address->numero_piso || $order->address->numero_departamento)
                                            <div>{{ $order->address->numero_piso }} {{ $order->address->numero_departamento }}</div>
                                        @endif
                                        <div>{{ $order->address->distrito }}, {{ $order->address->provincia }}</div>
                                        <div>{{ $order->address->departamento }}</div>
                                        @if($order->address->referencia)
                                            <div class="text-gray-500 text-xs mt-1">{{ $order->address->referencia }}</div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Información del Pedido -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">N° de pedido: #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</h3>
                        </div>

                        <div class="space-y-3 text-sm">
                            <div>
                                <span class="font-medium text-gray-700">Pedido Realizado:</span>
                                <span class="text-gray-600 ml-2">{{ $order->fecha_orden ? $order->fecha_orden->format('d \d\e F, Y') : $order->created_at->format('d \d\e F, Y') }}</span>
                            </div>

                            @if($order->estado)
                                <div>
                                    <span class="font-medium text-gray-700">Envío completado:</span>
                                    <span class="text-gray-600 ml-2">{{ $order->updated_at->format('d \d\e F, Y') }}</span>
                                </div>

                                <div>
                                    <span class="font-medium text-gray-700">Pedido recibido:</span>
                                    <span class="text-gray-600 ml-2">{{ $order->updated_at->addDays(2)->format('d \d\e F, Y') }}</span>
                                </div>
                            @endif

                            @if($order->paymentType)
                                <div>
                                    <span class="font-medium text-gray-700">Método de pago:</span>
                                    <span class="text-gray-600 ml-2">{{ $order->paymentType->nombre }}</span>
                                </div>
                            @endif

                            @if($order->shipmentType)
                                <div>
                                    <span class="font-medium text-gray-700">Tipo de envío:</span>
                                    <span class="text-gray-600 ml-2">{{ $order->shipmentType->nombre }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Error: Pedido no encontrado -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <div class="mx-auto w-24 h-24 bg-gradient-to-br from-red-400 to-red-600 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Pedido no encontrado</h3>
                <p class="text-gray-600 mb-6">El pedido que buscas no existe o no tienes permisos para verlo.</p>
                <a href="{{ route('profile.pedidos') }}"
                   class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver a Mis Pedidos
                </a>
            </div>
        @endif
    </div>
</div>
