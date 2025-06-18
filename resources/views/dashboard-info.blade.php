<!-- REEMPLAZAR TODO EL CONTENIDO DE dashboard-info.blade.php CON ESTO: -->

@livewire('dashboard-stats')

<!-- Opcional: Agregar más secciones con datos reales -->
<div class="mx-10 mt-10">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Resumen Rápido</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Últimas órdenes -->
            <div>
                <h4 class="font-semibold text-gray-700 mb-2">Últimas Órdenes</h4>
                @php
                    $ultimasOrdenes = \App\Models\Order::with('user')
                        ->latest('fecha_orden')
                        ->take(5)
                        ->get();
                @endphp
                <div class="space-y-2">
                    @forelse($ultimasOrdenes as $orden)
                        <div class="flex justify-between text-sm">
                            <span>{{ $orden->user->name }}</span>
                            <span class="font-medium">S/ {{ number_format($orden->total, 2) }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">No hay órdenes aún</p>
                    @endforelse
                </div>
            </div>

            <!-- Libros más vendidos -->
            <div>
                <h4 class="font-semibold text-gray-700 mb-2">Libros Más Vendidos</h4>
                @php
                    $librosMasVendidos = \App\Models\Book::select('books.*')
                        ->join('editions', 'books.id', '=', 'editions.book_id')
                        ->join('edition_order', 'editions.id', '=', 'edition_order.edition_id')
                        ->selectRaw('SUM(edition_order.cantidad) as total_vendido')
                        ->groupBy('books.id')
                        ->orderBy('total_vendido', 'desc')
                        ->take(5)
                        ->get();
                @endphp
                <div class="space-y-2">
                    @forelse($librosMasVendidos as $libro)
                        <div class="text-sm">
                            <span class="block font-medium">{{ Str::limit($libro->titulo, 25) }}</span>
                            <span class="text-gray-500">{{ $libro->total_vendido }} vendidos</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">No hay ventas aún</p>
                    @endforelse
                </div>
            </div>

            <!-- Stock bajo -->
            <div>
                <h4 class="font-semibold text-gray-700 mb-2">Stock Bajo</h4>
                @php
                    $stockBajo = \App\Models\Edition::with(['book', 'inventory'])
                        ->whereHas('inventory', function($q) {
                            $q->whereRaw('cantidad <= umbral');
                        })
                        ->take(5)
                        ->get();
                @endphp
                <div class="space-y-2">
                    @forelse($stockBajo as $edition)
                        <div class="text-sm">
                            <span class="block font-medium">{{ Str::limit($edition->book->titulo, 20) }}</span>
                            <span class="text-red-500">{{ $edition->inventory->cantidad }} restantes</span>
                        </div>
                    @empty
                        <p class="text-green-500 text-sm">Stock saludable</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
