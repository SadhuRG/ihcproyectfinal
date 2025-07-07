<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuda Administrativa - Pulsar</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        :root {
            --bg-primary: linear-gradient(to bottom right, #F1F5F9, #DBEAFE);
            --bg-header: linear-gradient(to right, #4F46E5, #7C3AED, #4F46E5);
            --text-primary: #1F2937;
            --card-bg: #FFFFFF;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .dark {
            --bg-primary: linear-gradient(to bottom right, #1F2937, #374151);
            --bg-header: linear-gradient(to right, #1E3A8A, #5B21B6, #1E3A8A);
            --text-primary: #F3F4F6;
            --card-bg: #374151;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
        }

        body {
            background: var(--bg-primary);
            color: var(--text-primary);
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* Forzar colores de Tailwind */
        .text-black {
            color: #000000 !important;
        }
        
        .dark .text-white {
            color: #ffffff !important;
        }
        
        .hover\:bg-blue-200:hover {
            background-color: #bfdbfe !important;
        }

        /* Forzar todos los textos a negro */
        h1, h2, h3, h4, h5, h6, p, span, div, button {
            color: #000000 !important;
        }
        
        /* En modo oscuro, textos blancos */
        .dark h1, .dark h2, .dark h3, .dark h4, .dark h5, .dark h6, .dark p, .dark span, .dark div, .dark button {
            color: #ffffff !important;
        }
        
        /* Excepciones para elementos específicos que deben mantener sus colores */
        .bg-blue-50 h4, .bg-green-50 h4, .bg-purple-50 h4, .bg-orange-50 h4, .bg-indigo-50 h4, .bg-red-50 h4, .bg-teal-50 h4,
        .bg-blue-50 ul, .bg-green-50 ul, .bg-purple-50 ul, .bg-orange-50 ul, .bg-indigo-50 ul, .bg-red-50 ul, .bg-teal-50 ul,
        .bg-yellow-50 h4, .bg-yellow-50 ul {
            color: inherit !important;
        }
        
        .dark .bg-blue-900\/20 h4, .dark .bg-green-900\/20 h4, .dark .bg-purple-900\/20 h4, .dark .bg-orange-900\/20 h4, .dark .bg-indigo-900\/20 h4, .dark .bg-red-900\/20 h4, .dark .bg-teal-900\/20 h4,
        .dark .bg-blue-900\/20 ul, .dark .bg-green-900\/20 ul, .dark .bg-purple-900\/20 ul, .dark .bg-orange-900\/20 ul, .dark .bg-indigo-900\/20 ul, .dark .bg-red-900\/20 ul, .dark .bg-teal-900\/20 ul,
        .dark .bg-yellow-900\/20 h4, .dark .bg-yellow-900\/20 ul {
            color: inherit !important;
        }

        .bg-header {
            background: var(--bg-header);
        }

        .card {
            background: var(--card-bg);
            box-shadow: var(--card-shadow);
        }
    </style>
</head>

<body class="min-h-screen">
    <!-- Header -->
    <div class="w-full p-4 bg-header shadow-xl flex items-center fixed top-0 z-50">
        <div class="w-1/4 flex items-center justify-start">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                <img src="/imagenes/LOGO.jpg" alt="Pulsar - Logo" class="w-12 h-12 rounded-full shadow-lg">
                <div>
                    <span class="text-white text-2xl font-bold tracking-wide">Pulsar</span>
                    <p class="text-white/80 text-sm">Centro de Ayuda</p>
                </div>
            </a>
        </div>
        <div class="w-3/4 flex items-center justify-end space-x-3">
            <a href="{{ route('dashboard') }}" class="text-white px-4 py-2 bg-white/20 hover:bg-white/30 rounded-full transition-all">
                Volver al Dashboard
            </a>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="pt-24 px-6 pb-6">
        <div class="max-w-4xl mx-auto">
            <!-- Título Principal -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold mb-4 text-black dark:text-white">
                    Centro de Ayuda Administrativa
                </h1>
                <p class="text-lg opacity-80 text-black dark:text-white">
                    Guía completa de todas las funcionalidades disponibles para administradores
                </p>
            </div>

            <!-- Secciones de Ayuda -->
            <div class="space-y-6">
                <!-- Dashboard -->
                <div x-data="{ open: false }" class="card rounded-2xl overflow-hidden">
                    <button @click="open = !open" class="w-full p-6 text-left flex items-center justify-between hover:bg-blue-200 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-black dark:text-white">Dashboard</h3>
                                <p class="text-sm opacity-70 text-black dark:text-white">Vista general y estadísticas del sistema</p>
                            </div>
                        </div>
                        <svg class="w-6 h-6 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="space-y-4">
                            <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl">
                                <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-2">¿Qué puedes hacer?</h4>
                                <ul class="space-y-2 text-sm text-blue-700 dark:text-blue-200">
                                    <li>• Ver estadísticas de ventas diarias y mensuales</li>
                                    <li>• Monitorear el total de libros vendidos</li>
                                    <li>• Revisar el número total de usuarios registrados</li>
                                    <li>• Verificar el stock total disponible</li>
                                    <li>• Analizar las categorías más populares</li>
                                    <li>• Revisar las últimas órdenes realizadas</li>
                                    <li>• Identificar los libros más vendidos</li>
                                </ul>
                            </div>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-xl">
                                <h4 class="font-semibold text-yellow-800 dark:text-yellow-300 mb-2">Limitaciones</h4>
                                <ul class="space-y-2 text-sm text-yellow-700 dark:text-yellow-200">
                                    <li>• No puedes modificar datos directamente desde el dashboard</li>
                                    <li>• Las estadísticas se actualizan automáticamente</li>
                                    <li>• Solo puedes visualizar información, no editarla</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gestión de Libros -->
                <div x-data="{ open: false }" class="card rounded-2xl overflow-hidden">
                    <button @click="open = !open" class="w-full p-6 text-left flex items-center justify-between hover:bg-blue-200 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-black dark:text-white">Gestión de Libros</h3>
                                <p class="text-sm opacity-70 text-black dark:text-white">Administrar el catálogo de libros</p>
                            </div>
                        </div>
                        <svg class="w-6 h-6 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="space-y-4">
                            <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-xl">
                                <h4 class="font-semibold text-green-800 dark:text-green-300 mb-2">¿Qué puedes hacer?</h4>
                                <ul class="space-y-2 text-sm text-green-700 dark:text-green-200">
                                    <li>• Agregar nuevos libros al catálogo</li>
                                    <li>• Editar información de libros existentes</li>
                                    <li>• Asignar autores a los libros</li>
                                    <li>• Categorizar libros por género</li>
                                    <li>• Subir imágenes de portada</li>
                                    <li>• Gestionar descripciones y detalles</li>
                                    <li>• Eliminar libros del sistema (soft delete)</li>
                                </ul>
                            </div>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-xl">
                                <h4 class="font-semibold text-yellow-800 dark:text-yellow-300 mb-2">Limitaciones</h4>
                                <ul class="space-y-2 text-sm text-yellow-700 dark:text-yellow-200">
                                    <li>• No puedes eliminar libros que tengan ediciones asociadas</li>
                                    <li>• Las imágenes deben cumplir con formatos específicos</li>
                                    <li>• Los cambios se reflejan inmediatamente en el catálogo</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gestión de Ediciones -->
                <div x-data="{ open: false }" class="card rounded-2xl overflow-hidden">
                    <button @click="open = !open" class="w-full p-6 text-left flex items-center justify-between hover:bg-blue-200 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-black dark:text-white">Gestión de Ediciones</h3>
                                <p class="text-sm opacity-70 text-black dark:text-white">Administrar diferentes ediciones de libros</p>
                            </div>
                        </div>
                        <svg class="w-6 h-6 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="space-y-4">
                            <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-xl">
                                <h4 class="font-semibold text-purple-800 dark:text-purple-300 mb-2">¿Qué puedes hacer?</h4>
                                <ul class="space-y-2 text-sm text-purple-700 dark:text-purple-200">
                                    <li>• Crear nuevas ediciones para libros existentes</li>
                                    <li>• Establecer precios para cada edición</li>
                                    <li>• Asignar editoriales a las ediciones</li>
                                    <li>• Gestionar inventario por edición</li>
                                    <li>• Configurar precios promocionales</li>
                                    <li>• Editar información de ediciones</li>
                                    <li>• Eliminar ediciones (si no tienen pedidos)</li>
                                </ul>
                            </div>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-xl">
                                <h4 class="font-semibold text-yellow-800 dark:text-yellow-300 mb-2">Limitaciones</h4>
                                <ul class="space-y-2 text-sm text-yellow-700 dark:text-yellow-200">
                                    <li>• No puedes eliminar ediciones con pedidos asociados</li>
                                    <li>• Los precios deben ser valores positivos</li>
                                    <li>• Cada edición debe tener un libro padre</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gestión de Pedidos -->
                <div x-data="{ open: false }" class="card rounded-2xl overflow-hidden">
                    <button @click="open = !open" class="w-full p-6 text-left flex items-center justify-between hover:bg-blue-200 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-black dark:text-white">Gestión de Pedidos</h3>
                                <p class="text-sm opacity-70 text-black dark:text-white">Administrar órdenes de clientes</p>
                            </div>
                        </div>
                        <svg class="w-6 h-6 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="space-y-4">
                            <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-xl">
                                <h4 class="font-semibold text-orange-800 dark:text-orange-300 mb-2">¿Qué puedes hacer?</h4>
                                <ul class="space-y-2 text-sm text-orange-700 dark:text-orange-200">
                                    <li>• Ver todos los pedidos realizados</li>
                                    <li>• Cambiar el estado de los pedidos</li>
                                    <li>• Ver detalles completos de cada pedido</li>
                                    <li>• Identificar pedidos pendientes</li>
                                    <li>• Gestionar pedidos completados</li>
                                    <li>• Ver información del cliente</li>
                                    <li>• Cancelar pedidos si es necesario</li>
                                </ul>
                            </div>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-xl">
                                <h4 class="font-semibold text-yellow-800 dark:text-yellow-300 mb-2">Limitaciones</h4>
                                <ul class="space-y-2 text-sm text-yellow-700 dark:text-yellow-200">
                                    <li>• No puedes modificar el contenido de pedidos confirmados</li>
                                    <li>• Los cambios de estado se registran automáticamente</li>
                                    <li>• No puedes crear pedidos manualmente</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gestión de Usuarios -->
                <div x-data="{ open: false }" class="card rounded-2xl overflow-hidden">
                    <button @click="open = !open" class="w-full p-6 text-left flex items-center justify-between hover:bg-blue-200 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-black dark:text-white">Gestión de Usuarios</h3>
                                <p class="text-sm opacity-70 text-black dark:text-white">Administrar cuentas de usuarios</p>
                            </div>
                        </div>
                        <svg class="w-6 h-6 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="space-y-4">
                            <div class="bg-indigo-50 dark:bg-indigo-900/20 p-4 rounded-xl">
                                <h4 class="font-semibold text-indigo-800 dark:text-indigo-300 mb-2">¿Qué puedes hacer?</h4>
                                <ul class="space-y-2 text-sm text-indigo-700 dark:text-indigo-200">
                                    <li>• Ver todos los usuarios registrados</li>
                                    <li>• Asignar roles a los usuarios</li>
                                    <li>• Activar/desactivar cuentas</li>
                                    <li>• Ver historial de pedidos por usuario</li>
                                    <li>• Gestionar permisos de acceso</li>
                                    <li>• Ver información de contacto</li>
                                    <li>• Eliminar usuarios (si no tienen pedidos)</li>
                                </ul>
                            </div>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-xl">
                                <h4 class="font-semibold text-yellow-800 dark:text-yellow-300 mb-2">Limitaciones</h4>
                                <ul class="space-y-2 text-sm text-yellow-700 dark:text-yellow-200">
                                    <li>• No puedes cambiar contraseñas de usuarios</li>
                                    <li>• No puedes eliminar usuarios con pedidos activos</li>
                                    <li>• Los cambios de rol requieren permisos específicos</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Soporte de Usuario -->
                <div x-data="{ open: false }" class="card rounded-2xl overflow-hidden">
                    <button @click="open = !open" class="w-full p-6 text-left flex items-center justify-between hover:bg-blue-200 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 109.75 9.75A9.75 9.75 0 0012 2.25z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-black dark:text-white">Soporte de Usuario</h3>
                                <p class="text-sm opacity-70 text-black dark:text-white">Gestionar tickets de soporte</p>
                            </div>
                        </div>
                        <svg class="w-6 h-6 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="space-y-4">
                            <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-xl">
                                <h4 class="font-semibold text-red-800 dark:text-red-300 mb-2">¿Qué puedes hacer?</h4>
                                <ul class="space-y-2 text-sm text-red-700 dark:text-red-200">
                                    <li>• Ver todos los tickets de soporte</li>
                                    <li>• Responder a consultas de usuarios</li>
                                    <li>• Cambiar el estado de los tickets</li>
                                    <li>• Asignar prioridades a los tickets</li>
                                    <li>• Marcar tickets como resueltos</li>
                                    <li>• Ver historial de conversaciones</li>
                                    <li>• Gestionar múltiples tickets simultáneamente</li>
                                </ul>
                            </div>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-xl">
                                <h4 class="font-semibold text-yellow-800 dark:text-yellow-300 mb-2">Limitaciones</h4>
                                <ul class="space-y-2 text-sm text-yellow-700 dark:text-yellow-200">
                                    <li>• No puedes eliminar tickets de soporte</li>
                                    <li>• Las respuestas se registran automáticamente</li>
                                    <li>• No puedes modificar tickets cerrados</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reportes -->
                <div x-data="{ open: false }" class="card rounded-2xl overflow-hidden">
                    <button @click="open = !open" class="w-full p-6 text-left flex items-center justify-between hover:bg-blue-200 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-teal-100 dark:bg-teal-900 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-black dark:text-white">Reportes</h3>
                                <p class="text-sm opacity-70 text-black dark:text-white">Generar y visualizar reportes del sistema</p>
                            </div>
                        </div>
                        <svg class="w-6 h-6 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="space-y-4">
                            <div class="bg-teal-50 dark:bg-teal-900/20 p-4 rounded-xl">
                                <h4 class="font-semibold text-teal-800 dark:text-teal-300 mb-2">¿Qué puedes hacer?</h4>
                                <ul class="space-y-2 text-sm text-teal-700 dark:text-teal-200">
                                    <li>• Generar reportes de ventas</li>
                                    <li>• Exportar datos en diferentes formatos</li>
                                    <li>• Filtrar reportes por fechas</li>
                                    <li>• Ver estadísticas detalladas</li>
                                    <li>• Analizar tendencias de ventas</li>
                                    <li>• Generar reportes de inventario</li>
                                    <li>• Crear reportes personalizados</li>
                                </ul>
                            </div>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-xl">
                                <h4 class="font-semibold text-yellow-800 dark:text-yellow-300 mb-2">Limitaciones</h4>
                                <ul class="space-y-2 text-sm text-yellow-700 dark:text-yellow-200">
                                    <li>• Los reportes se generan en tiempo real</li>
                                    <li>• No puedes modificar datos desde los reportes</li>
                                    <li>• Algunos formatos de exportación pueden tener limitaciones</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información Adicional -->
            <div class="mt-8 card rounded-2xl p-6">
                <h3 class="text-xl font-semibold mb-4 text-black dark:text-white">Información Adicional</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl">
                        <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-2">Roles de Usuario</h4>
                        <ul class="space-y-1 text-sm text-blue-700 dark:text-blue-200">
                            <li><strong>Administrador:</strong> Acceso completo al sistema y gestión de contenido</li>
                            <li><strong>Usuario Logeado:</strong> Acceso a compras, perfil y funcionalidades básicas</li>
                            <li><strong>Visitante:</strong> Solo puede ver el catálogo y registrarse</li>
                        </ul>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-xl">
                        <h4 class="font-semibold text-green-800 dark:text-green-300 mb-2">Consejos de Seguridad</h4>
                        <ul class="space-y-1 text-sm text-green-700 dark:text-green-200">
                            <li>• Cierra sesión al terminar tu trabajo</li>
                            <li>• No compartas tus credenciales</li>
                            <li>• Verifica los cambios antes de confirmarlos</li>
                            <li>• Mantén un registro de las acciones realizadas</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 