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
</div>
