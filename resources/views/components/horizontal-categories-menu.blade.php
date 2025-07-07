<div class="bg-white pt-10 py-5 border-b border-gray-200 shadow-sm">
    <div class="container mx-auto px-2">
        <!-- Desktop Menu -->
        <nav class="hidden lg:flex items-center justify-between space-x-1 py-3" x-data="{
            activeCategory: null,
            megaMenuOpen: false,
            megaActiveCategory: null,
            hoverTimeout: null
        }">

            <!-- MEGA MENU: Todas las Categorías -->
            <div class="relative">
                <button
                    @click="megaMenuOpen = !megaMenuOpen"
                    class="flex items-center space-x-2 px-4 py-2 text-white bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 rounded-lg transition-all duration-200 font-medium shadow-md hover:shadow-lg"
                    :class="{ 'from-purple-700 to-blue-700': megaMenuOpen }">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <span>Todas las Categorías</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': megaMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- MEGA MENU PANEL -->
                <div x-show="megaMenuOpen"
                     @click.away="megaMenuOpen = false"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                     class="absolute top-full left-0 mt-2 w-[36rem] bg-white rounded-xl shadow-2xl border border-gray-200 z-50 overflow-visible"
                     x-data="{
                        categories: {
                            'ficcion': {
                                name: 'Ficción y Literatura',
                                icon: '📚',
                                color: 'purple',
                                subcategories: [
                                    'Literatura Contemporánea',
                                    'Novela Histórica',
                                    'Ciencia Ficción',
                                    'Fantasía',
                                    'Misterio y Suspense',
                                    'Romance',
                                    'Poesía',
                                    'Teatro'
                                ]
                            },
                            'no-ficcion': {
                                name: 'No Ficción',
                                icon: '📖',
                                color: 'blue',
                                subcategories: [
                                    'Biografía y Memorias',
                                    'Ensayo',
                                    'Filosofía',
                                    'Historia',
                                    'Ciencias Sociales',
                                    'Política y Actualidad'
                                ]
                            },
                            'desarrollo': {
                                name: 'Desarrollo Personal',
                                icon: '💼',
                                color: 'green',
                                subcategories: [
                                    'Desarrollo Personal',
                                    'Negocios y Economía',
                                    'Psicología',
                                    'Salud y Bienestar'
                                ]
                            },
                            'tecnico': {
                                name: 'Técnico y Educativo',
                                icon: '🎓',
                                color: 'indigo',
                                subcategories: [
                                    'Tecnología e Informática',
                                    'Educación'
                                ]
                            },
                            'arte': {
                                name: 'Arte y Cultura',
                                icon: '🎨',
                                color: 'pink',
                                subcategories: [
                                    'Arte y Fotografía',
                                    'Cocina y Gastronomía',
                                    'Viajes y Geografía'
                                ]
                            },
                            'infantil': {
                                name: 'Infantil y Juvenil',
                                icon: '🧸',
                                color: 'yellow',
                                subcategories: [
                                    'Infantil y Juvenil'
                                ]
                            },
                            'religion': {
                                name: 'Religión y Espiritualidad',
                                icon: '🕊️',
                                color: 'violet',
                                subcategories: [
                                    'Religión y Espiritualidad'
                                ]
                            }
                        },

                        setActiveCategory(key) {
                            clearTimeout(this.hoverTimeout);
                            this.megaActiveCategory = key;
                        },

                        clearActiveCategory() {
                            this.hoverTimeout = setTimeout(() => {
                                this.megaActiveCategory = null;
                            }, 150);
                        },

                        keepActive() {
                            clearTimeout(this.hoverTimeout);
                        }
                     }">

                    <!-- Panel principal con categorías -->
                    <div class="flex">
                        <!-- Lista de categorías principales (lado izquierdo) -->
                        <div class="w-64 bg-gray-50 border-r border-gray-200 rounded-l-xl">
                            <div class="p-3 border-b border-gray-200 bg-gradient-to-r from-purple-600 to-blue-600 rounded-tl-xl">
                                <h3 class="font-semibold text-white text-sm">📚 Todas las Categorías</h3>
                                <p class="text-xs text-white/80">Explora por tema</p>
                            </div>

                            <div class="p-2">
                                <template x-for="(category, key) in categories" :key="key">
                                    <div class="relative">
                                        <button
                                            @mouseenter="setActiveCategory(key)"
                                            @mouseleave="clearActiveCategory()"
                                            class="w-full flex items-center justify-between p-3 hover:bg-white rounded-lg transition-all duration-200 group"
                                            :class="{ 'bg-white shadow-sm': megaActiveCategory === key }">

                                            <div class="flex items-center space-x-3">
                                                <span class="text-xl" x-text="category.icon"></span>
                                                <div class="text-left">
                                                    <div class="font-medium text-gray-800 text-sm group-hover:text-purple-600"
                                                         :class="{ 'text-purple-600': megaActiveCategory === key }"
                                                         x-text="category.name"></div>
                                                    <div class="text-xs text-gray-500"
                                                         x-text="category.subcategories.length + ' subcategorías'"></div>
                                                </div>
                                            </div>

                                            <svg class="w-4 h-4 text-gray-400 group-hover:text-purple-600"
                                                 :class="{ 'text-purple-600': megaActiveCategory === key }"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Panel de subcategorías (lado derecho) -->
                        <div class="w-80 bg-white rounded-r-xl"
                             x-show="megaActiveCategory"
                             @mouseenter="keepActive()"
                             @mouseleave="clearActiveCategory()">

                            <template x-for="(category, key) in categories" :key="key">
                                <div x-show="megaActiveCategory === key" class="h-full">
                                    <!-- Header del submenu -->
                                    <div class="p-5 border-b border-gray-100 rounded-tr-xl"
                                         :class="{
                                            'bg-gradient-to-r from-purple-500 to-blue-500 text-white': category.color === 'purple',
                                            'bg-gradient-to-r from-blue-500 to-indigo-500 text-white': category.color === 'blue',
                                            'bg-gradient-to-r from-green-500 to-emerald-500 text-white': category.color === 'green',
                                            'bg-gradient-to-r from-indigo-500 to-purple-500 text-white': category.color === 'indigo',
                                            'bg-gradient-to-r from-pink-500 to-rose-500 text-white': category.color === 'pink',
                                            'bg-gradient-to-r from-yellow-500 to-orange-500 text-white': category.color === 'yellow',
                                            'bg-gradient-to-r from-purple-500 to-violet-500 text-white': category.color === 'violet'
                                         }">
                                        <h4 class="font-semibold text-base flex items-center space-x-2">
                                            <span x-text="category.icon"></span>
                                            <span x-text="category.name"></span>
                                        </h4>
                                        <p class="text-sm opacity-90 mt-1" x-text="category.subcategories.length + ' subcategorías disponibles'"></p>
                                    </div>

                                    <!-- Lista de subcategorías -->
                                    <div class="p-4 max-h-80 overflow-y-auto submenu-scroll">
                                        <template x-for="subcategory in category.subcategories" :key="subcategory">
                                            <a :href="'/categoria/' + subcategory.toLowerCase().replace(/\s+/g, '-').replace(/ñ/g, 'n')"
                                               class="block px-4 py-3 text-base text-gray-700 hover:bg-gray-50 rounded-lg transition-colors font-medium"
                                               :class="{
                                                    'hover:text-purple-600 hover:bg-purple-50': category.color === 'purple',
                                                    'hover:text-blue-600 hover:bg-blue-50': category.color === 'blue',
                                                    'hover:text-green-600 hover:bg-green-50': category.color === 'green',
                                                    'hover:text-indigo-600 hover:bg-indigo-50': category.color === 'indigo',
                                                    'hover:text-pink-600 hover:bg-pink-50': category.color === 'pink',
                                                    'hover:text-yellow-600 hover:bg-yellow-50': category.color === 'yellow',
                                                    'hover:text-purple-600 hover:bg-purple-50': category.color === 'violet'
                                               }">
                                                <span x-text="subcategory"></span>
                                            </a>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de Ayuda y Soporte -->
            <div class="flex items-center space-x-3">
                <!-- Botón de Ayuda -->
                <a href="{{ route('user-helper') }}" 
                   class="flex items-center space-x-2 px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-all duration-200 font-medium shadow-sm hover:shadow-md hover:scale-105" 
                   title="Ayuda">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="hidden sm:inline">Ayuda</span>
                </a>

                <!-- Botón de Contactar Soporte -->
                <button onclick="abrirModalSoporte()" 
                        class="flex items-center space-x-2 px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-lg transition-all duration-200 font-medium shadow-sm hover:shadow-md hover:scale-105" 
                        title="Contactar Soporte">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span class="hidden sm:inline">Soporte</span>
                </button>
            </div>

        </nav>

        <!-- Mobile Menu -->
        <div class="lg:hidden py-3" x-data="{ mobileMenuOpen: false }">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="flex items-center justify-between w-full px-4 py-2 text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-lg transition-all duration-200 font-medium">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <span>Explorar Categorías</span>
                </div>
                <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': mobileMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="mobileMenuOpen"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 max-h-0"
                 x-transition:enter-end="opacity-100 max-h-96"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 max-h-96"
                 x-transition:leave-end="opacity-0 max-h-0"
                 class="mt-2 space-y-1 overflow-hidden">

                <a href="/categoria/ficcion" class="block px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors rounded-lg">
                    <div class="flex items-center space-x-3">
                        <span class="text-lg">📚</span>
                        <div>
                            <div class="font-medium">Ficción y Literatura</div>
                            <div class="text-xs text-gray-500">Romance, Misterio, Fantasía...</div>
                        </div>
                    </div>
                </a>

                <a href="/categoria/no-ficcion" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors rounded-lg">
                    <div class="flex items-center space-x-3">
                        <span class="text-lg">📖</span>
                        <div>
                            <div class="font-medium">No Ficción</div>
                            <div class="text-xs text-gray-500">Historia, Biografías, Ensayos...</div>
                        </div>
                    </div>
                </a>

                <a href="/categoria/desarrollo" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors rounded-lg">
                    <div class="flex items-center space-x-3">
                        <span class="text-lg">💼</span>
                        <div>
                            <div class="font-medium">Desarrollo Personal</div>
                            <div class="text-xs text-gray-500">Autoayuda, Negocios...</div>
                        </div>
                    </div>
                </a>

                <a href="/categoria/tecnico" class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors rounded-lg">
                    <div class="flex items-center space-x-3">
                        <span class="text-lg">🎓</span>
                        <div>
                            <div class="font-medium">Técnico y Educativo</div>
                            <div class="text-xs text-gray-500">Tecnología, Educación...</div>
                        </div>
                    </div>
                </a>

                <!-- Botones de Ayuda y Soporte para móvil -->
                <div class="border-t border-gray-200 pt-3 mt-3 space-y-2">
                    <a href="{{ route('user-helper') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors rounded-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <div class="font-medium">Ayuda</div>
                                <div class="text-xs text-gray-500">Guía de uso</div>
                            </div>
                        </div>
                    </a>

                    <button onclick="abrirModalSoporte()" class="block w-full px-4 py-3 text-left text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors rounded-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <div>
                                <div class="font-medium">Contactar Soporte</div>
                                <div class="text-xs text-gray-500">Enviar consulta</div>
                            </div>
                        </div>
                    </button>
                </div>

                <a href="/categorias" class="block px-4 py-3 text-purple-600 hover:bg-purple-50 transition-colors rounded-lg font-medium text-center border border-purple-200">
                    Ver Todas las Categorías →
                </a>
            </div>
        </div>
    </div>
</div>



<!-- MODAL DE SOPORTE -->
<div id="modalSoporte" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Header del Modal -->
        <div class="flex justify-between items-center p-6 border-b border-gray-200 dark:border-gray-700">
            <div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Contactar Soporte</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Envía tu consulta y te responderemos pronto</p>
            </div>
            <button onclick="cerrarModalSoporte()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Formulario -->
        <form id="formSoporte" class="p-6">
            <div class="space-y-6">
                <!-- Campo Asunto -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Asunto *
                    </label>
                    <input type="text" id="asuntoSoporte" 
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Describe brevemente tu problema o consulta" required>
                </div>

                <!-- Campo Mensaje -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Mensaje *
                        <span class="text-xs text-gray-500 font-normal">(Máximo 500 palabras)</span>
                    </label>
                    <textarea id="mensajeSoporte" rows="6" 
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                        placeholder="Describe detalladamente tu problema o consulta..." required></textarea>
                    
                    <!-- Contador de palabras -->
                    <div class="mt-2 flex justify-between items-center text-xs">
                        <span class="text-gray-500 dark:text-gray-400">
                            Palabras: <span id="contadorPalabras">0</span>/500
                        </span>
                        <span class="text-blue-600 dark:text-blue-400 font-medium" id="estadoPalabras">
                            Espacio disponible
                        </span>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <button type="button" onclick="cerrarModalSoporte()" 
                    class="px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all font-medium">
                    Cancelar
                </button>
                <button type="submit" 
                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-medium transition-all transform hover:scale-105 shadow-lg">
                    Enviar Ticket
                </button>
            </div>
        </form>
    </div>
</div>

<!-- NOTIFICACIÓN -->
<div id="notificacionSoporte" class="fixed top-4 right-4 z-50 hidden">
    <div class="bg-white dark:bg-gray-800 border-l-4 border-green-500 p-4 rounded-lg shadow-lg max-w-sm">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3 flex-1">
                <p class="text-sm font-medium text-gray-900 dark:text-white" id="mensajeNotificacion"></p>
            </div>
            <div class="ml-auto pl-3">
                <button onclick="cerrarNotificacionSoporte()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Scrollbar personalizada para submenús largos */
.submenu-scroll::-webkit-scrollbar {
    width: 4px;
}

.submenu-scroll::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.submenu-scroll::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

.submenu-scroll::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}
</style>

<script>
// Variables globales
let modalSoporte = null;
let notificacionSoporte = null;
let contadorPalabras = null;
let estadoPalabras = null;

// Inicializar elementos cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    modalSoporte = document.getElementById('modalSoporte');
    notificacionSoporte = document.getElementById('notificacionSoporte');
    contadorPalabras = document.getElementById('contadorPalabras');
    estadoPalabras = document.getElementById('estadoPalabras');
    
    // Configurar contador de palabras
    const mensajeSoporte = document.getElementById('mensajeSoporte');
    if (mensajeSoporte) {
        mensajeSoporte.addEventListener('input', actualizarContadorPalabras);
    }
    
    // Configurar formulario
    const formSoporte = document.getElementById('formSoporte');
    if (formSoporte) {
        formSoporte.addEventListener('submit', enviarTicketSoporte);
    }
});

// Función para abrir el modal
function abrirModalSoporte() {
    if (!modalSoporte) return;
    
    // Verificar si el usuario está autenticado
    if (!document.body.classList.contains('auth-user')) {
        mostrarNotificacion('Debes iniciar sesión para contactar soporte.', 'error');
        return;
    }
    
    modalSoporte.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

// Función para cerrar el modal
function cerrarModalSoporte() {
    if (!modalSoporte) return;
    
    modalSoporte.classList.add('hidden');
    document.body.style.overflow = 'auto';
    
    // Limpiar formulario
    const form = document.getElementById('formSoporte');
    if (form) form.reset();
    
    // Resetear contador
    if (contadorPalabras) contadorPalabras.textContent = '0';
    if (estadoPalabras) estadoPalabras.textContent = 'Espacio disponible';
}

// Función para actualizar contador de palabras
function actualizarContadorPalabras() {
    const mensaje = document.getElementById('mensajeSoporte').value;
    const palabras = mensaje.trim() ? mensaje.trim().split(/\s+/).length : 0;
    
    if (contadorPalabras) contadorPalabras.textContent = palabras;
    
    if (estadoPalabras) {
        if (palabras > 500) {
            estadoPalabras.textContent = 'Excede el límite';
            estadoPalabras.className = 'text-red-600 dark:text-red-400 font-medium';
        } else if (palabras > 450) {
            estadoPalabras.textContent = 'Casi al límite';
            estadoPalabras.className = 'text-yellow-600 dark:text-yellow-400 font-medium';
        } else {
            estadoPalabras.textContent = 'Espacio disponible';
            estadoPalabras.className = 'text-blue-600 dark:text-blue-400 font-medium';
        }
    }
}

// Función para enviar ticket
async function enviarTicketSoporte(e) {
    e.preventDefault();
    
    const asunto = document.getElementById('asuntoSoporte').value.trim();
    const mensaje = document.getElementById('mensajeSoporte').value.trim();
    
    // Validaciones
    if (!asunto) {
        mostrarNotificacion('El asunto es obligatorio.', 'error');
        return;
    }
    
    if (!mensaje) {
        mostrarNotificacion('El mensaje es obligatorio.', 'error');
        return;
    }
    
    const palabras = mensaje.split(/\s+/).length;
    if (palabras > 500) {
        mostrarNotificacion('El mensaje no puede exceder 500 palabras.', 'error');
        return;
    }
    
    try {
        // Aquí iría la llamada AJAX para enviar el ticket
        // Por ahora simulamos el envío
        mostrarNotificacion('Tu ticket de soporte ha sido enviado correctamente. Te notificaremos cuando recibamos una respuesta.', 'success');
        cerrarModalSoporte();
        
        // En una implementación real, aquí harías:
        // const response = await fetch('/api/soporte', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json',
        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //     },
        //     body: JSON.stringify({ asunto, mensaje })
        // });
        // const data = await response.json();
        
    } catch (error) {
        mostrarNotificacion('Error al enviar el ticket de soporte.', 'error');
    }
}

// Función para mostrar notificaciones
function mostrarNotificacion(mensaje, tipo = 'success') {
    if (!notificacionSoporte) return;
    
    const mensajeElement = document.getElementById('mensajeNotificacion');
    if (mensajeElement) mensajeElement.textContent = mensaje;
    
    // Cambiar color según el tipo
    const borderClass = tipo === 'success' ? 'border-green-500' : 'border-red-500';
    const iconClass = tipo === 'success' ? 'text-green-500' : 'text-red-500';
    
    notificacionSoporte.className = `fixed top-4 right-4 z-50 bg-white dark:bg-gray-800 border-l-4 ${borderClass} p-4 rounded-lg shadow-lg max-w-sm`;
    
    const icon = notificacionSoporte.querySelector('svg');
    if (icon) icon.className = `w-5 h-5 ${iconClass}`;
    
    notificacionSoporte.classList.remove('hidden');
    
    // Auto-ocultar después de 5 segundos
    setTimeout(() => {
        cerrarNotificacionSoporte();
    }, 5000);
}

// Función para cerrar notificación
function cerrarNotificacionSoporte() {
    if (notificacionSoporte) {
        notificacionSoporte.classList.add('hidden');
    }
}

// Cerrar modal al hacer clic fuera de él
document.addEventListener('click', function(event) {
    if (modalSoporte && event.target === modalSoporte) {
        cerrarModalSoporte();
    }
});

// Cerrar modal con Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && modalSoporte && !modalSoporte.classList.contains('hidden')) {
        cerrarModalSoporte();
    }
});
</script>
