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

<body>
<!-- FOOTER -->
<footer class="w-full relative overflow-hidden" style="background: var(--bg-header);">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <defs>
                <pattern id="footer-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="1" fill="currentColor" class="text-white dark:text-gray-200" opacity="0.3"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#footer-pattern)"/>
        </svg>
    </div>

    <!-- Footer Content -->
    <div class="relative z-10 px-6 py-12">
        <!-- Main Footer Content -->
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <!-- Logo and Description -->
            <div class="md:col-span-2">
                <div class="flex items-center space-x-3 mb-4">
                    <img src="/imagenes/LOGO.jpg" alt="Pulsar Logo" class="w-10 h-10 rounded-full">
                    <span class="text-white dark:text-gray-200 text-2xl font-bold">Pulsar</span>
                </div>
                <p class="text-white dark:text-gray-200 text-sm leading-relaxed mb-4">
                    Tu librería digital favorita. Descubre miles de libros, desde clásicos hasta bestsellers modernos.
                    Alimenta tu pasión por la lectura con nuestra extensa colección.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 dark:text-gray-300 hover:text-white dark:hover:text-gray-100 transition-colors duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-2.719 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.030-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 dark:text-gray-300 hover:text-white dark:hover:text-gray-100 transition-colors duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 dark:text-gray-300 hover:text-white dark:hover:text-gray-100 transition-colors duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.191-.334 1.357-.053.225-.172.271-.402.163-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.957 0 4.152-2.619 7.497-6.262 7.497-1.222 0-2.374-.636-2.765-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-white dark:text-gray-200 font-semibold text-lg mb-4">Enlaces Rápidos</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-white dark:text-gray-200 hover:text-white dark:hover:text-gray-100 transition-colors duration-300 text-sm">Inicio</a></li>
                    <li><a href="#" class="text-white dark:text-gray-200 hover:text-white dark:hover:text-gray-100 transition-colors duration-300 text-sm">Catálogo</a></li>
                    <li><a href="#" class="text-white dark:text-gray-200 hover:text-white dark:hover:text-gray-100 transition-colors duration-300 text-sm">Best Sellers</a></li>
                    <li><a href="#" class="text-white dark:text-gray-200 hover:text-white dark:hover:text-gray-100 transition-colors duration-300 text-sm">Ofertas</a></li>
                    <li><a href="#" class="text-white dark:text-gray-200 hover:text-white dark:hover:text-gray-100 transition-colors duration-300 text-sm">Mi Cuenta</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-white dark:text-gray-200 font-semibold text-lg mb-4">Contacto</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center space-x-2 text-white dark:text-gray-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>info@libreriapulsar.com</span>
                    </li>
                    <li class="flex items-center space-x-2 text-white dark:text-gray-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>+51 944 123 456</span>
                    </li>
                    <li class="flex items-start space-x-2 text-white dark:text-gray-200">
                        <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Trujillo, La Libertad, Perú</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Newsletter Section -->
        <div class="max-w-6xl mx-auto border-t pt-8 mb-8" style="border-color: var(--text-primary);">
            <div class="text-center">
                <h3 class="text-white dark:text-gray-200 font-semibold text-lg mb-2">Suscríbete a nuestro newsletter</h3>
                <p class="text-white dark:text-gray-200 text-sm mb-4">Recibe las últimas novedades y ofertas especiales</p>
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-2 sm:space-y-0 sm:space-x-2 max-w-md mx-auto">
                    <input type="email" placeholder="Tu email"
                           class="w-full sm:flex-1 px-4 py-2 bg-white/10 dark:bg-gray-800/10 backdrop-blur-sm border rounded-full text-white dark:text-gray-200 placeholder-white dark:placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-white/50 dark:focus:ring-gray-200/50 focus:border-transparent" style="border-color: var(--text-primary);">
                    <button class="w-full sm:w-auto px-6 py-2 btn-primary font-medium rounded-full transition-all duration-300 hover:scale-105">
                        Suscribirse
                    </button>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center pt-4 border-t" style="border-color: var(--text-primary);">
            <p class="text-white dark:text-gray-200 text-sm">
                © 2024 Librería Pulsar. Todos los derechos reservados.
            </p>
        </div>
    </div>
</footer>
<!-- FIN FOOTER -->

{{ $slot }}

</body>
</html>