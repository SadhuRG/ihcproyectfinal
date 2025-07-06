<div x-data="{ open: false }"
     x-init="open = false"
     @close-cart-dropdown.window="open = false"
     class="relative">

    <!-- Cart Button -->
    <button
        @click="open = !open"
        class="relative p-2 bg-rose-500 hover:bg-rose-600 text-white rounded-full transition-all duration-300 hover:scale-110 hover:shadow-lg"
        aria-label="Ver carrito de compras">

        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0a2 2 0 012 2v4a2 2 0 01-2 2h-4a2 2 0 01-2-2v-4a2 2 0 012-2h4z"></path>
        </svg>

        @if($cartCount > 0)
            <span class="absolute -top-1 -right-1 bg-white text-rose-500 text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center animate-pulse">
                {{ $cartCount }}
            </span>
        @endif
    </button>

    <!-- Dropdown Cart - Oculto por defecto -->
    <div
        x-show="open"
        x-cloak
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 transform translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-2xl border border-gray-200 z-50 overflow-hidden">

        @if($cartCount > 0)
            <!-- Header con estilo consistente -->
            <div class="px-4 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <span class="text-lg">🛒</span>
                        <span class="font-semibold">
                            Hola, {{ auth()->check() ? auth()->user()->name : 'Usuario' }}
                        </span>
                    </div>
                    <span class="text-sm opacity-90">Mi cuenta</span>
                </div>
                <div class="mt-1 text-sm opacity-90">
                    Total S/{{ number_format($cartTotal, 2) }} • {{ $cartCount }} items
                </div>
            </div>

            <!-- Ver y Editar Carrito Button -->
            <div class="p-4 border-b border-gray-100">
                <a href="/carrito"
                   @click="open = false"
                   class="block w-full text-center py-2.5 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-semibold transition-all duration-300 hover:shadow-md">
                    VER Y EDITAR CARRITO
                </a>
            </div>

            <!-- Items del carrito -->
            <div class="max-h-64 overflow-y-auto">
                @foreach($cartItems as $key => $item)
                    <div class="px-4 py-3 border-b border-gray-50 hover:bg-purple-50 transition-colors duration-200">
                        <div class="flex items-center space-x-3">
                            <!-- Imagen del libro -->
                            <div class="w-12 h-16 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-lg flex items-center justify-center text-white font-bold flex-shrink-0 shadow-md">
                                @if(isset($item['cover_url']) && $item['cover_url'] && $item['cover_url'] !== '/images/covers/default.jpg')
                                    <img src="{{ $item['cover_url'] }}"
                                         alt="{{ $item['book_title'] }}"
                                         class="w-full h-full object-cover rounded-lg">
                                @else
                                    📚
                                @endif
                            </div>

                            <!-- Info del libro -->
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-semibold text-gray-800 truncate mb-1">
                                    {{ $item['book_title'] }}
                                </h4>
                                <p class="text-xs text-gray-500 mb-1">
                                    {{ $item['edition_number'] ?? 'Edición' }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-bold text-purple-600">
                                        S/{{ number_format($item['price'], 2) }}
                                    </span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-500 border border-gray-300 px-2 py-1 rounded">
                                            {{ $item['quantity'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Botón eliminar -->
                            <button
                                wire:click.prevent="removeItem({{ json_encode($key) }})"
                                class="text-red-500 hover:text-red-700 hover:bg-red-50 p-1 rounded-full transition-all duration-200"
                                title="Eliminar producto">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Footer con botón de compra -->
            <div class="p-4 bg-gray-50">
                <a href="/checkout"
                   @click="open = false"
                   class="block w-full text-center py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white rounded-lg font-semibold transition-all duration-300 hover:shadow-lg transform hover:scale-105">
                    PROCEDER CON LA COMPRA
                </a>
            </div>
        @else
            <!-- Carrito vacío -->
            <div class="p-6 text-center">
                <div class="text-gray-300 text-4xl mb-3">🛒</div>
                <h4 class="text-lg font-semibold text-gray-600 mb-2">Tu carrito está vacío</h4>
                <p class="text-gray-500 text-sm mb-4">¡Descubre nuestros increíbles libros!</p>
                <a href="/"
                   @click="open = false"
                   class="inline-block px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white rounded-lg text-sm font-semibold transition-all duration-300 hover:shadow-md">
                    Explorar libros
                </a>
            </div>
        @endif
    </div>
</div>


@push('scripts')
<script>
    // Backup para actualizar contador si Livewire falla
    document.addEventListener('livewire:navigated', function() {
        // Forzar actualización del carrito
        Livewire.dispatch('refreshCart');
    });

    // Escuchar eventos personalizados
    document.addEventListener('livewire:init', () => {
        Livewire.on('cart-count-updated', (event) => {
            console.log('Cart updated:', event.count);
        });
    });
</script>
@endpush
