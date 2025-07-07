<div class="min-h-screen bg-gray-50 py-8">
    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="container mx-auto px-4 mb-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="max-w-5xl mx-auto px-4">

        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm">
            <ol class="flex items-center space-x-2 text-gray-600">
                <li><a href="/" class="hover:text-purple-600">Inicio</a></li>
                <li class="text-gray-400">/</li>
                <li><a href="/libros" class="hover:text-purple-600">Libros</a></li>
                <li class="text-gray-400">/</li>
                <li class="text-purple-600">{{ $book->titulo }}</li>
            </ol>
        </nav>

        <!-- Main Book Detail Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
            <div class="grid md:grid-cols-2 gap-8 p-8">
                <!-- Book Cover -->
                <div class="space-y-4">
                    <div class="aspect-[3/4] bg-gradient-to-br from-purple-600 to-blue-600 rounded-lg shadow-lg flex items-center justify-center text-white text-6xl overflow-hidden">


                        @if($selectedEdition && $selectedEdition->url_portada && $selectedEdition->url_portada !== '/images/covers/default.jpg')
                            <img src="{{ $selectedEdition->url_portada }}" alt="{{ $book->titulo }}" class="w-full h-full object-cover">
                        @else
                            📚
                        @endif
                    </div>
                </div>

                <!-- Book Information -->
                <div class="space-y-6">
                    <!-- Title and Authors -->
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">{{ $book->titulo }}</h1>
                        <div class="flex flex-wrap items-center gap-2 text-gray-600 mb-2">
                            <span>Por:</span>
                            @foreach($book->authors as $author)
                                <span class="text-purple-600 font-medium">
                                    {{ $author->nombre }} {{ $author->apellido }}@if(!$loop->last), @endif
                                </span>
                            @endforeach
                        </div>
                        <p class="text-sm text-gray-500">ISBN: {{ $book->ISBN }}</p>
                    </div>

                    <!-- Rating -->
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="text-xl {{ $i <= $this->averageRating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                            @endfor
                        </div>
                        <span class="text-gray-600">
                            {{ number_format($this->averageRating, 1) }} ({{ $this->totalComments }} reseñas)
                        </span>
                    </div>

                    <!-- Categories -->
                    <div class="flex flex-wrap gap-2">
                        @foreach($book->categories as $category)
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">
                                {{ $category->nombre }}
                            </span>
                        @endforeach
                    </div>

                    <!-- Edition Selection -->
                    @if($book->editions->count() > 1)
                        <div class="space-y-3">
                            <h3 class="font-semibold text-gray-800">Seleccionar Edición:</h3>
                            <div class="space-y-2">
                                @foreach($book->editions as $edition)
                                    <label class="flex items-center p-2 border rounded-lg cursor-pointer hover:bg-gray-50 text-sm {{ $selectedEdition && $selectedEdition->id === $edition->id ? 'border-purple-600 bg-purple-50' : 'border-gray-200' }}">
                                        <input
                                            type="radio"
                                            wire:click="selectEdition({{ $edition->id }})"
                                            class="sr-only"
                                            {{ $selectedEdition && $selectedEdition->id === $edition->id ? 'checked' : '' }}>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium">{{ $edition->numero_edicion }}</span>
                                                <div class="text-right">
                                                    @if($edition->precio_promocional)
                                                        <span class="text-lg font-bold text-green-600">S/{{ $edition->precio_promocional }}</span>
                                                        <span class="text-sm text-gray-500 line-through ml-2">S/{{ $edition->precio }}</span>
                                                    @else
                                                        <span class="text-lg font-bold text-purple-600">S/{{ $edition->precio }}</span>
                                                    @endif
                                                </div>

                            @guest
                                <div class="text-center">
                                    <p class="text-sm text-gray-500">
                                        💡 <a href="{{ route('login') }}" class="text-purple-600 hover:underline">Inicia sesión</a>
                                        para agregar al carrito, favoritos y lista de deseos
                                    </p>
                                </div>
                            @endguest
                                            </div>
                                            <div class="text-sm text-gray-600">
                                                Editorial: {{ $edition->editorial->nombre ?? 'N/A' }} |
                                                Stock: {{ $edition->inventory->cantidad ?? 0 }}
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Price and Purchase -->
                    @if($selectedEdition)
                        <div class="bg-gray-50 rounded-lg p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    @if($selectedEdition->precio_promocional)
                                        <div class="flex items-center space-x-2">
                                            <span class="text-3xl font-bold text-green-600">S/{{ $selectedEdition->precio_promocional }}</span>
                                            <span class="text-lg text-gray-500 line-through">S/{{ $selectedEdition->precio }}</span>
                                            @if($this->discountPercentage > 0)
                                                <span class="bg-red-500 text-white px-2 py-1 rounded text-sm">
                                                    -{{ $this->discountPercentage }}%
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-3xl font-bold text-purple-600">S/{{ $selectedEdition->precio }}</span>
                                    @endif
                                    <p class="text-sm text-gray-600 mt-1">Stock disponible: {{ $selectedEdition->inventory->cantidad ?? 0 }}</p>
                                </div>
                            </div>

                            <!-- Quantity and Actions -->
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-2">
                                    <label class="text-sm font-medium text-gray-700">Cantidad:</label>
                                    <select wire:model="quantity" class="border rounded px-2 py-1 text-sm">

                                        @for($i = 1; $i <= min(10, $selectedEdition->inventory->cantidad ?? 0); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <!-- Botón principal - Agregar al carrito -->
                                <button
                                    wire:click="addToCart"
                                    class="w-full py-3 rounded-lg font-semibold transition-all duration-300 hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 {{ $this->isBookInCart() ? 'bg-green-600 hover:bg-green-700 text-white' : 'bg-purple-600 hover:bg-purple-700 text-white' }}"
                                    {{ ($selectedEdition->inventory->cantidad ?? 0) <= 0 ? 'disabled' : '' }}
                                    wire:loading.attr="disabled">
                                    @if(($selectedEdition->inventory->cantidad ?? 0) <= 0)
                                        ❌ Sin Stock
                                    @elseif($this->isBookInCart())
                                        <span wire:loading.remove>
                                            ✅ Agregar Más al Carrito
                                        </span>
                                        <span wire:loading>
                                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" fill="none" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle>
                                                <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" class="opacity-75"></path>
                                            </svg>
                                            Agregando...
                                        </span>
                                    @else
                                        <span wire:loading.remove>
                                            🛒 Agregar al Carrito
                                        </span>
                                        <span wire:loading>
                                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" fill="none" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle>
                                                <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" class="opacity-75"></path>
                                            </svg>
                                            Agregando...
                                        </span>
                                    @endif
                                </button>

                                <!-- Botones secundarios -->
                                <div class="grid grid-cols-2 gap-3">
                                    @auth
                                        <!-- Favoritos -->
                                        <button
                                            wire:click="toggleFavorite"
                                            class="w-full border-2 py-2.5 rounded-lg font-medium transition-all duration-300 hover:scale-105 {{ $isFavorite ? 'border-red-500 text-red-500 bg-red-50' : 'border-purple-600 text-purple-600 hover:bg-purple-50' }}"
                                            wire:loading.attr="disabled">
                                            <span wire:loading.remove wire:target="toggleFavorite">
                                                {{ $isFavorite ? '❤️ Favorito' : '🤍 Favoritos' }}
                                            </span>
                                            <span wire:loading wire:target="toggleFavorite">...</span>
                                        </button>

                                        <!-- Lista de deseos -->
                                        <button
                                            wire:click="toggleWishlist"
                                            class="w-full border-2 py-2.5 rounded-lg font-medium transition-all duration-300 hover:scale-105 {{ $isInWishlist ? 'border-blue-500 text-blue-500 bg-blue-50' : 'border-gray-400 text-gray-600 hover:bg-gray-50' }}"
                                            wire:loading.attr="disabled">
                                            <span wire:loading.remove wire:target="toggleWishlist">
                                                {{ $isInWishlist ? '📝 En Lista' : '📝 Deseos' }}
                                            </span>
                                            <span wire:loading wire:target="toggleWishlist">...</span>
                                        </button>
                                    @else
                                        <!-- Favoritos - Sin login -->
                                        <a href="{{ route('login') }}"
                                           class="w-full border-2 border-purple-600 text-purple-600 hover:bg-purple-50 py-2.5 rounded-lg font-medium transition-all duration-300 hover:scale-105 text-center inline-flex items-center justify-center">
                                            🤍 Favoritos
                                        </a>

                                        <!-- Lista de deseos - Sin login -->
                                        <a href="{{ route('login') }}"
                                           class="w-full border-2 border-gray-400 text-gray-600 hover:bg-gray-50 py-2.5 rounded-lg font-medium transition-all duration-300 hover:scale-105 text-center inline-flex items-center justify-center">
                                            📝 Deseos
                                        </a>
                                    @endauth
                                </div>
                            </div>

                            @if($selectedEdition->url_pdf)
                                <a href="{{ $selectedEdition->url_pdf }}" target="_blank"
                                   class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition-colors">
                                    📖 Vista Previa PDF
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tabs Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-8">
                    <button
                        wire:click="setActiveTab('description')"
                        class="py-4 border-b-2 font-medium text-sm {{ $activeTab === 'description' ? 'border-purple-600 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                        Descripción
                    </button>
                    <button
                        wire:click="setActiveTab('reviews')"
                        class="py-4 border-b-2 font-medium text-sm {{ $activeTab === 'reviews' ? 'border-purple-600 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                        Reseñas ({{ $this->totalComments }})
                    </button>
                    <button
                        wire:click="setActiveTab('details')"
                        class="py-4 border-b-2 font-medium text-sm {{ $activeTab === 'details' ? 'border-purple-600 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                        Detalles
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-8">
                @if($activeTab === 'description')
                    <div class="prose max-w-none">
                        <p class="text-gray-700 leading-relaxed">
                            {{ $book->descripcion ?: 'No hay descripción disponible para este libro.' }}
                        </p>
                    </div>
                @elseif($activeTab === 'reviews')
                    <div class="space-y-6">
                        <!-- Add Review Form -->
                        @auth
                            @if(!$hasUserCommented)
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h3 class="text-lg font-semibold mb-4">Escribe tu reseña</h3>
                                    <form wire:submit.prevent="submitComment" class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Calificación *</label>
                                            <div class="flex space-x-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <button
                                                        type="button"
                                                        wire:click="$set('newRating', {{ $i }})"
                                                        class="text-2xl transition-colors {{ $newRating >= $i ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400">
                                                        ★
                                                    </button>
                                                @endfor
                                            </div>
                                            @error('newRating')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Comentario *</label>
                                            <textarea
                                                wire:model="newComment"
                                                rows="4"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                                placeholder="Comparte tu opinión sobre este libro... (mínimo 10 caracteres)"></textarea>
                                            @error('newComment')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                            <p class="text-sm text-gray-500 mt-1">
                                                Caracteres: {{ strlen($newComment ?? '') }}/1000
                                            </p>
                                        </div>

                                        <button
                                            type="submit"
                                            class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                            wire:loading.attr="disabled">
                                            <span wire:loading.remove>Publicar Reseña</span>
                                            <span wire:loading>Publicando...</span>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="bg-blue-50 rounded-lg p-6 text-center">
                                    <div class="text-blue-600 text-lg mb-2">✅ Ya has reseñado este libro</div>
                                    <p class="text-blue-700">Gracias por compartir tu opinión con otros lectores.</p>
                                </div>
                            @endif
                        @else
                            <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-lg p-6 text-center border border-purple-200">
                                <div class="text-purple-600 mb-4">
                                    <svg class="w-12 h-12 mx-auto text-purple-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.915a1 1 0 00.95-.69l1.519-4.674z"></path>
                                    </svg>
                                    <p class="text-lg font-semibold text-purple-700">¿Te gustó este libro?</p>
                                </div>
                                <p class="text-purple-600 mb-4">
                                    Comparte tu experiencia y ayuda a otros lectores a descubrir grandes historias.
                                </p>
                                <div class="flex justify-center space-x-3">
                                    <a href="{{ route('login') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold transition-colors inline-flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        Iniciar Sesión
                                    </a>
                                    <a href="{{ route('register') }}" class="border border-purple-600 text-purple-600 hover:bg-purple-50 px-6 py-2 rounded-lg font-semibold transition-colors">
                                        Crear Cuenta
                                    </a>
                                </div>
                            </div>
                        @endauth

                        <!-- Reviews List -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-800">
                                    Reseñas de lectores ({{ $this->totalComments }})
                                </h3>
                                @if($this->totalComments > 0)
                                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                                        <span>Promedio:</span>
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="text-yellow-400">{{ $i <= $this->averageRating ? '★' : '☆' }}</span>
                                            @endfor
                                            <span class="ml-1 font-medium">{{ number_format($this->averageRating, 1) }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @forelse($book->comments as $comment)
                                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-lg">
                                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-2">
                                                <div>
                                                    <h4 class="font-semibold text-gray-800">
                                                        {{ $comment->user->name }} {{ $comment->user->apellido }}
                                                    </h4>
                                                    <div class="flex items-center space-x-2">
                                                        <div class="flex">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <span class="text-yellow-400">{{ $i <= $comment->puntuacion ? '★' : '☆' }}</span>
                                                            @endfor
                                                        </div>
                                                        <span class="text-sm text-gray-500">
                                                            @if($comment->fecha_valoracion)
                                                                {{ \Carbon\Carbon::parse($comment->fecha_valoracion)->format('d/m/Y') }}
                                                            @else
                                                                {{ $comment->created_at ? $comment->created_at->format('d/m/Y') : 'Sin fecha' }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>

                                                @if($comment->puntuacion >= 4)
                                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                                        Recomendado
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-gray-700 leading-relaxed">{{ $comment->comentario }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-gray-500 py-12">
                                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.959 8.959 0 01-4.906-1.456L3 21l2.544-5.094A8.959 8.959 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"></path>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-600 mb-2">Aún no hay reseñas</h3>
                                    <p class="text-gray-500">¡Sé el primero en compartir tu opinión sobre este libro!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @elseif($activeTab === 'details')
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-800">Información del Libro</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">ISBN:</span>
                                    <span class="font-medium">{{ $book->ISBN }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Autores:</span>
                                    <span class="font-medium">
                                        @foreach($book->authors as $author)
                                            {{ $author->nombre }} {{ $author->apellido }}@if(!$loop->last), @endif
                                        @endforeach
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Categorías:</span>
                                    <span class="font-medium">
                                        @foreach($book->categories as $category)
                                            {{ $category->nombre }}@if(!$loop->last), @endif
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                        </div>

                        @if($selectedEdition)
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-gray-800">Información de la Edición</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Edición:</span>
                                        <span class="font-medium">{{ $selectedEdition->numero_edicion }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Editorial:</span>
                                        <span class="font-medium">{{ $selectedEdition->editorial->nombre ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Stock:</span>
                                        <span class="font-medium">{{ $selectedEdition->inventory->cantidad ?? 0 }} unidades</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Precio:</span>
                                        <span class="font-medium">S/{{ $selectedEdition->precio }}</span>
                                    </div>
                                    @if($selectedEdition->precio_promocional)
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Precio Promocional:</span>
                                            <span class="font-medium text-green-600">S/{{ $selectedEdition->precio_promocional }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
