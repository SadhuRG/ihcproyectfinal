<!-- resources\views\components\layouts\app\header.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Librería Pulsar</title>
    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {}
            }
        }
    </script>
    <!-- CSS para el carrito -->
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    <style>
        :root {
            /* Variables para modo claro */
            --bg-primary: linear-gradient(to bottom right, #F1F5F9, #DBEAFE);
            --bg-header: linear-gradient(to right, #4F46E5, #7C3AED, #4F46E5);
            --text-primary: #1F2937;
            --card-bg: #FFFFFF;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --button-bg: #7C3AED;
            --button-text: #FFFFFF;
            --accent: #7C3AED;
        }

        .dark {
            /* Variables para modo oscuro */
            --bg-primary: linear-gradient(to bottom right, #1F2937, #374151);
            --bg-header: linear-gradient(to right, #1E3A8A, #5B21B6, #1E3A8A);
            --text-primary: #F3F4F6;
            --card-bg: #374151;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
            --button-bg: #A78BFA;
            --button-text: #1F2937;
            --accent: #A78BFA;
        }

        body {
            background: var(--bg-primary);
            color: var(--text-primary);
            transition: background 0.3s ease, color 0.3s ease;
        }

        .bg-header {
            background: var(--bg-header);
        }

        .card {
            background: var(--card-bg);
            box-shadow: var(--card-shadow);
        }

        .btn-primary {
            background: var(--button-bg);
            color: var(--button-text);
        }

        .text-accent {
            color: var(--accent);
        }
    </style>
</head>

<body class="min-h-screen">

    <!-- ENCABEZADO -->
    <div class="w-full p-4 bg-header shadow-xl flex items-center fixed top-0 z-50">
        <!-- Sección del Logo -->
        <div class="w-1/4 flex items-center justify-start">
            <a href="{{ url('/') }}" class="flex items-center space-x-3">
                <img src="/imagenes/LOGO.jpg" alt="Pulsar - Logo" class="w-12 h-12 rounded-full shadow-lg transition-transform duration-300 hover:scale-110">
                <span class="text-white text-2xl font-bold tracking-wide hidden md:block">Pulsar</span>
            </a>
        </div>

        <!-- Sección de Búsqueda -->
        <div class="w-2/4 flex items-center justify-center px-4">
            <div class="relative w-full max-w-md">
                <input type="text"
                       placeholder="Buscar libro..."
                       class="w-full px-4 py-3 pl-12 bg-white dark:bg-gray-800 backdrop-blur-sm border-0 rounded-full text-gray-700 dark:text-gray-200 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-300 shadow-lg"
                       style="background-color: white;">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-indigo-600 dark:bg-indigo-500 hover:bg-indigo-700 dark:hover:bg-indigo-600 text-white p-2 rounded-full transition-all duration-300 hover:scale-110">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Sección de Navegación -->
        <div class="w-1/4 flex items-center justify-end space-x-3">
            
            <!-- Botón tamaño de fuente -->
            <button id="font-size-btn" class="text-white px-3 py-1 rounded-full bg-white/20 hover:bg-white/30 transition-all font-bold hover:scale-105" title="Ajustar tamaño de letra" aria-label="Cambiar tamaño de fuente">
                <span id="font-size-label">A</span>
            </button>
            <!-- Interruptor de Tema -->
            <div class="theme-toggle-container hidden md:block flex items-center space-x-2">
                <div class="flex items-center space-x-2">
                    <div id="theme-icon-container" class="w-8 h-8">
                        <svg id="sun-icon" class="w-8 h-8 text-yellow-300 transition-all duration-300 absolute" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <svg id="moon-icon" class="w-8 h-8 text-blue-300 transition-all duration-300 absolute opacity-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </div>
                    <button id="theme-toggle" class="relative w-14 h-7 bg-white/20 backdrop-blur-sm rounded-full transition-all duration-300 hover:scale-110 flex items-center p-1" onclick="toggleTheme()">
                        <div id="toggle-circle" class="w-5 h-5 bg-white rounded-full shadow-lg transition-transform duration-300 transform translate-x-0"></div>
                    </button>
                </div>
            </div>

            @guest
                <x-auth.register-button />
                <x-auth.login-button />
            @else
                <x-auth.user-menu />
            @endguest

            <!-- Componente Carrito de Compras -->
            @livewire('shopping-cart')
            <!-- Botón de Menú Móvil -->
            <button id="mobile-menu-btn" class="md:hidden p-2 bg-white/20 dark:bg-gray-800/20 backdrop-blur-sm hover:bg-white/30 dark:hover:bg-gray-800/30 text-white rounded-full transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg id="close-icon" class="w-5 h-5 transition-transform duration-300 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    
        <!-- Menú Móvil -->
        <div class="hidden absolute top-full left-0 right-0 bg-white/95 dark:bg-gray-800/95 backdrop-blur-md shadow-xl rounded-b-2xl md:hidden transition-all duration-300" id="mobile-menu">
            <div class="p-4 space-y-3">
                @guest
                    <a href="{{ route('register') }}"
                        class="block w-full px-4 py-3 text-center font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/50 hover:bg-indigo-100 dark:hover:bg-indigo-900 rounded-xl transition-all duration-300">
                        Crear Cuenta
                    </a>
                    <a href="{{ route('login') }}"
                        class="block w-full px-4 py-3 text-center font-medium text-white bg-indigo-600 dark:bg-indigo-500 hover:bg-indigo-700 dark:hover:bg-indigo-600 rounded-xl transition-all duration-300">
                        Iniciar Sesión
                    </a>
                @else
                    <a href="{{ route('user-profile') }}"
                        class="block w-full px-4 py-3 text-center font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/50 hover:bg-indigo-100 dark:hover:bg-indigo-900 rounded-xl transition-all duration-300">
                        Mi Perfil
                    </a>
                    @if(auth()->user()->hasAnyRole(['superadministrador', 'administrador', 'colaborador']))
                        <a href="{{ route('dashboard') }}"
                            class="block w-full px-4 py-3 text-center font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/50 hover:bg-indigo-100 dark:hover:bg-indigo-900 rounded-xl transition-all duration-300">
                            Dashboard
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full px-4 py-3 text-center font-medium text-white bg-indigo-600 dark:bg-indigo-500 hover:bg-indigo-700 dark:hover:bg-indigo-600 rounded-xl transition-all duration-300">
                            Cerrar Sesión
                        </button>
                    </form>
                @endguest
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
    
    <!-- FIN ENCABEZADO -->

    <script>
        // Alternar menú móvil
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Función de animación para el interruptor de tema
        function updateThemeToggle(isDark) {
            const toggleCircle = document.getElementById('toggle-circle');
            const sunIcon = document.getElementById('sun-icon');
            const moonIcon = document.getElementById('moon-icon');
            
            if (toggleCircle && sunIcon && moonIcon) {
                if (isDark) {
                    toggleCircle.style.transform = 'translateX(1.75rem)';
                    sunIcon.style.opacity = '0';
                    moonIcon.style.opacity = '1';
                } else {
                    toggleCircle.style.transform = 'translateX(0)';
                    sunIcon.style.opacity = '1';
                    moonIcon.style.opacity = '0';
                }
            }
        }

        // Función global para alternar tema
        function toggleTheme() {
            const body = document.body;
            const isDark = body.classList.contains('dark');
            const searchInput = document.querySelector('input[placeholder="Buscar libro..."]');
            
            body.classList.toggle('dark');
            localStorage.setItem('theme', body.classList.contains('dark') ? 'dark' : 'light');
            
            // Actualizar el fondo de la barra de búsqueda
            if (searchInput) {
                if (body.classList.contains('dark')) {
                    searchInput.style.backgroundColor = '#1f2937'; // gray-800
                } else {
                    searchInput.style.backgroundColor = 'white';
                }
            }
            
            updateThemeToggle(!isDark);
            
            window.dispatchEvent(new CustomEvent('theme-changed'));
        }

        // Cargar tema al cargar la página
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = savedTheme ? savedTheme === 'dark' : prefersDark;
            const searchInput = document.querySelector('input[placeholder="Buscar libro..."]');
            
            if (isDark) {
                document.body.classList.add('dark');
                if (searchInput) {
                    searchInput.style.backgroundColor = '#1f2937'; // gray-800
                }
            } else {
                document.body.classList.remove('dark');
                if (searchInput) {
                    searchInput.style.backgroundColor = 'white';
                }
            }
            updateThemeToggle(isDark);
        });

        // Escuchar cambios en el tema del sistema
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!localStorage.getItem('theme')) {
                document.body.classList.toggle('dark', e.matches);
                updateThemeToggle(e.matches);
            }
        });
    </script>

    {{ $slot }}

</body>
</html>
