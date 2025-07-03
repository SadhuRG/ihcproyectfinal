<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pulsar</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    @vite(['resources/css/app.css', 'resources/css/dashboard-modern.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    @livewire('dashboard-stats-modern')

    @livewireScripts
    @stack('scripts')

    <script>
        // --- MANEJO DE SECCIONES ---
        function showSection(sectionId) {
            // Ocultar todas las secciones
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.add('hidden');
            });

            // Mostrar la sección seleccionada
            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.classList.remove('hidden');
            }

            // Actualizar estilos de los botones del sidebar
            document.querySelectorAll('.nav-button').forEach(button => {
                if (button.getAttribute('data-section') === sectionId) {
                    button.classList.add('bg-white/10'); // Estilo activo
                    button.classList.remove('text-white/80', 'hover:text-white', 'hover:bg-white/10');
                } else {
                    button.classList.remove('bg-white/10'); // Estilo inactivo
                    button.classList.add('text-white/80', 'hover:text-white', 'hover:bg-white/10');
                }
            });
        }

        // --- MANEJO DEL TEMA OSCURO ---
        function toggleTheme() {
            const body = document.body;
            const isDark = body.classList.contains('dark');
            
            // Toggle theme
            body.classList.toggle('dark');
            localStorage.setItem('theme', body.classList.contains('dark') ? 'dark' : 'light');
            
            // Update toggle animations for both headers
            updateThemeToggle(!isDark);
            
            // Dispatch theme change event
            window.dispatchEvent(new CustomEvent('theme-changed'));
        }

        // Theme toggle animation function for both headers
        function updateThemeToggle(isDark) {
            // Update main header toggle
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

            // Update dashboard header toggle
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

        function loadTheme() {
            const isDark = localStorage.getItem('theme') === 'dark';
            if (isDark) {
                document.body.classList.add('dark');
            }
            
            // Initialize toggle state
            updateThemeToggle(isDark);
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadTheme();
            // Mostrar la sección del dashboard por defecto al cargar la página
            showSection('dashboard-content');
        });
    </script>
</body>
</html>
