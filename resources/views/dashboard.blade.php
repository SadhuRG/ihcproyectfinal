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
            body.classList.toggle('dark');
            localStorage.setItem('theme', body.classList.contains('dark') ? 'dark' : 'light');
            window.dispatchEvent(new CustomEvent('theme-changed'));
        }

        function loadTheme() {
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark');
                const icon = document.getElementById('theme-icon');
                if (icon) {
                    icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>`;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadTheme();
            // Mostrar la sección del dashboard por defecto al cargar la página
            showSection('dashboard-content');
        });
    </script>
</body>
</html>
