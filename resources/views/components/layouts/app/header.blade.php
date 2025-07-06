<!-- resources\views\components\layouts\app\header.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulsar - Header Mejorado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script> <!-- Alpine.js cargado -->

    <!-- CSS para el carrito -->
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50">

<header class="w-full bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 shadow-md fixed top-0 z-50">
    <div class="container mx-auto flex justify-between items-center px-4 py-3">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
            <img src="/imagenes/LOGO.jpg" alt="Pulsar Logo" class="w-10 h-10 rounded-full shadow transition-transform duration-300 group-hover:scale-110 group-hover:rotate-2">
            <span class="text-white text-2xl font-bold hidden md:block group-hover:text-indigo-100 transition-colors duration-300">Pulsar</span>
        </a>

        <!-- Search Bar -->
        <div class="flex-1 mx-4 max-w-md relative hidden md:block">
            <input type="text" placeholder="Buscar libro..."
                   class="w-full px-4 py-2 pl-10 rounded-full bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-300 shadow hover:shadow-md transition-all duration-300">
            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

        <!-- Right Actions -->
        <div class="flex items-center space-x-4">

            <!-- Botón tamaño de fuente -->
            <button id="font-size-btn" class="text-white px-3 py-1 rounded-full bg-white/20 hover:bg-white/30 transition-all font-bold hover:scale-105" title="Ajustar tamaño de letra" aria-label="Cambiar tamaño de fuente">
                <span id="font-size-label">A</span>
            </button>

            @guest
                <a href="{{ route('register') }}" class="text-white font-medium transition-all duration-300 hover:scale-105 hover:text-indigo-200 px-2 py-1 rounded hover:bg-white/10">
                    Registrar
                </a>
                <a href="{{ route('login') }}" class="text-white font-medium transition-all duration-300 hover:scale-105 hover:text-indigo-200 px-2 py-1 rounded hover:bg-white/10">
                    Iniciar sesión
                </a>
            @else
                <!-- Menú desplegable de usuario -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center space-x-2 text-white font-medium hover:text-indigo-200 transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 transform transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95">

                        <div class="px-4 py-2 text-sm text-gray-700 font-semibold">Hola, {{ Auth::user()->name }}</div>

                        <a href="{{ route('user-profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Mi Perfil
                        </a>
                        <a href="{{ route('profile.pedidos') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Mis Pedidos
                        </a>
                        <a href="{{ route('profile.deseos') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Lista de Deseos
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            @endguest

            <!-- Componente Carrito de Compras -->
            @livewire('shopping-cart')

            <!-- Botón menú móvil -->
            <button id="mobile-menu-btn" class="md:hidden p-2 bg-white/20 hover:bg-white/30 text-white rounded-full transition-all hover:scale-105" aria-label="Abrir menú">
                <svg id="menu-icon" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg id="close-icon" class="w-5 h-5 transition-transform duration-300 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="hidden absolute top-full left-0 right-0 bg-white/95 backdrop-blur-sm shadow-lg rounded-b-2xl md:hidden transition-all duration-300" id="mobile-menu">
        <div class="p-4 space-y-3">
            <input type="text" placeholder="Buscar libro..."
                   class="w-full px-4 py-2 pl-10 rounded-full bg-gray-100 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-300 shadow">
            <div class="absolute left-7 top-6 text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            @guest
                <a href="{{ route('register') }}" class="block w-full text-center py-3 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-all shadow-md hover:shadow-lg">Registrar</a>
                <a href="{{ route('login') }}" class="block w-full text-center py-3 bg-white text-indigo-600 rounded-full hover:bg-gray-50 transition-all border border-indigo-200 shadow-md">Iniciar sesión</a>
            @else
                <a href="{{ route('user-profile') }}" class="block w-full text-center py-3 bg-white text-indigo-600 rounded-full hover:bg-gray-50 transition-all border border-indigo-200 shadow-md">Mi Perfil</a>
                @if(auth()->user()->hasAnyRole(['superadministrador', 'administrador', 'colaborador']))
                    <a href="{{ route('dashboard') }}" class="block w-full text-center py-3 bg-white text-indigo-600 rounded-full hover:bg-gray-50 transition-all border border-indigo-200 shadow-md">Dashboard</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-center py-3 bg-rose-500 text-white rounded-full hover:bg-rose-600 transition-all shadow-md hover:shadow-lg">Cerrar sesión</button>
                </form>
            @endguest
        </div>
    </div>
</header>
