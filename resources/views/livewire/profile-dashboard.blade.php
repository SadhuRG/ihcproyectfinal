<div class="min-h-screen bg-gradient-to-br from-indigo-50 pt-2 via-white to-purple-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">MI PERFIL</h1>
                    <p class="mt-1 text-sm text-gray-600">Resumen de tu cuenta y configuraciones</p>
                </div>
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('welcome') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                        ← Volver al inicio
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
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Navegación Rápida</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <!-- Mi Cuenta - Activo -->
                <a href="{{ route('profile.dashboard') }}"
                   class="flex flex-col items-center p-4 bg-indigo-50 border-2 border-indigo-200 rounded-lg hover:bg-indigo-100 transition-colors duration-200">
                    <svg class="w-8 h-8 text-indigo-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-sm font-medium text-indigo-900">Mi Cuenta</span>
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

        <!-- Contenido Principal - Resumen -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Mis Datos -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">Mis Datos</h3>
                    <a href="{{ route('profile.datos') }}"
                       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        ✏️ Editar
                    </a>
                </div>

                <!-- Información Personal -->
                <div class="space-y-4">
                    <!-- Foto y Nombre -->
                    <div class="flex items-center space-x-4">
                        @if($user->url_foto)
                            <img src="{{ Storage::url($user->url_foto) }}" alt="Foto de perfil"
                                 class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg">
                        @else
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xl font-bold shadow-lg">
                                {{ substr($user->name ?: 'U', 0, 1) }}{{ substr($user->apellido ?: 'U', 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h4 class="text-lg font-medium text-gray-900">{{ $user->name }} {{ $user->apellido }}</h4>
                            <p class="text-sm text-gray-600">{{ $user->email }}</p>
                        </div>
                    </div>

                    <!-- Datos adicionales -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Apellidos</label>
                            <p class="text-gray-900">{{ $user->apellido ?: 'No especificado' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Fecha de Nacimiento</label>
                            <p class="text-gray-900">{{ $user->fecha_n ? $user->fecha_n->format('d/m/Y') : 'No especificada' }}</p>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="text-sm font-medium text-gray-500">Teléfono</label>
                            <p class="text-gray-900">{{ $user->telefono ?: 'No especificado' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mis Direcciones -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">Mis Direcciones</h3>
                    <a href="{{ route('profile.direcciones') }}"
                       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        ✏️ Gestionar
                    </a>
                </div>

                @if($userStats['addressesCount'] > 0 && $userStats['primaryAddress'])
                    <!-- Dirección Principal -->
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-lg font-medium text-gray-900">Dirección Principal</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ $userStats['primaryAddress']->referencia ?: 'Dirección de envío' }}</p>
                        </div>

                        <div class="space-y-2 text-sm">
                            <p><strong>Calle:</strong> {{ $userStats['primaryAddress']->calle ?: 'No especificada' }}</p>
                            <p><strong>Distrito:</strong> {{ $userStats['primaryAddress']->distrito ?: 'No especificado' }}</p>
                            <p><strong>Provincia:</strong> {{ $userStats['primaryAddress']->provincia ?: 'No especificada' }}</p>
                            <p><strong>Departamento:</strong> {{ $userStats['primaryAddress']->departamento ?: 'No especificado' }}</p>
                        </div>

                        @if($userStats['addressesCount'] > 1)
                            <p class="text-sm text-indigo-600 mt-4">+ {{ $userStats['addressesCount'] - 1 }} dirección(es) más</p>
                        @endif
                    </div>
                @else
                    <!-- Sin direcciones -->
                    <div class="text-center py-8">
                        <div class="mx-auto w-16 h-16 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Sin direcciones</h3>
                        <p class="text-gray-600 mb-4">Agrega tu primera dirección</p>
                        <a href="{{ route('profile.direcciones') }}"
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Agregar Dirección
                        </a>
                    </div>
                @endif
            </div>

            <!-- Mis Pedidos -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">Mis Pedidos</h3>
                    <a href="{{ route('profile.pedidos') }}"
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        📦 Ver Todos
                    </a>
                </div>

                @if($userStats['recentOrders']->count() > 0)
                    <!-- Pedidos Recientes -->
                    <div class="space-y-4">
                        @foreach($userStats['recentOrders'] as $order)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        @if($order->estado)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                ✓ Finalizado
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                ⏱ Pendiente
                                            </span>
                                        @endif
                                    </div>
                                    <span class="text-sm text-gray-600">{{ $order->fecha_orden ? $order->fecha_orden->format('d/m/Y') : $order->created_at->format('d/m/Y') }}</span>
                                </div>

                                <div class="space-y-1">
                                    @foreach($order->editions->take(2) as $edition)
                                        <p class="text-sm text-gray-700">• {{ $edition->book->titulo }}</p>
                                    @endforeach
                                    @if($order->editions->count() > 2)
                                        <p class="text-sm text-gray-500">+ {{ $order->editions->count() - 2 }} libro(s) más</p>
                                    @endif
                                </div>

                                <div class="mt-2 text-right">
                                    <span class="text-lg font-bold text-gray-900">s/{{ number_format($order->total, 2) }}</span>
                                </div>
                            </div>
                        @endforeach

                        @if($userStats['ordersCount'] > 3)
                            <p class="text-sm text-green-600 mt-4 text-center">+ {{ $userStats['ordersCount'] - 3 }} pedido(s) más</p>
                        @endif
                    </div>
                @else
                    <!-- Sin pedidos -->
                    <div class="text-center py-8">
                        <div class="mx-auto w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Sin pedidos</h3>
                        <p class="text-gray-600 mb-4">Aún no has realizado compras</p>
                        <a href="{{ route('welcome') }}"
                           class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            Explorar Libros
                        </a>
                    </div>
                @endif
            </div>

            <!-- Lista de Deseos -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">Lista de Deseos</h3>
                    <a href="{{ route('profile.deseos') }}"
                       class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        ❤️ Ver Todos
                    </a>
                </div>

                @if($userStats['favoriteBooks']->count() > 0)
                    <!-- Libros Favoritos -->
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($userStats['favoriteBooks'] as $book)
                            @php
                                $edition = $book->editions->first();
                                $authors = $book->authors->pluck('nombre')->join(', ');
                            @endphp

                            <div class="border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow duration-200">
                                <!-- Imagen del libro -->
                                <div class="flex items-start space-x-3">
                                    @if($edition && $edition->url_portada && $edition->url_portada !== '/images/covers/default.jpg')
                                        <img src="{{ $edition->url_portada }}" alt="{{ $book->titulo }}"
                                             class="w-12 h-16 object-cover rounded shadow-sm">
                                    @else
                                        <div class="w-12 h-16 bg-gray-200 rounded flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">{{ Str::limit($book->titulo, 40) }}</h4>
                                        <p class="text-xs text-gray-600 mb-2">{{ Str::limit($authors, 30) }}</p>
                                        @if($edition)
                                            <p class="text-sm font-bold text-red-600">s/{{ number_format($edition->precio_promocional ?? $edition->precio, 2) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($userStats['favoriteBooksCount'] > 4)
                        <p class="text-sm text-red-600 mt-4 text-center">+ {{ $userStats['favoriteBooksCount'] - 4 }} libro(s) más</p>
                    @endif
                @else
                    <!-- Sin favoritos -->
                    <div class="text-center py-8">
                        <div class="mx-auto w-16 h-16 bg-gradient-to-br from-red-400 to-pink-600 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Sin favoritos</h3>
                        <p class="text-gray-600 mb-4">Guarda tus libros preferidos</p>
                        <a href="{{ route('welcome') }}"
                           class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            Descubrir Libros
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Estadísticas Rápidas -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Pedidos -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Pedidos realizados</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $userStats['ordersCount'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Libros favoritos -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Libros favoritos</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $userStats['favoriteBooksCount'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Comentarios -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Comentarios</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $userStats['commentsCount'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Direcciones -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Direcciones</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $userStats['addressesCount'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
