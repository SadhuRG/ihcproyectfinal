<div>
    @if($category)
        <!-- Filtros y ordenamiento -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ $category->nombre }}
                </h2>
                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                    {{ $totalBooks }} {{ $totalBooks == 1 ? 'libro' : 'libros' }}
                </span>
            </div>

            <div class="flex items-center space-x-4">
                <label class="text-sm font-medium text-gray-700">Ordenar por:</label>
                <div class="flex space-x-2">
                    <button
                        wire:click="sortBy('titulo')"
                        class="px-4 py-2 text-sm rounded-lg transition-colors {{ $orderBy === 'titulo' ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Título
                        @if($orderBy === 'titulo')
                            <i class="fas fa-sort-{{ $orderDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                        @endif
                    </button>
                    <button
                        wire:click="sortBy('created_at')"
                        class="px-4 py-2 text-sm rounded-lg transition-colors {{ $orderBy === 'created_at' ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Fecha
                        @if($orderBy === 'created_at')
                            <i class="fas fa-sort-{{ $orderDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                        @endif
                    </button>
                </div>
            </div>
        </div>

        @if($books->count() > 0)
            <!-- Grid de libros -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-8">
                @foreach($books as $book)
                    <div class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">

                        <!-- ENLACE AL LIBRO INDIVIDUAL -->
                        <a href="/libro/{{ $book->id }}" class="block h-full flex flex-col justify-between">

                            <!-- CARÁTULA DEL LIBRO -->
                            <div class="w-24 h-32 mx-auto mb-4 rounded-lg shadow-lg overflow-hidden group-hover:scale-105 transition-transform duration-300">
                                @if($book->editions->first() && $book->editions->first()->url_portada && $book->editions->first()->hasCover())
                                    <img src="{{ $book->editions->first()->url_portada }}"
                                        alt="{{ $book->titulo }}"
                                        class="w-full h-full object-cover"
                                        loading="lazy"
                                        onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-purple-600 to-blue-600 flex items-center justify-center text-white text-2xl\'>📚</div>'">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-purple-600 to-blue-600 flex items-center justify-center text-white text-2xl">
                                        📚
                                    </div>
                                @endif
                            </div>

                            <!-- DESCUENTO SI EXISTE -->
                            @if($book->editions->first() && $book->editions->first()->precio_promocional)
                                @php
                                    $descuento = round((($book->editions->first()->precio - $book->editions->first()->precio_promocional) / $book->editions->first()->precio) * 100);
                                @endphp
                                <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                    -{{ $descuento }}%
                                </div>
                            @endif

                            <!-- TITULO -->
                            <h3 class="font-semibold text-gray-800 text-center mb-2 line-clamp-2 min-h-[3.5rem] group-hover:text-purple-600 transition-colors">
                                {{ $book->titulo }}
                            </h3>

                            <!-- AUTORES -->
                            <div class="text-center mb-2 min-h-[2rem]">
                                @if($book->authors->count() > 0)
                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ $book->authors->pluck('nombre')->implode(', ') }}
                                    </p>
                                @endif
                            </div>

                            <!-- INFORMACIÓN DE EDICIÓN -->
                            <div class="text-center mb-2 min-h-[2.5rem]">
                                @if($book->editions->first())
                                    <p class="text-xs text-gray-500">
                                        {{ $book->editions->first()->numero_edicion }}
                                        @if($book->editions->first()->editorial)
                                            • {{ $book->editions->first()->editorial->nombre }}
                                        @endif
                                    </p>
                                    @if($book->editions->count() > 1)
                                        <p class="text-xs text-purple-600">
                                            +{{ $book->editions->count() - 1 }} ediciones más
                                        </p>
                                    @endif
                                @endif
                            </div>

                            <!-- CALIFICACIÓN -->
                            <div class="flex justify-center mb-2 min-h-[1.5rem]">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="text-yellow-400">★</span>
                                @endfor
                            </div>

                            <!-- PRECIO -->
                            <div class="text-center min-h-[3.5rem] flex flex-col justify-center">
                                @if($book->editions->first() && $book->editions->first()->precio_promocional)
                                    <div class="space-y-1">
                                        <p class="text-green-600 font-bold text-lg">S/{{ number_format($book->editions->first()->precio_promocional, 2) }}</p>
                                        <p class="text-gray-400 text-sm line-through">S/{{ number_format($book->editions->first()->precio, 2) }}</p>
                                        <span class="inline-block bg-red-500 text-white text-xs px-2 py-1 rounded">
                                            -{{ $descuento }}%
                                        </span>
                                    </div>
                                @else
                                    <p class="text-purple-600 font-bold text-lg">S/{{ number_format($book->editions->first()->precio ?? 0, 2) }}</p>
                                @endif

                                <!-- STOCK -->
                                @if($book->editions->first() && $book->editions->first()->inventory)
                                    <p class="text-xs mt-1 {{ $book->editions->first()->inventory->cantidad > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $book->editions->first()->inventory->cantidad > 0 ? 'En stock' : 'Agotado' }}
                                    </p>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="mt-8">
                {{ $books->links() }}
            </div>
        @else
            <!-- Sin resultados -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <i class="fas fa-book-open text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">No se encontraron libros</h3>
                    <p class="text-gray-600 mb-6">No hay libros disponibles en esta categoría en este momento.</p>
                    <a href="/" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors">
                        Explorar otras categorías
                    </a>
                </div>
            </div>
        @endif
    @else
        <!-- Categoría no encontrada -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <i class="fas fa-exclamation-triangle text-6xl text-yellow-500 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Categoría no encontrada</h3>
                <p class="text-gray-600 mb-6">La categoría que buscas no existe o no está disponible.</p>
                <a href="/" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors">
                    Volver al inicio
                </a>
            </div>
        </div>
    @endif
</div>
