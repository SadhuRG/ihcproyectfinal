<x-layouts.app>
    <x-horizontal-categories-menu />
    <!-- Hero Banner Combinado -->
    <section class="relative pt-24 pb-20 overflow-hidden">
        <!-- Fondo degradado -->
        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 via-blue-600 to-purple-800 opacity-90"></div>

        <!-- Efecto de puntos -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, white 2px, transparent 2px), radial-gradient(circle at 75% 75%, white 2px, transparent 2px); background-size: 50px 50px;"></div>
        </div>

        <!-- Contenido -->
        <div class="relative z-10 container mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 drop-shadow-lg animate-fadeInUp">
                Descubre tu próxima lectura
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90 animate-fadeInUp">
                Miles de libros esperan por ti en Librería Pulsar
            </p>

            <!-- Oferta Especial -->
            <div class="bg-white/20 backdrop-blur-md rounded-3xl inline-block px-8 py-6 md:px-12 md:py-8 mb-8 animate-fadeInUp">
                <h2 class="text-2xl md:text-3xl font-bold mb-2">
                    ¡Oferta Especial!
                </h2>
                <p class="text-lg mb-4">
                    20% de descuento en tu primera compra
                </p>
                <button class="bg-white text-purple-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-xl">
                    Aprovechar Oferta
                </button>
            </div>

            <!-- Slogan secundario -->
            <p class="text-lg opacity-80 animate-fadeInUp">
                ¡Miles de títulos disponibles para todos los gustos!
            </p>
        </div>
    </section>

    <!-- Sección Best Sellers -->
    <livewire:books.best-sellers />

    <!-- Sección Novedades -->
    <livewire:books.new-releases />

    <!-- Sección Ficción -->
    <livewire:books.fiction-books />

    <!-- Sección Romance -->
    <livewire:books.romance-books />

    <!-- Scripts de animación -->
    @push('scripts')
    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeInUp');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.group').forEach(card => {
            observer.observe(card);
        });
    </script>
    @endpush

    <!-- Estilos personalizados -->
    @push('styles')
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

    @endpush
</x-layouts.app>
