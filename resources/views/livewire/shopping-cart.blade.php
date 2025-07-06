<!-- resources/views/livewire/shopping-cart.blade.php -->
<div>
    <!-- Botón del carrito -->
    <button
        wire:click="toggleCart"
        class="relative p-2 bg-rose-500 hover:bg-rose-600 text-white rounded-full transition-all duration-300 hover:scale-110 hover:shadow-lg"
        aria-label="Ver carrito de compras">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0a2 2 0 012 2v4a2 2 0 01-2 2h-4a2 2 0 01-2-2v-4a2 2 0 012-2h4z"></path>
        </svg>
        <!-- Contador del carrito -->
        <span class="absolute -top-1 -right-1 bg-white text-rose-500 text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center transition-all duration-300 {{ $cartCount > 0 ? 'opacity-100 scale-100' : 'opacity-0 scale-0' }}">
            {{ $cartCount }}
        </span>
    </button>

    <!-- Panel del carrito (slide-out) -->
    @if($showCart)
        <div class="fixed inset-0 z-50">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black bg-opacity-50" wire:click="closeCart"></div>

            <!-- Panel del carrito -->
            <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-xl transform transition-transform duration-300 translate-x-0">
                <!-- Header del carrito -->
                <div class="flex items-center justify-between p-4 border-b border-gray-200 bg-gradient-to-r from-purple-600 to-blue-600 text-white">
                    <h2 class="text-lg font-semibold">🛒 Tu Carrito</h2>
                    <button wire:click="closeCart" class="p-2 hover:bg-white/20 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Contenido del carrito -->
                <div class="flex flex-col h-full">
                    <!-- Lista de productos -->
                    <div class="flex-1 overflow-y-auto p-4">
                        @if(count($cartItems) > 0)
                            <div class="space-y-4">
                                @foreach($cartItems as $key => $item)
                                    <div wire:key="cart-item-{{ $key }}"
                                         x-data="{
                                            localQuantity: {{ $item['quantity'] ?? 1 }},
                                            updating: false
                                         }"
                                         class="flex items-start space-x-3 bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition-colors">
                                        <!-- Imagen del libro -->
                                        <div class="w-16 h-20 bg-gradient-to-br from-purple-600 to-blue-600 rounded-lg shadow-sm flex items-center justify-center text-white text-xs overflow-hidden flex-shrink-0">
                                            @if(($item['cover_url'] ?? '') && $item['cover_url'] !== '/images/covers/default.jpg')
                                                <img src="{{ $item['cover_url'] }}" alt="{{ $item['book_title'] ?? 'Libro' }}" class="w-full h-full object-cover">
                                            @else
                                                📚
                                            @endif
                                        </div>

                                        <!-- Información del producto -->
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-medium text-gray-900 text-sm line-clamp-2 leading-tight">{{ $item['book_title'] ?? 'Libro sin título' }}</h3>
                                            <p class="text-xs text-gray-600 mt-1">{{ $item['edition_number'] ?? $item['edition_name'] ?? '1ra edición' }} - {{ $item['editorial'] ?? 'Editorial no especificada' }}</p>

                                            <!-- Precio -->
                                            <div class="flex items-center space-x-2 mt-1">
                                                @if(($item['price'] ?? 0) < ($item['original_price'] ?? 0))
                                                    <span class="text-green-600 font-semibold text-sm">S/{{ $item['price'] ?? 0 }}</span>
                                                    <span class="text-gray-400 line-through text-xs">S/{{ $item['original_price'] ?? 0 }}</span>
                                                @else
                                                    <span class="text-purple-600 font-semibold text-sm">S/{{ $item['price'] ?? 0 }}</span>
                                                @endif
                                            </div>

                                            <!-- Controles de cantidad -->
                                            <div class="flex items-center justify-between mt-2">
                                                <div class="flex items-center space-x-1">
                                                    <button
                                                        @click="
                                                            if (localQuantity > 1) {
                                                                localQuantity--;
                                                                updating = true;
                                                                $wire.call('updateQuantity', '{{ $item['edition_id'] ?? 0 }}', localQuantity)
                                                                    .then(() => { updating = false; });
                                                            } else {
                                                                updating = true;
                                                                $wire.call('removeItem', '{{ $item['edition_id'] ?? 0 }}')
                                                                    .then(() => { updating = false; });
                                                            }
                                                        "
                                                        :disabled="updating"
                                                        :class="updating ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-300'"
                                                        class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-sm font-medium">
                                                        <span x-show="!updating">−</span>
                                                        <span x-show="updating" class="animate-spin">⟳</span>
                                                    </button>

                                                    <span class="w-8 text-center text-sm font-medium" x-text="localQuantity"></span>

                                                    <button
                                                        @click="
                                                            if (localQuantity < 10) {
                                                                localQuantity++;
                                                                updating = true;
                                                                $wire.call('updateQuantity', '{{ $item['edition_id'] ?? 0 }}', localQuantity)
                                                                    .then(() => { updating = false; });
                                                            }
                                                        "
                                                        :disabled="updating || localQuantity >= 10"
                                                        :class="updating || localQuantity >= 10 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-300'"
                                                        class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-sm font-medium">
                                                        <span x-show="!updating">+</span>
                                                        <span x-show="updating" class="animate-spin">⟳</span>
                                                    </button>
                                                </div>

                                                <!-- Botón eliminar -->
                                                <button
                                                    @click="
                                                        updating = true;
                                                        $wire.call('removeItem', '{{ $item['edition_id'] ?? 0 }}')
                                                            .then(() => { updating = false; });
                                                    "
                                                    :disabled="updating"
                                                    :class="updating ? 'opacity-50 cursor-not-allowed' : 'hover:text-red-700'"
                                                    class="text-red-500 text-xs font-medium">
                                                    <span x-show="!updating">Eliminar</span>
                                                    <span x-show="updating">...</span>
                                                </button>
                                            </div>

                                            @if(($item['quantity'] ?? 0) >= 10)
                                                <p class="text-xs text-orange-600 mt-1">Cantidad máxima por compra: 10</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- Carrito vacío -->
                            <div class="text-center py-12">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0a2 2 0 012 2v4a2 2 0 01-2 2h-4a2 2 0 01-2-2v-4a2 2 0 012-2h4z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Tu carrito está vacío</h3>
                                <p class="text-gray-500 mb-4">Agrega algunos libros para empezar</p>
                                <a href="/libros" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold transition-colors">
                                    Explorar Libros
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Footer del carrito (resumen y acciones) -->
                    @if(count($cartItems) > 0)
                        <div class="border-t border-gray-200 p-4 bg-white">
                            <!-- Total -->
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-lg font-semibold text-gray-900">Total:</span>
                                <span class="text-xl font-bold text-purple-600">S/{{ number_format($cartTotal, 2) }}</span>
                            </div>

                            <!-- Botones de acción -->
                            <div class="space-y-2">
                                @auth
                                    <button class="w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white py-3 rounded-lg font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                                        Proceder al Checkout
                                    </button>
                                    <button
                                        wire:click="$call('clearCart')"
                                        class="w-full border border-gray-300 text-gray-700 hover:bg-gray-50 py-2 rounded-lg font-medium transition-colors"
                                        onclick="return confirm('¿Estás seguro de que quieres vaciar el carrito?')">
                                        Vaciar Carrito
                                    </button>
                                @else
                                    <div class="text-center mb-3">
                                        <p class="text-sm text-gray-600 mb-2">Inicia sesión para continuar con tu compra</p>
                                    </div>
                                    <a href="{{ route('login') }}" class="block w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white py-3 rounded-lg font-semibold transition-all duration-300 hover:scale-105 shadow-lg text-center">
                                        Iniciar Sesión
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
