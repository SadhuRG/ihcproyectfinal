<x-layouts.app>

    <!-- Hero Section -->
    <section class="relative pt-24 pb-12 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 via-blue-600 to-purple-800 opacity-90"></div>

        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, white 2px, transparent 2px), radial-gradient(circle at 75% 75%, white 2px, transparent 2px); background-size: 50px 50px;"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg">
                Descubre tu próxima lectura
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90">
                Miles de libros esperan por ti en Librería Pulsar
            </p>
        </div>
    </section>

    <!-- Sección Promocional -->
    <section class="py-16 px-4">
        <div class="container mx-auto">
            <div class="bg-gradient-to-r from-purple-600 via-blue-600 to-purple-800 rounded-3xl p-8 md:p-12 text-white text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-32 h-32 bg-white/10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-24 h-24 bg-white/10 rounded-full translate-x-1/2 translate-y-1/2"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">
                        ¡Oferta Especial!
                    </h2>
                    <p class="text-xl mb-6 opacity-90">
                        20% de descuento en tu primera compra
                    </p>
                    <button class="bg-white text-purple-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-xl">
                        Aprovechar Oferta
                    </button>
                </div>
            </div>
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

    <!-- Sección de Soporte -->
    @auth
    <section class="py-16 px-4 bg-gray-50">
        <div class="container mx-auto text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">¿Necesitas Ayuda?</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Nuestro equipo de soporte está aquí para ayudarte. Envíanos tu consulta y te responderemos lo antes posible.
            </p>
        </div>
        <div class="max-w-2xl mx-auto">
            @livewire('user-support')
        </div>
    </section>
    @endauth

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
