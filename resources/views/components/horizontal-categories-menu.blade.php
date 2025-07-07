<div class="bg-white border-b border-gray-200 shadow-sm">
    <div class="container mx-auto px-4">
        <!-- Desktop Menu -->
        <nav class="hidden lg:flex items-center space-x-1 py-3" x-data="{
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

        </nav>

        <!-- Mobile Menu (sin cambios) -->
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

                <a href="/categorias" class="block px-4 py-3 text-purple-600 hover:bg-purple-50 transition-colors rounded-lg font-medium text-center border border-purple-200">
                    Ver Todas las Categorías →
                </a>
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
