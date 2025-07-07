<div x-data="{ openUserMenu: false }">
    <!-- HEADER -->
    <div class="w-full p-4 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 shadow-xl flex items-center fixed top-0 z-50">

        <!-- Logo Section -->
        <div class="w-1/4 flex items-center justify-start">
            <a href="{{ url('/') }}" class="flex items-center space-x-3">
                <img src="/imagenes/LOGO.jpg" alt="Pulsar - Logo" class="w-12 h-12 rounded-full shadow-lg transition-transform duration-300 hover:scale-110">
                <div>
                    <span class="text-white text-2xl font-bold tracking-wide hidden md:block">Pulsar</span>
                    <p class="text-white/80 text-sm hidden md:block">Panel Administrativo</p>
                </div>
            </a>
        </div>
        <!-- Navigation Section -->
        <div class="w-3/4 flex items-center justify-end space-x-3">
            <!-- Theme Toggle -->
            <div class="theme-toggle-container hidden md:block flex items-center space-x-2">
                <!-- Dynamic Icon (Left) - Changes between Sun and Moon -->

                <div class="flex items-center space-x-2">
                    <div id="theme-icon-container-dashboard flex items-center space-x-2" class="w-8 h-8">
                        <!-- Sun Icon -->
                        <svg id="sun-icon-dashboard" class="w-8 h-8 text-yellow-300 transition-all duration-300 absolute" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <!-- Moon Icon -->
                        <svg id="moon-icon-dashboard" class="w-8 h-8 text-blue-300 transition-all duration-300 absolute opacity-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </div>
                    <!-- Toggle Button -->
                    <button id="theme-toggle-dashboard" class="relative w-14 h-7 bg-white/20 backdrop-blur-sm rounded-full transition-all duration-300 hover:scale-110 flex items-center p-1" onclick="toggleTheme()">
                        <div id="toggle-circle-dashboard" class="w-5 h-5 bg-white rounded-full shadow-lg transition-transform duration-300 transform translate-x-0"></div>
                    </button>
                </div>

            </div>

            <!-- User Menu -->
            <div class="relative">
                <button @click="openUserMenu = !openUserMenu" class="flex items-center space-x-3 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-4 py-2 rounded-full transition-all duration-300">
                    <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="hidden md:block">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-white/80">Administrador</p>
                    </div>
                </button>
                <div x-show="openUserMenu" @click.away="openUserMenu = false" x-transition class="absolute right-0 mt-2 w-48 bg-white/95 backdrop-blur-md rounded-xl shadow-lg py-1 z-50">
                    <a href="{{ route('user-profile') }}"class="block rounded-xl px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mi Perfil</a>
                    <a href="{{ route('welcome') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Vista Usuario
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden p-2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white rounded-full transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="hidden absolute top-full left-0 right-0 bg-white/95 backdrop-blur-md shadow-xl rounded-b-2xl md:hidden transition-all duration-300" id="mobile-menu">
            <div class="p-4 space-y-3">
                <a href="#" class="block w-full px-4 py-3 text-center font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-all duration-300">
                    Mi Perfil
                </a>
                <a href="{{ route('welcome') }}" class="block w-full px-4 py-3 text-center font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-all duration-300">
                    Vista Usuario
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full px-4 py-3 text-center font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl transition-all duration-300">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- FIN HEADER -->

    <div class="flex pt-24">
        <aside class="sidebar-gradient w-64 h-screen fixed left-0 top-20 overflow-y-auto p-4 z-40">
            <nav class="space-y-2">
                <a href="#" onclick="showSection('dashboard-content')" data-section="dashboard-content" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white bg-white/10">
                    <img src="/icons/dashboard-svg/1.dashboard.svg" alt="Dashboard" class="w-8 h-8 flex-shrink-0">
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="#" onclick="showSection('libros')" data-section="libros" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10">
                    <img src="/icons/dashboard-svg/11.libro.svg" alt="Libros" class="w-8 h-8 flex-shrink-0"> 
                    <span class="font-medium">Libros</span>
                </a>
                <a href="#" onclick="showSection('ediciones')" data-section="ediciones" class="nav-button nav-item flex items-center space-x-3 p-3 pl-5 rounded-xl text-white/80 hover:bg-white/10">
                    <img src="/icons/dashboard-svg/2.edicion.svg" alt="Ediciones" class="w-5 h-5 flex-shrink-0">
                    <span class="font-medium pl-1">Ediciones</span>
                </a>
                <a href="#" onclick="showSection('autores')" data-section="autores" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10">
                    <img src="/icons/dashboard-svg/0.autor.svg" alt="Autores" class="w-8 h-8 flex-shrink-0">
                    <span class="font-medium">Autores</span>
                </a>
                <a href="#" onclick="showSection('categorias')" data-section="categorias" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10">
                    <img src="/icons/dashboard-svg/4.categoria.svg" alt="Categorías" class="w-8 h-8 flex-shrink-0">
                    <span class="font-medium">Categorías</span>
                </a>
                <a href="#" onclick="showSection('editoriales')" data-section="editoriales" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10">
                    <img src="/icons/dashboard-svg/publisher.svg" alt="Editoriales" class="w-6 h-6 pl-1 flex-shrink-0">
                    <span class="font-medium">Editoriales</span>
                </a>
                <a href="#" onclick="showSection('inventario')" data-section="inventario" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10">
                    <img src="/icons/dashboard-svg/12.inventario.svg" alt="Inventario" class="w-8 h-8 flex-shrink-0">
                    <span class="font-medium">Inventario</span>
                </a>
                <a href="#" onclick="showSection('pedidos')" data-section="pedidos" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10">
                    <img src="/icons/dashboard-svg/8.pedido.svg" alt="Pedidos" class="w-8 h-8 flex-shrink-0">
                    <span class="font-medium">Pedidos</span>
                </a>
                <a href="#" onclick="showSection('usuarios')" data-section="usuarios" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10">
                    <img src="/icons/dashboard-svg/13.usuario.svg" alt="Usuarios" class="w-8 h-8 flex-shrink-0">
                    <span class="font-medium">Usuarios</span>
                </a>
                <a href="#" onclick="showSection('soporte-usuario')" data-section="soporte-usuario" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10">
                    <img src="/icons/dashboard-svg/10.soporte_usuario.svg" alt="Soporte de Usuario" class="w-8 h-8 flex-shrink-0">
                    <span class="font-medium">Soporte de Usuario</span>
                </a>
                <a href="#" onclick="showSection('promociones')" data-section="promociones" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10">
                    <img src="/icons/dashboard-svg/7.promociones.svg" alt="Promociones" class="w-8 h-8 flex-shrink-0">
                    <span class="font-medium">Promociones</span>
                </a>
                <a href="#" onclick="showSection('reportes')" data-section="reportes" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10">
                    <img src="/icons/dashboard-svg/6.reporte.svg" alt="Reportes" class="w-8 h-8 flex-shrink-0">
                    <span class="font-medium">Reportes</span>
                </a>
            </nav>
        </aside>

        <main class="ml-64 flex-1 p-6">
            <div id="dashboard-content" class="content-section">
                <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
                    <div class="metric-card rounded-2xl p-5"><h3 class="text-sm font-medium mb-2" style="color: var(--text-secondary);">Ventas de Hoy</h3><p class="text-3xl font-bold" style="color: var(--text-primary);">S/ {{ number_format($ventasDelDia, 2) }}</p></div>
                    <div class="metric-card rounded-2xl p-5"><h3 class="text-sm font-medium mb-2" style="color: var(--text-secondary);">Libros Vendidos</h3><p class="text-3xl font-bold" style="color: var(--text-primary);">{{ $totalLibrosVendidos }}</p></div>
                    <div class="metric-card rounded-2xl p-5"><h3 class="text-sm font-medium mb-2" style="color: var(--text-secondary);">Total Usuarios</h3><p class="text-3xl font-bold" style="color: var(--text-primary);">{{ $totalUsuarios }}</p></div>
                    <div class="metric-card rounded-2xl p-5"><h3 class="text-sm font-medium mb-2" style="color: var(--text-secondary);">Stock Total</h3><p class="text-3xl font-bold" style="color: var(--text-primary);">{{ $librosDisponibles }}</p></div>
                </div>
                <div class="grid grid-cols-1 xl:grid-cols-4 gap-6 mb-6">
                    <div class="xl:col-span-2 glassmorphism rounded-2xl p-6"><h3 class="text-xl font-bold mb-4" style="color: var(--text-primary);">📈 Ventas Mensuales ({{ date('Y') }})</h3><div id="ventas-mensuales-chart" class="h-80"></div></div>
                    <div class="xl:col-span-2 glassmorphism rounded-2xl p-6"><h3 class="text-xl font-bold mb-4" style="color: var(--text-primary);">📚 Top Categorías</h3><div id="categorias-chart" class="h-80"></div></div>
                </div>
                <div class="glassmorphism rounded-2xl p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4" style="color: var(--text-primary);">Resumen Rápido</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <h4 class="font-semibold mb-2" style="color: var(--text-secondary);">Últimas Órdenes</h4>
                            <div class="space-y-2">
                                @forelse($ultimasOrdenes as $orden)
                                    <div class="flex justify-between text-sm"><span style="color: var(--text-primary);">{{ $orden->user->name }}</span><span class="font-medium">S/ {{ number_format($orden->total, 2) }}</span></div>
                                @empty
                                    <p class="text-sm" style="color: var(--text-secondary);">No hay órdenes recientes.</p>
                                @endforelse
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2" style="color: var(--text-secondary);">Libros Más Vendidos</h4>
                            <div class="space-y-2">
                                @forelse($librosMasVendidos as $libro)
                                    <div class="text-sm"><span class="block font-medium" style="color: var(--text-primary);">{{ Str::limit($libro->titulo, 25) }}</span><span style="color: var(--text-secondary);">{{ $libro->total_vendido }} vendidos</span></div>
                                @empty
                                    <p class="text-sm" style="color: var(--text-secondary);">No hay ventas aún.</p>
                                @endforelse
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2" style="color: var(--text-secondary);">⚠️ Stock Bajo</h4>
                            <div class="space-y-2">
                                @forelse($stockBajo as $item)
                                    <div class="text-sm"><span class="block font-medium" style="color: var(--text-primary);">{{ Str::limit($item->titulo, 20) }}</span><span class="text-red-400">{{ $item->cantidad }} restantes</span></div>
                                @empty
                                    <p class="text-sm text-green-400">Stock saludable.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="libros" class="content-section hidden">@livewire('libros-post')</div>

            <div id="ediciones" class="content-section hidden">@livewire('ediciones-post')</div>

            <div id="autores" class="content-section hidden">@livewire('autores-post')</div>
            <div id="categorias" class="content-section hidden">@livewire('categorias-post')</div>
            <div id="editoriales" class="content-section hidden">@livewire('editoriales-post')</div>
            <div id="inventario" class="content-section hidden">@livewire('inventario-post')</div>
            <div id="pedidos" class="content-section hidden">@livewire('pedidos-post')</div>
            <div id="usuarios" class="content-section hidden">@livewire('usuarios-post')</div>
            <div id="soporte-usuario" class="content-section hidden">@livewire('soporte-post')</div>
            <div id="promociones" class="content-section hidden">@livewire('promociones-post')</div>
            <div id="reportes" class="content-section hidden">@livewire('reportes-post')</div>
        </main>
    </div>
    @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let ventasChart;
        let categoriasChart;

        const renderCharts = () => {
            // Verificar que los contenedores existan y sean visibles
            const categoriasContainer = document.querySelector("#categorias-chart");
            const ventasContainer = document.querySelector("#ventas-mensuales-chart");

            if (!categoriasContainer || !ventasContainer) {
                setTimeout(renderCharts, 500);
                return;
            }

            // Verificar si el dashboard está visible
            const dashboardContent = document.querySelector("#dashboard-content");
            if (dashboardContent && dashboardContent.classList.contains('hidden')) {
                return;
            }

            const isDark = document.body.classList.contains('dark');
            const textColor = isDark ? '#94a3b8' : '#333';
            const gridColor = isDark ? 'rgba(71, 85, 105, 0.3)' : '#e5e7eb';

            // --- Usando TUS variables PHP originales ---
            const categoriasData = @json($ventasPorCategoria);
            const ventasMensuales = @json($ventasMensuales);

            // --- Gráfico de Categorías (tu lógica original) ---
            const categoriasOptions = {
                series: [{
                    name: "Libros Vendidos",
                    data: categoriasData.map(item => item.total_vendido)
                }],
                chart: {
                    type: "bar",
                    height: 320,
                    toolbar: { show: false },
                    background: 'transparent'
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
                        style: { fontSize: "12px", colors: textColor }
                    }
                },
                yaxis: {
                    title: { text: "Libros Vendidos" },
                    labels: {
                        style: { fontSize: "12px", colors: textColor }
                    }
                },
                grid: { borderColor: gridColor },
                tooltip: {
                    y: {
                        formatter: function(val) { return val + " libros"; }
                    },
                    theme: isDark ? 'dark' : 'light'
                }
            };

            // --- Gráfico de Ventas Mensuales (tu lógica original) ---
            const ventasOptions = {
                series: [{
                    name: "Ventas (S/)",
                    data: ventasMensuales
                }],
                chart: {
                    type: "line",
                    height: 320,
                    toolbar: { show: false },
                    background: 'transparent'
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
                        style: { fontSize: "12px", colors: textColor }
                    }
                },
                yaxis: {
                    title: { text: "Ventas (S/)" },
                    labels: {
                        style: { fontSize: "12px", colors: textColor },
                        formatter: function(val) { return "S/ " + val.toFixed(0); }
                    }
                },
                grid: { borderColor: gridColor },
                tooltip: {
                    y: {
                        formatter: function(val) { return "S/ " + val.toFixed(2); }
                    },
                    theme: isDark ? 'dark' : 'light'
                }
            };

            // Destruir instancias viejas para evitar duplicados
            if (categoriasChart) categoriasChart.destroy();
            if (ventasChart) ventasChart.destroy();

            // Renderizar nuevos gráficos
            try {
                categoriasChart = new ApexCharts(categoriasContainer, categoriasOptions);
                ventasChart = new ApexCharts(ventasContainer, ventasOptions);

                categoriasChart.render();
                ventasChart.render();

                console.log('Gráficos renderizados correctamente');
            } catch (error) {
                console.error('Error al renderizar gráficos:', error);
            }
        };

        // Primera renderización con delay
        setTimeout(renderCharts, 500);

        // Escuchar cambio de tema para re-renderizar con nuevos colores
        window.addEventListener('theme-changed', () => {
            setTimeout(renderCharts, 200);
        });

        // Renderizar cuando se haga clic en Dashboard
        const dashboardLink = document.querySelector('[data-section="dashboard-content"]');
        if (dashboardLink) {
            dashboardLink.addEventListener('click', () => {
                setTimeout(renderCharts, 200);
            });
        }

        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Listen for theme changes
        window.addEventListener('theme-changed', () => {
            setTimeout(renderCharts, 200);
        });
    });
</script>
@endpush
</div>
