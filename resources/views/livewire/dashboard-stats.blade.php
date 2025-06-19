<div>
    <x-section-title title="DASHBOARD" />

    <!-- CARDS DE MÉTRICAS CON DATOS REALES -->
    <div class="grid grid-cols-4 gap-6 pl-10 pr-20 ml-1 mr-3">
        <!-- Ventas del día -->
        <div class="bg-white px-4 py-4 rounded-md shadow-md bg-transparent text-[#000000] flex items-center flex-1">
            <div>
                <h1 class="ml-3 mb-3 text-xs md:text-sm lg:text-sm text-[#636466]">Ventas del día</h1>
                <h1 class="ml-3 font-medium text-xs md:text-sm lg:text-lg">S/ {{ number_format($ventasDelDia, 2) }}</h1>
            </div>
            <div class="bg-[#E5E4FF] p-4 py-4 rounded-lg ml-auto">
                <img src="{{asset('/imagenes/icons/1.svg')}}" alt="Ventas Icon" class="w-10 h-10">
            </div>
        </div>

        <!-- Total libros vendidos -->
        <div class="bg-white px-4 py-2 rounded-md shadow-md bg-transparent text-black flex items-center flex-1">
            <div>
                <h1 class="ml-3 mb-3 text-xs md:text-sm lg:text-sm text-[#636466]">Total de Libros vendidos</h1>
                <h1 class="ml-3 font-medium text-xs md:text-sm lg:text-lg">{{ number_format($totalLibrosVendidos) }}</h1>
            </div>
            <div class="bg-[#FFF3D6] p-4 py-4 rounded-lg ml-auto">
                <img src="{{asset('/imagenes/icons/2.svg')}}" alt="Libros Icon" class="w-10 h-10">
            </div>
        </div>

        <!-- Total usuarios -->
        <div class="bg-white px-4 py-2 rounded-md shadow-md bg-transparent text-black flex items-center flex-1">
            <div>
                <h1 class="ml-3 mb-3 text-xs md:text-sm lg:text-sm text-[#636466]">Usuarios Registrados</h1>
                <h1 class="ml-3 font-medium text-xs md:text-sm lg:text-lg">{{ number_format($totalUsuarios) }}</h1>
            </div>
            <div class="bg-[#E5E4FF] p-4 py-4 rounded-lg ml-auto">
                <img src="{{asset('/imagenes/icons/3.svg')}}" alt="Usuarios Icon" class="w-10 h-10">
            </div>
        </div>

        <!-- Libros disponibles -->
        <div class="bg-white px-4 py-2 rounded-md shadow-md bg-transparent text-black flex items-center flex-1">
            <div>
                <h1 class="ml-3 mb-3 text-xs md:text-sm lg:text-sm text-[#636466]">Libros en Stock</h1>
                <h1 class="ml-3 font-medium text-xs md:text-sm lg:text-lg">{{ number_format($librosDisponibles) }}</h1>
            </div>
            <div class="bg-[#FFDED1] p-4 py-4 rounded-lg ml-auto">
                <img src="{{asset('/imagenes/icons/4.svg')}}" alt="Stock Icon" class="w-10 h-10">
            </div>
        </div>
    </div>

    <!-- GRÁFICOS CON DATOS REALES -->
    <div class="mx-10 mt-5 grid grid-cols-1 md:grid-cols-2 gap-10 justify-center items-start">
        <!-- GRÁFICO DE CATEGORÍAS -->
        <div class="w-full bg-white rounded-lg shadow-sm p-4 md:p-6">
            <div class="flex justify-between pb-4 mb-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center me-3">
                        <img src="{{ asset('icons/libro.jpg') }}" alt="Libro" class="w-8 h-8">
                    </div>
                    <div>
                        <h4 class="leading-none text-1xl font-bold text-gray-900 pb-1">
                            Categorías más vendidas
                        </h4>
                    </div>
                </div>
            </div>
            <div id="categorias-chart" class="w-full min-h-[320px]"></div>
        </div>

        <!-- GRÁFICO DE VENTAS MENSUALES -->
        <div class="w-full bg-white rounded-lg shadow-sm p-4 md:p-6">
            <div class="flex justify-between pb-4 mb-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center me-3">
                        <img src="{{ asset('icons/libro.jpg') }}" alt="Ventas" class="w-8 h-8">
                    </div>
                    <div>
                        <h4 class="leading-none text-1xl font-bold text-gray-900 pb-1">
                            Ventas mensuales {{ date('Y') }}
                        </h4>
                    </div>
                </div>
            </div>
            <div id="ventas-mensuales-chart" class="w-full min-h-[320px]"></div>
        </div>
    </div>

    <!-- SCRIPT PARA GRÁFICOS CON DATOS REALES -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Gráfico de categorías CON DATOS REALES
            const categoriasData = @json($ventasPorCategoria);
            const categoriasOptions = {
                series: [{
                    name: "Libros Vendidos",
                    data: categoriasData.map(item => item.total_vendido)
                }],
                chart: {
                    type: "bar",
                    height: 320,
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "70%",
                        endingShape: "rounded"
                    }
                },
                colors: ["#1A56DB"],
                dataLabels: { enabled: false },
                xaxis: {
                    categories: categoriasData.map(item => item.nombre),
                    labels: {
                        style: { fontSize: "12px", colors: "#333" }
                    }
                },
                yaxis: {
                    title: { text: "Libros Vendidos" },
                    labels: {
                        style: { fontSize: "12px", colors: "#333" }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) { return val + " libros"; }
                    },
                    theme: 'dark'
                }
            };

            // Gráfico de ventas mensuales CON DATOS REALES
            const ventasOptions = {
                series: [{
                    name: "Ventas (S/)",
                    data: @json($ventasMensuales)
                }],
                chart: {
                    type: "line",
                    height: 320,
                    toolbar: { show: false }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                colors: ["#00E396"],
                dataLabels: { enabled: false },
                xaxis: {
                    categories: [
                        "Ene", "Feb", "Mar", "Abr", "May", "Jun",
                        "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"
                    ],
                    labels: {
                        style: { fontSize: "12px", colors: "#333" }
                    }
                },
                yaxis: {
                    title: { text: "Ventas (S/)" },
                    labels: {
                        style: { fontSize: "12px", colors: "#333" },
                        formatter: function(val) { return "S/ " + val.toFixed(0); }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) { return "S/ " + val.toFixed(2); }
                    },
                    theme: 'dark'
                }
            };

            // Renderizar gráficos
            new ApexCharts(document.querySelector("#categorias-chart"), categoriasOptions).render();
            new ApexCharts(document.querySelector("#ventas-mensuales-chart"), ventasOptions).render();
        });
    </script>

    <!-- SECCIÓN DE RESUMEN CORREGIDA -->
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

                <!-- Libros más vendidos - CORREGIDO -->
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2">Libros Más Vendidos</h4>
                    @php
                        // CONSULTA CORREGIDA - Sin GROUP BY problemático
                        $librosMasVendidos = \DB::table('books')
                            ->select(
                                'books.id',
                                'books.titulo',
                                \DB::raw('SUM(edition_order.cantidad) as total_vendido')
                            )
                            ->join('editions', 'books.id', '=', 'editions.book_id')
                            ->join('edition_order', 'editions.id', '=', 'edition_order.edition_id')
                            ->join('orders', 'edition_order.order_id', '=', 'orders.id')
                            ->where('orders.estado', 1)
                            ->groupBy('books.id', 'books.titulo') // ← INCLUIR titulo en GROUP BY
                            ->orderBy('total_vendido', 'desc')
                            ->limit(5)
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

                <!-- Stock bajo - CORREGIDO -->
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2">Stock Bajo</h4>
                    @php
                        // CONSULTA CORREGIDA - Usando Query Builder para mayor control
                        $stockBajo = \DB::table('editions')
                            ->select(
                                'books.titulo',
                                'inventories.cantidad',
                                'inventories.umbral'
                            )
                            ->join('books', 'editions.book_id', '=', 'books.id')
                            ->join('inventories', 'editions.inventorie_id', '=', 'inventories.id')
                            ->whereRaw('inventories.cantidad <= inventories.umbral')
                            ->limit(5)
                            ->get();
                    @endphp
                    <div class="space-y-2">
                        @forelse($stockBajo as $item)
                            <div class="text-sm">
                                <span class="block font-medium">{{ Str::limit($item->titulo, 20) }}</span>
                                <span class="text-red-500">{{ $item->cantidad }} restantes</span>
                            </div>
                        @empty
                            <p class="text-green-500 text-sm">Stock saludable</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
