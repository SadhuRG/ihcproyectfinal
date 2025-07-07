<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Librería Pulsar - Ayuda</title>
    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>

<body class="min-h-screen {{ auth()->check() ? 'auth-user' : '' }}" style="background: var(--bg-primary);">
    <x-layouts.app>
        <div class="min-h-screen flex flex-col">
            <!-- SECCIÓN PRINCIPAL -->
            <div id="main-content" class="transition-all duration-300">
                <!-- BANNER HERO -->
                <section class="relative pt-24 pb-12 overflow-hidden">
                    <!-- Fondo con gradiente -->
                    <div class="absolute inset-0" style="background: var(--bg-header); opacity: 0.9;"></div>

                    <!-- Patrón de fondo decorativo -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, white 2px, transparent 2px), radial-gradient(circle at 75% 75%, white 2px, transparent 2px); background-size: 50px 50px;"></div>
                    </div>

                    <div class="relative z-10 container mx-auto px-4 text-center text-white dark:text-gray-200">
                        <h1 class="text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg">
                            Guía de Uso de Librería Pulsar
                        </h1>
                        <p class="text-xl md:text-2xl mb-8 opacity-90">
                            Aprende a navegar y disfrutar de nuestra librería en línea
                        </p>
                    </div>
                </section>

                <!-- SECCIÓN DE GUÍA -->
                <section class="py-16 px-4">
                    <div class="container mx-auto">
                        <div class="max-w-3xl mx-auto card rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 group">
                            <div class="relative z-10">
                                <h2 class="text-3xl font-bold mb-4 text-center" style="color: var(--text-primary);">Cómo Usar Librería Pulsar</h2>
                                <p class="text-lg text-center mb-8" style="color: var(--text-primary);">
                                    Haz clic en cada paso para ver las instrucciones detalladas.
                                </p>
                                <div class="space-y-4">
                                    <!-- Paso 1 -->
                                    <div class="accordion-item">
                                        <button class="accordion-title w-full flex items-center justify-between space-x-4 p-4 bg-white/50 dark:bg-gray-800/50 rounded-lg hover:bg-white/70 dark:hover:bg-gray-800/70 transition-all duration-300" style="color: var(--text-primary);">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0 w-10 h-10 bg-accent text-white rounded-full flex items-center justify-center text-lg font-bold">1</div>
                                                <h3 class="text-xl font-semibold">Explora Nuestra Colección</h3>
                                            </div>
                                            <svg class="w-6 h-6 transform transition-transform duration-300 accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div class="accordion-content hidden p-4" style="color: var(--text-primary);">
                                            En la página principal, encontrarás secciones como <strong>Best Sellers</strong> y <strong>Novedades</strong>. Usa los enlaces "Ver más" para explorar más títulos o navega por categorías específicas.
                                        </div>
                                    </div>
                                    <!-- Paso 2 -->
                                    <div class="accordion-item">
                                        <button class="accordion-title w-full flex items-center justify-between space-x-4 p-4 bg-white/50 dark:bg-gray-800/50 rounded-lg hover:bg-white/70 dark:hover:bg-gray-800/70 transition-all duration-300" style="color: var(--text-primary);">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0 w-10 h-10 bg-accent text-white rounded-full flex items-center justify-center text-lg font-bold">2</div>
                                                <h3 class="text-xl font-semibold">Busca Libros</h3>
                                            </div>
                                            <svg class="w-6 h-6 transform transition-transform duration-300 accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div class="accordion-content hidden p-4" style="color: var(--text-primary);">
                                            Utiliza la barra de búsqueda en la parte superior de la página para encontrar libros por título, autor o género. Escribe tu consulta y presiona el ícono de la lupa o la tecla Enter.
                                        </div>
                                    </div>
                                    <!-- Paso 3 -->
                                    <div class="accordion-item">
                                        <button class="accordion-title w-full flex items-center justify-between space-x-4 p-4 bg-white/50 dark:bg-gray-800/50 rounded-lg hover:bg-white/70 dark:hover:bg-gray-800/70 transition-all duration-300" style="color: var(--text-primary);">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0 w-10 h-10 bg-accent text-white rounded-full flex items-center justify-center text-lg font-bold">3</div>
                                                <h3 class="text-xl font-semibold">Aprovecha Ofertas</h3>
                                            </div>
                                            <svg class="w-6 h-6 transform transition-transform duration-300 accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div class="accordion-content hidden p-4" style="color: var(--text-primary);">
                                            Revisa la sección de promociones en la página principal para aprovechar descuentos, como el 20% en tu primera compra. Haz clic en "Aprovechar Oferta" para obtener más detalles.
                                        </div>
                                    </div>
                                    <!-- Paso 4 -->
                                    <div class="accordion-item">
                                        <button class="accordion-title w-full flex items-center justify-between space-x-4 p-4 bg-white/50 dark:bg-gray-800/50 rounded-lg hover:bg-white/70 dark:hover:bg-gray-800/70 transition-all duration-300" style="color: var(--text-primary);">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0 w-10 h-10 bg-accent text-white rounded-full flex items-center justify-center text-lg font-bold">4</div>
                                                <h3 class="text-xl font-semibold">Agrega al Carrito</h3>
                                            </div>
                                            <svg class="w-6 h-6 transform transition-transform duration-300 accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div class="accordion-content hidden p-4" style="color: var(--text-primary);">
                                            Cuando encuentres un libro que te guste, haz clic en "Agregar al carrito" en la tarjeta del libro. Puedes revisar tu carrito haciendo clic en el ícono de carrito en la barra superior.
                                        </div>
                                    </div>
                                    <!-- Paso 5 -->
                                    <div class="accordion-item">
                                        <button class="accordion-title w-full flex items-center justify-between space-x-4 p-4 bg-white/50 dark:bg-gray-800/50 rounded-lg hover:bg-white/70 dark:hover:bg-gray-800/70 transition-all duration-300" style="color: var(--text-primary);">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0 w-10 h-10 bg-accent text-white rounded-full flex items-center justify-center text-lg font-bold">5</div>
                                                <h3 class="text-xl font-semibold">Gestiona tu Perfil</h3>
                                            </div>
                                            <svg class="w-6 h-6 transform transition-transform duration-300 accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div class="accordion-content hiddenключа hidden p-4" style="color: var(--text-primary);">
                                            Accede a tu perfil desde el menú de usuario en la barra superior para ver tus pedidos, actualizar tus datos o cerrar sesión. Si eres administrador, también puedes acceder al dashboard.
                                        </div>
                                    </div>
                                    <!-- Paso 6 -->
                                    <div class="accordion-item">
                                        <button class="accordion-title w-full flex items-center justify-between space-x-4 p-4 bg-white dark:bg-gray-800/50 rounded-lg hover:bg-white/70 dark:hover:bg-gray-800/70 transition-all duration-300" style="color: var(--text-primary);">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0 w-10 h-10 bg-accent text-white rounded-full flex items-center justify-center text-lg font-bold">6</div>
                                                <h3 class="text-xl font-semibold">Obtén Soporte</h3>
                                            </div>
                                            <svg class="w-6 h-6 transform transition-transform duration-300 accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div class="accordion-content hidden p-4" style="color: var(--text-primary);">
                                            Si necesitas ayuda adicional, visita la sección de soporte desde el menú de usuario o contáctanos directamente a través de nuestro equipo de atención al cliente.
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-8">
                                    <a href="{{ url('/') }}" class="btn-primary px-6 py-3 rounded-full font-medium hover:scale-105 transition-all duration-300">Volver a la Página Principal</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </x-layouts.app>


    <!-- Script para animación de entrada y acordeón -->
    <script>
        // Animación de entrada para la tarjeta de la guía
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationDelay = Math.random() * 0.5 + 's';
                    entry.target.classList.add('animate-fadeInUp');
                }
            });
        }, observerOptions);

        // Observar la tarjeta de la guía
        document.querySelectorAll('.card').forEach(card => {
            observer.observe(card);
        });

        // Funcionalidad del acordeón
        document.querySelectorAll('.accordion-title').forEach(button => {
            button.addEventListener('click', () => {
                const accordionItem = button.parentElement;
                const content = accordionItem.querySelector('.accordion-content');
                const icon = button.querySelector('.accordion-icon');

                // Cerrar otros elementos abiertos
                document.querySelectorAll('.accordion-content').forEach(otherContent => {
                    if (otherContent !== content && !otherContent.classList.contains('hidden')) {
                        otherContent.classList.add('hidden');
                        otherContent.style.maxHeight = null;
                        const otherIcon = otherContent.previousElementSibling.querySelector('.accordion-icon');
                        otherIcon.classList.remove('rotate-180');
                    }
                });

                // Alternar el contenido actual
                if (content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    content.style.maxHeight = content.scrollHeight + 'px';
                    icon.classList.add('rotate-180');
                } else {
                    content.classList.add('hidden');
                    content.style.maxHeight = null;
                    icon.classList.remove('rotate-180');
                }
            });
        });
    </script>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease forwards;
        }

        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
    </style>
</body>
</html>