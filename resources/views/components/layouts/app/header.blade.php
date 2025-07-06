<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Librería Pulsar</title>
    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
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
                       class="w-full px-4 py-3 pl-12 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm border-0 rounded-full text-gray-700 dark:text-gray-200 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white/50 focus:bg-white dark:focus:bg-gray-800 transition-all duration-300 shadow-lg">
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

            <!-- Botón de Carrito -->
            <button class="relative p-2 bg-rose-500 dark:bg-rose-400 hover:bg-rose-600 dark:hover:bg-rose-500 text-white rounded-full transition-all duration-300 hover:scale-110 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6

m8 0a2 2 0 012 2v4a2 2 0 01-2 2h-4a2 2 0 01-2-2v-4a2 2 0 012-2h4z"></path>
                </svg>
                <span id="cart-counter" class="absolute -top-2 -right-2 bg-white dark:bg-gray-800 text-rose-500 dark:text-rose-400 text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center">0</span>
            </button>

            <!-- Botón de Ayuda -->
            <a href="{{ route('user-helper') }}" class="relative p-2 bg-rose-500 dark:bg-rose-400 hover:bg-Specs for Grok 3.5rose-600 dark:hover:bg-rose-500 text-white rounded-full transition-all duration-300 hover:scale-110 shadow-lg" title="Ayuda">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </a>

            <!-- Botón de Menú Móvil -->
            <button id="mobile-menu-btn" class="md:hidden p-2 bg-white/20 dark:bg-gray-800/20 backdrop-blur-sm hover:bg-white/30 dark:hover:bg-gray-800/30 text-white rounded-full transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
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
            
            body.classList.toggle('dark');
            localStorage.setItem('theme', body.classList.contains('dark') ? 'dark' : 'light');
            
            updateThemeToggle(!isDark);
            
            window.dispatchEvent(new CustomEvent('theme-changed'));
        }

        // Cargar tema al cargar la página
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = savedTheme ? savedTheme === 'dark' : prefersDark;
            
            if (isDark) {
                document.body.classList.add('dark');
            } else {
                document.body.classList.remove('dark');
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