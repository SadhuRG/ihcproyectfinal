<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Librería Pulsar</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    </head>

    <body class="min-h-screen" style="background: var(--bg-primary);">

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
                            Descubre tu próxima lectura
                        </h1>
                        <p class="text-xl md:text-2xl mb-8 opacity-90">
                            Miles de libros esperan por ti en Librería Pulsar
                        </p>
                    </div>
                </section>

                <!-- SECCIÓN PROMOCIONAL -->
                <section class="py-16 px-4">
                    <div class="container mx-auto">
                        <div class="rounded-3xl p-8 md:p-12 text-white dark:text-gray-200 text-center relative overflow-hidden" style="background: var(--bg-header);">
                            <!-- Elementos decorativos -->
                            <div class="absolute top-0 left-0 w-32 h-32 bg-white/10 dark:bg-gray-200/10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                            <div class="absolute bottom-0 right-0 w-24 h-24 bg-white/10 dark:bg-gray-200/10 rounded-full translate-x-1/2 translate-y-1/2"></div>

                            <div class="relative z-10">
                                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                                    ¡Oferta Especial!
                                </h2>
                                <p class="text-xl mb-6 opacity-90">
                                    20% de descuento en tu primera compra
                                </p>
                                <button class="btn-primary px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 dark:hover:bg-gray-300 transition-all duration-300 hover:scale-105 shadow-xl">
                                    Aprovechar Oferta
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- BEST SELLERS -->
                <section class="py-16 px-4">
                    <div class="container mx-auto">
                        <!-- Header de sección -->
                        <div class="flex justify-between items-center mb-12">
                            <div>
                                <h2 class="text-3xl md:text-4xl font-bold mb-2" style="color: var(--text-primary);">Best Sellers</h2>
                                <div class="w-20 h-1 rounded-full" style="background: var(--button-bg);"></div>
                            </div>
                            <a href="#" class="font-semibold text-lg hover:translate-x-2 transition-all duration-300 text-accent">Ver más →</a>
                        </div>

                        <!-- Grid de libros -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-12">
                            <!-- Libro 1 -->
                            <div class="group card rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 via-purple-600/5 to-purple-600/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative z-10">
                                    <div class="w-24 h-32 mx-auto mb-4 bg-gradient-to-br from-purple-600 to-blue-600 dark:from-purple-500 dark:to-blue-500 rounded-lg shadow-lg flex items-center justify-center text-white text-2xl group-hover:scale-105 transition-transform duration-300">
                                        📚
                                    </div>
                                    <h3 class="font-semibold text-center mb-2 line-clamp-2" style="color: var(--text-primary);">El Arte de la Guerra</h3>
                                    <div class="flex justify-center mb-2 space-x-1">
                                        <span class="text-yellow-400 dark:text-yellow-300 text-lg">★★★★★</span>
                                    </div>
                                    <p class="font-bold text-center text-lg text-accent">S/45.00</p>
                                    <button class="w-full mt-4 btn-primary py-2 rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>

                            <!-- Libro 2 -->
                            <div class="group card rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 via-purple-600/5 to-purple-600/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative z-10">
                                    <div class="w-24 h-32 mx-auto mb-4 bg-gradient-to-br from-green-600 to-teal-600 dark:from-green-500 dark:to-teal-500 rounded-lg shadow-lg flex items-center justify-center text-white text-2xl group-hover:scale-105 transition-transform duration-300">
                                        📖
                                    </div>
                                    <h3 class="font-semibold text-center mb-2 line-clamp-2" style="color: var(--text-primary);">Cien Años de Soledad</h3>
                                    <div class="flex justify-center mb-2 space-x-1">
                                        <span class="text-yellow-400 dark:text-yellow-300 text-lg">★★★★★</span>
                                    </div>
                                    <p class="font-bold text-center text-lg text-accent">S/52.00</p>
                                    <button class="w-full mt-4 btn-primary py-2 rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>

                            <!-- Libro 3 -->
                            <div class="group card rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 via-purple-600/5 to-purple-600/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative z-10">
                                    <div class="w-24 h-32 mx-auto mb-4 bg-gradient-to-br from-red-600 to-pink-600 dark:from-red-500 dark:to-pink-500 rounded-lg shadow-lg flex items-center justify-center text-white text-2xl group-hover:scale-105 transition-transform duration-300">
                                        📘
                                    </div>
                                    <h3 class="font-semibold text-center mb-2 line-clamp-2" style="color: var(--text-primary);">1984</h3>
                                    <div class="flex justify-center mb-2 space-x-1">
                                        <span class="text-yellow-400 dark:text-yellow-300 text-lg">★★★★☆</span>
                                    </div>
                                    <p class="font-bold text-center text-lg text-accent">S/38.00</p>
                                    <button class="w-full mt-4 btn-primary py-2 rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>

                            <!-- Libro 4 -->
                            <div class="group card rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 via-purple-600/5 to-purple-600/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative z-10">
                                    <div class="w-24 h-32 mx-auto mb-4 bg-gradient-to-br from-orange-600 to-yellow-600 dark:from-orange-500 dark:to-yellow-500 rounded-lg shadow-lg flex items-center justify-center text-white text-2xl group-hover:scale-105 transition-transform duration-300">
                                        📗
                                    </div>
                                    <h3 class="font-semibold text-center mb-2 line-clamp-2" style="color: var(--text-primary);">Don Quijote</h3>
                                    <div class="flex justify-center mb-2 space-x-1">
                                        <span class="text-yellow-400 dark:text-yellow-300 text-lg">★★★★★</span>
                                    </div>
                                    <p class="font-bold text-center text-lg text-accent">S/65.00</p>
                                    <button class="w-full mt-4 btn-primary py-2 rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>

                            <!-- Libro 5 -->
                            <div class="group card rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 via-purple-600/5 to-purple-600/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative z-10">
                                    <div class="w-24 h-32 mx-auto mb-4 bg-gradient-to-br from-indigo-600 to-purple-600 dark:from-indigo-500 dark:to-purple-500 rounded-lg shadow-lg flex items-center justify-center text-white text-2xl group-hover:scale-105 transition-transform duration-300">
                                        📙
                                    </div>
                                    <h3 class="font-semibold text-center mb-2 line-clamp-2" style="color: var(--text-primary);">El Principito</h3>
                                    <div class="flex justify-center mb-2 space-x-1">
                                        <span class="text-yellow-400 dark:text-yellow-300 text-lg">★★★★★</span>
                                    </div>
                                    <p class="font-bold text-center text-lg text-accent">S/28.00</p>
                                    <button class="w-full mt-4 btn-primary py-2 rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>

                            <!-- Libro 6 -->
                            <div class="group card rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 via-purple-600/5 to-purple-600/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative z-10">
                                    <div class="w-24 h-32 mx-auto mb-4 bg-gradient-to-br from-pink-600 to-rose-600 dark:from-pink-500 dark:to-rose-500 rounded-lg shadow-lg flex items-center justify-center text-white text-2xl group-hover:scale-105 transition-transform duration-300">
                                        📕
                                    </div>
                                    <h3 class="font-semibold text-center mb-2 line-clamp-2" style="color: var(--text-primary);">Orgullo y Prejuicio</h3>
                                    <div class="flex justify-center mb-2 space-x-1">
                                        <span class="text-yellow-400 dark:text-yellow-300 text-lg">★★★★☆</span>
                                    </div>
                                    <p class="font-bold text-center text-lg text-accent">S/42.00</p>
                                    <button class="w-full mt-4 btn-primary py-2 rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECCIÓN DE NOVEDADES -->
                <section class="py-16 px-4">
                    <div class="container mx-auto">
                        <!-- Header de sección -->
                        <div class="flex justify-between items-center mb-12">
                            <div>
                                <h2 class="text-3xl md:text-4xl font-bold mb-2" style="color: var(--text-primary);">Novedades</h2>
                                <div class="w-20 h-1 rounded-full" style="background: var(--button-bg);"></div>
                            </div>
                            <a href="#" class="font-semibold text-lg hover:translate-x-2 transition-all duration-300 text-accent">Ver más →</a>
                        </div>

                        <!-- Grid de libros -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-12">
                            <!-- Libro 1 -->
                            <div class="group card rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 via-purple-600/5 to-purple-600/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative z-10">
                                    <div class="w-24 h-32 mx-auto mb-4 bg-gradient-to-br from-purple-600 to-blue-600 dark:from-purple-500 dark:to-blue-500 rounded-lg shadow-lg flex items-center justify-center text-white text-2xl group-hover:scale-105 transition-transform duration-300">
                                        📚
                                    </div>
                                    <h3 class="font-semibold text-center mb-2 line-clamp-2" style="color: var(--text-primary);">El Arte de la Guerra</h3>
                                    <div class="flex justify-center mb-2 space-x-1">
                                        <span class="text-yellow-400 dark:text-yellow-300 text-lg">★★★★★</span>
                                    </div>
                                    <p class="font-bold text-center text-lg text-accent">S/45.00</p>
                                    <button class="w-full mt-4 btn-primary py-2 rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>

                            <!-- Libro 2 -->
                            <div class="group card rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 via-purple-600/5 to-purple-600/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative z-10">
                                    <div class="w-24 h-32 mx-auto mb-4 bg-gradient-to-br from-green-600 to-teal-600 dark:from-green-500 dark:to-teal-500 rounded-lg shadow-lg flex items-center justify-center text-white text-2xl group-hover:scale-105 transition-transform duration-300">
                                        📖
                                    </div>
                                    <h3 class="font-semibold text-center mb-2 line-clamp-2" style="color: var(--text-primary);">Cien Años de Soledad</h3>
                                    <div class="flex justify-center mb-2 space-x-1">
                                        <span class="text-yellow-400 dark:text-yellow-300 text-lg">★★★★★</span>
                                    </div>
                                    <p class="font-bold text-center text-lg text-accent">S/52.00</p>
                                    <button class="w-full mt-4 btn-primary py-2 rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>

                            <!-- Libro 3 -->
                            <div class="group card rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 via-purple-600/5 to-purple-600/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative z-10">
                                    <div class="w-24 h-32 mx-auto mb-4 bg-gradient-to-br from-red-600 to-pink-600 dark:from-red-500 dark:to-pink-500 rounded-lg shadow-lg flex items-center justify-center text-white text-2xl group-hover:scale-105 transition-transform duration-300">
                                        📘
                                    </div>
                                    <h3 class="font-semibold text-center mb-2 line-clamp-2" style="color: var(--text-primary);">1984</h3>
                                    <div class="flex justify-center mb-2 space-x-1">
                                        <span class="text-yellow-400 dark:text-yellow-300 text-lg">★★★★☆</span>
                                    </div>
                                    <p class="font-bold text-center text-lg text-accent">S/38.00</p>
                                    <button class="w-full mt-4 btn-primary py-2 rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>

                            <!-- Libro 4 -->
                            <div class="group card rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 via-purple-600/5 to-purple-600/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative z-10">
                                    <div class="w-24 h-32 mx-auto mb-4 bg-gradient-to-br from-orange-600 to-yellow-600 dark:from-orange-500 dark:to-yellow-500 rounded-lg shadow-lg flex items-center justify-center text-white text-2xl group-hover:scale-105 transition-transform duration-300">
                                        📗
                                    </div>
                                    <h3 class="font-semibold text-center mb-2 line-clamp-2" style="color: var(--text-primary);">Don Quijote</h3>
                                    <div class="flex justify-center mb-2 space-x-1">
                                        <span class="text-yellow-400 dark:text-yellow-300 text-lg">★★★★★</span>
                                    </div>
                                    <p class="font-bold text-center text-lg text-accent">S/65.00</p>
                                    <button class="w-full mt-4 btn-primary py-2 rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>

                            <!-- Libro 5 -->
                            <div class="group card rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 via-purple-600/5 to-purple-600/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative z-10">
                                    <div class="w-24 h-32 mx-auto mb-4 bg-gradient-to-br from-indigo-600 to-purple-600 dark:from-indigo-500 dark:to-purple-500 rounded-lg shadow-lg flex items-center justify-center text-white text-2xl group-hover:scale-105 transition-transform duration-300">
                                        📙
                                    </div>
                                    <h3 class="font-semibold text-center mb-2 line-clamp-2" style="color: var(--text-primary);">El Principito</h3>
                                    <div class="flex justify-center mb-2 space-x-1">
                                        <span class="text-yellow-400 dark:text-yellow-300 text-lg">★★★★★</span>
                                    </div>
                                    <p class="font-bold text-center text-lg text-accent">S/28.00</p>
                                    <button class="w-full mt-4 btn-primary py-2 rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>

                            <!-- Libro 6 -->
                            <div class="group card rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/0 via-purple-600/5 to-purple-600/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative z-10">
                                    <div class="w-24 h-32 mx-auto mb-4 bg-gradient-to-br from-pink-600 to-rose-600 dark:from-pink-500 dark:to-rose-500 rounded-lg shadow-lg flex items-center justify-center text-white text-2xl group-hover:scale-105 transition-transform duration-300">
                                        📕
                                    </div>
                                    <h3 class="font-semibold text-center mb-2 line-clamp-2" style="color: var(--text-primary);">Orgullo y Prejuicio</h3>
                                    <div class="flex justify-center mb-2 space-x-1">
                                        <span class="text-yellow-400 dark:text-yellow-300 text-lg">★★★★☆</span>
                                    </div>
                                    <p class="font-bold text-center text-lg text-accent">S/42.00</p>
                                    <button class="w-full mt-4 btn-primary py-2 rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECCIÓN DE SOPORTE -->
                @auth
                <section class="py-16 px-4" style="background: var(--card-bg);">
                    <div class="container mx-auto">
                        <div class="text-center mb-12">
                            <h2 class="text-3xl md:text-4xl font-bold mb-4" style="color: var(--text-primary);">¿Necesitas Ayuda?</h2>
                            <p class="text-lg max-w-2xl mx-auto" style="color: var(--text-primary);">
                                Nuestro equipo de soporte está aquí para ayudarte. Envíanos tu consulta y te responderemos lo antes posible.
                            </p>
                        </div>
                        
                        <div class="max-w-2xl mx-auto">
                            @livewire('user-support')
                        </div>
                    </div>
                </section>
                @endauth

            </div>

        </div>

</x-layouts.app>

    <x-layouts.app.footer/>

    <!-- Script para interactividad básica -->
    <script>
        // Animación de entrada para las cards
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

        // Observar todas las cards de libros
        document.querySelectorAll('.group').forEach(card => {
            observer.observe(card);
        });

        // Función de búsqueda básica
        const searchInput = document.querySelector('input[type="text"]');
        const searchButton = document.querySelector('button');

        searchButton.addEventListener('click', () => {
            const query = searchInput.value.trim();
            if (query) {
                alert(`Buscando: "${query}"`);
                // Aquí iría la lógica de búsqueda real
            }
        });

        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                searchButton.click();
            }
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

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</body>
</html>