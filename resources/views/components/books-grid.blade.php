@props(['title', 'books'])

<section class="py-16 px-4">
    <div class="container mx-auto">

        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">{{ $title }}</h2>
                <div class="w-20 h-1 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-12">
            @foreach ($books as $book)
                <div class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden relative">
                    <div class="w-24 h-32 mx-auto mb-4 bg-gradient-to-br from-purple-600 to-blue-600 rounded-lg shadow-lg flex items-center justify-center text-white text-2xl group-hover:scale-105 transition-transform duration-300">
                        📚
                    </div>
                    <h3 class="font-semibold text-gray-800 text-center mb-2 line-clamp-2">{{ $book->titulo }}</h3>
                    <div class="flex justify-center mb-2 text-yellow-400">
                        {!! str_repeat('★', $book->rating ?? 5) !!}
                    </div>
                    <p class="text-purple-600 font-bold text-center text-lg">S/{{ $book->precio_minimo }}</p>

                    <button class="w-full mt-4 bg-purple-600 hover:bg-purple-700 text-white py-2 rounded-full transition-all duration-300 hover:scale-105">
                        Agregar al carrito
                    </button>
                </div>
            @endforeach
        </div>

    </div>
</section>
