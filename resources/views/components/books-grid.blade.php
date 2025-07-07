@props(['title', 'books'])

<section class="py-5 px-4">
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">{{ $title }}</h2>
                <div class="w-20 h-1 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-2">
            @foreach ($books as $book)
                <div class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">

                    <!-- ENLACE AL LIBRO INDIVIDUAL -->
                    <a href="/libro/{{ $book->id }}" class="block h-full flex flex-col justify-between">

                        <!-- CARÁTULA DEL LIBRO -->
                        <div class="w-24 h-32 mx-auto mb-4 rounded-lg shadow-lg overflow-hidden group-hover:scale-105 transition-transform duration-300">
                            @if($book->cheapest_edition && $book->cheapest_edition->url_portada && $book->cheapest_edition->url_portada !== '/images/covers/default.jpg')
                                <img src="{{ $book->cheapest_edition->url_portada }}"
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
                            @if($book->cheapest_edition)
                                <p class="text-xs text-gray-500">
                                    {{ $book->cheapest_edition->numero_edicion }}
                                    @if($book->cheapest_edition->editorial)
                                        • {{ $book->cheapest_edition->editorial->nombre }}
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
                            {!! str_repeat('★', 5) !!}
                        </div>

                        <!-- PRECIO -->
                        <div class="text-center min-h-[3.5rem] flex flex-col justify-center">
                            @if($book->cheapest_edition && $book->cheapest_edition->precio_promocional)
                                <div class="space-y-1">
                                    <p class="text-green-600 font-bold text-lg">S/{{ $book->cheapest_edition->precio_promocional }}</p>
                                    <p class="text-gray-400 text-sm line-through">S/{{ $book->precio_minimo }}</p>
                                    <span class="inline-block bg-red-500 text-white text-xs px-2 py-1 rounded">
                                        -{{ round((($book->precio_minimo - $book->cheapest_edition->precio_promocional) / $book->precio_minimo) * 100) }}%
                                    </span>
                                </div>
                            @else
                                <p class="text-purple-600 font-bold text-lg">S/{{ $book->precio_minimo }}</p>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
