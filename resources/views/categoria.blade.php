<x-layouts.app>
    <x-horizontal-categories-menu />

    <!-- Header de la categoría -->
    <section class="bg-gradient-to-r from-purple-600 to-blue-600 py-16">
        <div class="container mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                {{ $categoria }}
            </h1>
            <p class="text-xl opacity-90">
                Descubre los mejores libros en esta categoría
            </p>
        </div>
    </section>

    <!-- Libros de la categoría -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <livewire:books.category-books :categoria="$categoria" />
        </div>
    </section>

</x-layouts.app>
