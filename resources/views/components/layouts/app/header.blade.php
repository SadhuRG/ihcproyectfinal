<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Librería Pulsar</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gradient-to-br from-slate-50 to-blue-100 min-h-screen">

    <!-- HEADER -->
    <div class="w-full p-4 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 shadow-xl flex items-center fixed top-0 z-50">

        <!-- Logo Section -->
        <div class="w-1/4 flex items-center justify-start">
            <a href="{{ url('/') }}" class="flex items-center space-x-3">
                <img src="/imagenes/LOGO.jpg" alt="Pulsar - Logo" class="w-12 h-12 rounded-full shadow-lg transition-transform duration-300 hover:scale-110">
                <span class="text-white text-2xl font-bold tracking-wide hidden md:block">Pulsar</span>
            </a>
        </div>

        <!-- Search Section -->
        <div class="w-2/4 flex items-center justify-center px-4">
            <div class="relative w-full max-w-md">
                <input type="text"
                       placeholder="Buscar libro..."
                       class="w-full px-4 py-3 pl-12 bg-white/90 backdrop-blur-sm border-0 rounded-full text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white/50 focus:bg-white transition-all duration-300 shadow-lg">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-indigo-600 hover:bg-indigo-700 text-white p-2 rounded-full transition-all duration-300 hover:scale-110">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Navigation Section -->
        <div class="w-1/4 flex items-center justify-end space-x-3">
            <!-- Theme Toggle -->
            <div class="theme-toggle-container hidden md:block flex items-center space-x-2">
                <!-- Dynamic Icon (Left) - Changes between Sun and Moon -->
                <div class="flex items-center space-x-2">
                    <div id="theme-icon-container" class="w-8 h-8">
                        <!-- Sun Icon -->
                        <svg id="sun-icon" class="w-8 h-8 text-yellow-300 transition-all duration-300 absolute" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <!-- Moon Icon -->
                        <svg id="moon-icon" class="w-8 h-8 text-blue-300 transition-all duration-300 absolute opacity-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </div>
                    <!-- Toggle Button -->
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

            <!-- Cart Button -->
            <button class="relative p-2 bg-rose-500 hover:bg-rose-600 text-white rounded-full transition-all duration-300 hover:scale-110 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0a2 2 0 012 2v4a2 2 0 01-2 2h-4a2 2 0 01-2-2v-4a2 2 0 012-2h4z"></path>
                </svg>
                <span id="cart-counter" class="absolute -top-2 -right-2 bg-white text-rose-500 text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center">0</span>
            </button>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden p-2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white rounded-full transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="hidden absolute top-full left-0 right-0 bg-white/95 backdrop-blur-md shadow-xl rounded-b-2xl md:hidden transition-all duration-300" id="mobile-menu">
            <div class="p-4 space-y-3">
                <a href="{{ route('register') }}"
                    class="block w-full px-4 py-3 text-center font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-all duration-300">
                    Crear Cuenta
                </a>
                <a href="{{ route('login') }}"
                    class="block w-full px-4 py-3 text-center font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl transition-all duration-300">
                    Iniciar Sesión
                </a>
            </div>
        </div>
    </div>
    <!-- FIN HEADER -->

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Theme toggle animation function
        function updateThemeToggle(isDark) {
            const toggleCircle = document.getElementById('toggle-circle');
            const sunIcon = document.getElementById('sun-icon');
            const moonIcon = document.getElementById('moon-icon');
            
            if (toggleCircle && sunIcon && moonIcon) {
                if (isDark) {
                    // Dark mode - move circle to right, show moon
                    toggleCircle.style.transform = 'translateX(1.75rem)';
                    sunIcon.style.opacity = '0';
                    moonIcon.style.opacity = '1';
                } else {
                    // Light mode - move circle to left, show sun
                    toggleCircle.style.transform = 'translateX(0)';
                    sunIcon.style.opacity = '1';
                    moonIcon.style.opacity = '0';
                }
            }

            // Update dashboard header toggle if it exists
            const toggleCircleDashboard = document.getElementById('toggle-circle-dashboard');
            const sunIconDashboard = document.getElementById('sun-icon-dashboard');
            const moonIconDashboard = document.getElementById('moon-icon-dashboard');
            
            if (toggleCircleDashboard && sunIconDashboard && moonIconDashboard) {
                if (isDark) {
                    // Dark mode - move circle to right, show moon
                    toggleCircleDashboard.style.transform = 'translateX(1.75rem)';
                    sunIconDashboard.style.opacity = '0';
                    moonIconDashboard.style.opacity = '1';
                } else {
                    // Light mode - move circle to left, show sun
                    toggleCircleDashboard.style.transform = 'translateX(0)';
                    sunIconDashboard.style.opacity = '1';
                    moonIconDashboard.style.opacity = '0';
                }
            }
        }

        // Initialize theme toggle state
        const isDarkMode = document.body.classList.contains('dark');
        updateThemeToggle(isDarkMode);

        // Listen for theme changes
        window.addEventListener('theme-changed', () => {
            const isDark = document.body.classList.contains('dark');
            updateThemeToggle(isDark);
        });

        // Global toggleTheme function
        function toggleTheme() {
            const body = document.body;
            const isDark = body.classList.contains('dark');
            
            // Toggle theme
            body.classList.toggle('dark');
            localStorage.setItem('theme', body.classList.contains('dark') ? 'dark' : 'light');
            
            // Update toggle animations
            updateThemeToggle(!isDark);
            
            // Dispatch theme change event
            window.dispatchEvent(new CustomEvent('theme-changed'));
        }

        // Load theme on page load
        document.addEventListener('DOMContentLoaded', () => {
            const isDark = localStorage.getItem('theme') === 'dark';
            if (isDark) {
                document.body.classList.add('dark');
            }
            updateThemeToggle(isDark);
        });
    </script>

    {{ $slot }}

</body>
</html>
