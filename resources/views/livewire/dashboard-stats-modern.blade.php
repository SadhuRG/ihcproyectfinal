<div class="space-y-8">
    <!-- Header con saludo dinámico -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
        <div class="flex-1">
            <h1 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-gray-800 via-blue-600 to-purple-600 bg-clip-text text-transparent">
                @php
                    $hour = now()->hour;
                    if ($hour < 12) echo "¡Buenos días!";
                    elseif ($hour < 18) echo "¡Buenas tardes!";
                    else echo "¡Buenas noches!";
                @endphp
            </h1>
            <p class="text-gray-600 mt-2">Aquí tienes un resumen de tu librería hoy, {{ now()->format('d \d\e F \d\e Y') }}</p>
        </div>
        <div class="mt-4 lg:mt-0">
            <div class="backdrop-blur-xl bg-gradient-to-r from-blue-500/20 to-purple-500/20 border border-white/30 rounded-2xl px-6 py-3 shadow-xl">
                <div class="flex items-center space-x-3">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium text-gray-700">Sistema Operativo</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards de métricas principales con glassmorphism -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <!-- Ventas del día -->
        <div class="group relative backdrop-blur-xl bg-gradient-to-br from-emerald-500/20 to-teal-500/20 border border-white/30 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:scale-105 overflow-hidden">
            <!-- Elementos decorativos -->
            <div class="absolute -top-10 -right-10 w-20 h-20 bg-emerald-500/20 rounded-full blur-xl group-hover:bg-emerald-500/30 transition-colors duration-500"></div>
            <div class="absolute -bottom-10 -left-10 w-20 h-20 bg-teal-500/20 rounded-full blur-xl group-hover:bg-teal-500/30 transition-colors duration-500"></div>

            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    @if($crecimientoVentas > 0)
                    <div class="flex items-center text-emerald-600 text-sm font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                        </svg>
                        +{{ $crecimientoVentas }}%
                    </div>
                    @endif
                </div>
                <h3 class="text-sm font-medium text-gray-600 mb-2">Ventas de Hoy</h3>
                <p class="text-3xl font-bold text-gray-800 mb-1">S/ {{ number_format($ventasDelDia, 2) }}</p>
                <p class="text-xs text-gray-500">Comparado con ayer</p>
            </div>
        </div>

        <!-- Libros vendidos -->
        <div class="group relative backdrop-blur-xl bg-gradient-to-br from-blue-500/20 to-indigo-500/20 border border-white/30 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:scale-105 overflow-hidden">
            <div class="absolute -top-10 -right-10 w-20 h-20 bg-blue-500/20 rounded-full blur-xl group-hover:bg-blue-500/30 transition-colors duration-500"></div>
            <div class="absolute -bottom-10 -left-10 w-20 h-20 bg-indigo-500/20 rounded-full blur-xl group-hover:bg-indigo-500/30 transition-colors duration-500"></div>

            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-sm font-medium text-gray-600 mb-2">Libros Vendidos</h3>
                <p class="text-3xl font-bold text-gray-800 mb-1">{{ number_format($totalLibrosVendidos) }}</p>
                <p class="text-xs text-gray-500">Total histórico</p>
            </div>
        </div>

        <!-- Usuarios registrados -->
        <div class="group relative backdrop-blur-xl bg-gradient-to-br from-purple-500/20 to-pink-500/20 border border-white/30 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:scale-105 overflow-hidden">
            <div class="absolute -top-10 -right-10 w-20 h-20 bg-purple-500/20 rounded-full blur-xl group-hover:bg-purple-500/30 transition-colors duration-500"></div>
            <div class="absolute -bottom-10 -left-10 w-20 h-20 bg-pink-500/20 rounded-full blur-xl group-hover:bg-pink-500/30 transition-colors duration-500"></div>

            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m9 5.197H15"></path>
                        </svg>
                    </div>
                    @if($nuevosUsuariosHoy > 0)
                    <div class="flex items-center text-purple-600 text-sm font-medium">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mr-2 animate-pulse"></div>
                        +{{ $nuevosUsuariosHoy }} hoy
                    </div>
                    @endif
                </div>
                <h3 class="text-sm font-medium text-gray-600 mb-2">Usuarios Registrados</h3>
                <p class="text-3xl font-bold text-gray-800 mb-1">{{ number_format($totalUsuarios) }}</p>
                <p class="text-xs text-gray-500">Total en plataforma</p>
            </div>
        </div>

        <!-- Stock disponible -->
        <div class="group relative backdrop-blur-xl bg-gradient-to-br from-orange-500/20 to-red-500/20 border border-white/30 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:scale-105 overflow-hidden">
            <div class="absolute -top-10 -right-10 w-20 h-20 bg-orange-500/20 rounded-full blur-xl group-hover:bg-orange-500/30 transition-colors duration-500"></div>
            <div class="absolute -bottom-10 -left-10 w-20 h-20 bg-red-500/20 rounded-full blur-xl group-hover:bg-red-500/30 transition-colors duration-500"></div>

            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    @if($stockBajo->count() > 0)
                    <div class="flex items-center text-orange-600 text-sm font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        Stock bajo
                    </div>
                    @endif
                </div>
                <h3 class="text-sm font-medium text-gray-600 mb-2">Libros en Stock</h3>
                <p class="text-3xl font-bold text-gray-800 mb-1">{{ number_format($librosDisponibles) }}</p>
                <p class="text-xs text-gray-500">Unidades totales</p>
            </div>
        </div>
    </div>

    <!-- Gráficos modernos -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        <!-- Gráfico de ventas mensuales -->
        <div class="backdrop-blur-xl bg-white/30 border border-white/30 rounded-2xl p-6 shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Ventas Mensuales {{ date('Y') }}</h3>
                    <p class="text-gray-600 text-sm">Tendencia de ingresos por mes</p>
                </div>
                <div class="p-3 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
            <div id="ventas-mensuales-chart" class="w-full h-80"></div>
        </div>

        <!-- Gráfico de categorías -->
        <div class="backdrop-blur-xl bg-white/30 border border-white/30 rounded-2xl p-6 shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Categorías Populares</h3>
                    <p class="text-gray-600 text-sm">Libros más vendidos por categoría</p>
                </div>
                <div class="p-3 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            </div>
            <div id="categorias-chart" class="w-full h-80"></div>
        </div>
    </div>

    <!-- Panel de resumen y alertas -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Últimas actividades -->
        <div class="backdrop-blur-xl bg-white/30 border border-white/30 rounded-2xl p-6 shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800">Actividad Reciente</h3>
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            </div>

            <div class="space-y-4">
                @php
                    $ultimasOrdenes = \App\Models\Order::with('user')
                        ->latest('fecha_orden')
                        ->take(5)
                        ->get();
                @endphp
                @forelse($ultimasOrdenes as $orden)
                <div class="flex items-center space-x-3 p-3 rounded-xl bg-white/20 backdrop-blur-sm hover:bg-white/30 transition-colors duration-200">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">{{ $orden->user->name }}</p>
                        <p class="text-xs text-gray-600">Compra por S/ {{ number_format($orden->total, 2) }}</p>
                    </div>
                    <span class="text-xs text-gray-500">{{ $orden->created_at ? $orden->created_at->diffForHumans() : 'Reciente' }}</span>
                </div>
                @empty
                <div class="text-center text-gray-500 py-8">
                    <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p class="text-sm">No hay actividad reciente</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Stock bajo -->
        <div class="backdrop-blur-xl bg-white/30 border border-white/30 rounded-2xl p-6 shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800">Alertas de Stock</h3>
                @if($stockBajo->count() > 0)
                <div class="px-3 py-1 bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs font-medium rounded-full">
                    {{ $stockBajo->count() }} alertas
                </div>
                @endif
            </div>

            <div class="space-y-4">
                @forelse($stockBajo as $item)
                <div class="flex items-center space-x-3 p-3 rounded-xl bg-red-50/50 backdrop-blur-sm border border-red-200/50">
                    <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">{{ Str::limit($item->titulo, 25) }}</p>
                        <p class="text-xs text-red-600">{{ $item->cantidad }} unidades restantes</p>
                    </div>
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                @empty
                <div class="text-center text-gray-500 py-8">
                    <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <p class="text-sm">Stock saludable</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Libros más vendidos -->
        <div class="backdrop-blur-xl bg-white/30 border border-white/30 rounded-2xl p-6 shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800">Top Vendidos</h3>
                <div class="p-2 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-lg">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>

            <div class="space-y-4">
                @php
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
                        ->groupBy('books.id', 'books.titulo')
                        ->orderBy('total_vendido', 'desc')
                        ->limit(5)
                        ->get();
                @endphp
                @forelse($librosMasVendidos as $index => $libro)
                <div class="flex items-center space-x-3 p-3 rounded-xl bg-white/20 backdrop-blur-sm hover:bg-white/30 transition-colors duration-200">
                    <div class="w-8 h-8 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                        {{ $index + 1 }}
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">{{ Str::limit($libro->titulo, 20) }}</p>
                        <p class="text-xs text-emerald-600 font-medium">{{ $libro->total_vendido }} vendidos</p>
                    </div>
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                @empty
                <div class="text-center text-gray-500 py-8">
                    <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <p class="text-sm">No hay ventas aún</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Scripts para gráficos modernos -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Configuración base para gráficos modernos
    const baseConfig = {
        chart: {
            toolbar: { show: false },
            background: 'transparent',
            fontFamily: 'Inter, system-ui, sans-serif',
        },
        grid: {
            borderColor: 'rgba(255, 255, 255, 0.1)',
            strokeDashArray: 3,
        },
        tooltip: {
            theme: 'dark',
            style: {
                fontSize: '12px',
                fontFamily: 'Inter, system-ui, sans-serif',
            },
            marker: {
                show: true,
            },
            x: {
                show: true,
            },
        },
        legend: {
            labels: {
                colors: '#64748B',
                useSeriesColors: false
            }
        }
    };

    // Gráfico de ventas mensuales moderno
    const ventasOptions = {
        ...baseConfig,
        series: [{
            name: "Ventas (S/)",
            data: @json($ventasMensuales)
        }],
        chart: {
            ...baseConfig.chart,
            type: "area",
            height: 320,
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800,
                animateGradually: {
                    enabled: true,
                    delay: 150
                },
                dynamicAnimation: {
                    enabled: true,
                    speed: 350
                }
            }
        },
        stroke: {
            curve: 'smooth',
            width: 3,
            colors: ['#6366F1']
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.1,
                stops: [0, 90, 100],
                colorStops: [
                    {
                        offset: 0,
                        color: "#6366F1",
                        opacity: 0.7
                    },
                    {
                        offset: 100,
                        color: "#8B5CF6",
                        opacity: 0.1
                    }
                ]
            }
        },
        dataLabels: { enabled: false },
        xaxis: {
            categories: [
                "Ene", "Feb", "Mar", "Abr", "May", "Jun",
                "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"
            ],
            labels: {
                style: {
                    colors: '#64748B',
                    fontSize: '12px',
                    fontWeight: 500
                }
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#64748B',
                    fontSize: '12px',
                    fontWeight: 500
                },
                formatter: function(val) {
                    return "S/ " + val.toFixed(0);
                }
            }
        },
        tooltip: {
            ...baseConfig.tooltip,
            y: {
                formatter: function(val) {
                    return "S/ " + val.toFixed(2);
                }
            }
        }
    };

    // Gráfico de categorías moderno
    const categoriasData = @json($ventasPorCategoria);
    const categoriasOptions = {
        ...baseConfig,
        series: [{
            name: "Libros Vendidos",
            data: categoriasData.map(item => item.total_vendido)
        }],
        chart: {
            ...baseConfig.chart,
            type: "bar",
            height: 320,
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800,
                animateGradually: {
                    enabled: true,
                    delay: 150
                },
                dynamicAnimation: {
                    enabled: true,
                    speed: 350
                }
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "60%",
                endingShape: "rounded",
                borderRadius: 8,
                distributed: true
            }
        },
        colors: ['#10B981', '#06B6D4', '#8B5CF6', '#F59E0B', '#EF4444'],
        dataLabels: { enabled: false },
        xaxis: {
            categories: categoriasData.map(item => item.nombre),
            labels: {
                style: {
                    colors: '#64748B',
                    fontSize: '12px',
                    fontWeight: 500
                }
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#64748B',
                    fontSize: '12px',
                    fontWeight: 500
                }
            }
        },
        tooltip: {
            ...baseConfig.tooltip,
            y: {
                formatter: function(val) {
                    return val + " libros";
                }
            }
        }
    };

    // Renderizar gráficos
    new ApexCharts(document.querySelector("#ventas-mensuales-chart"), ventasOptions).render();
    new ApexCharts(document.querySelector("#categorias-chart"), categoriasOptions).render();
});
</script>
