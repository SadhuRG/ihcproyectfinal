<div x-data="{ openUserMenu: false }">
    <header class="glassmorphism fixed top-0 w-full z-50 border-b" style="border-color: var(--border-color);">
        <div class="flex items-center justify-between px-6 py-4">
            <a href="/welcome" class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl flex items-center justify-center">
                    <img src="/imagenes/LOGO.jpg" alt="Pulsar Logo" class="w-8 h-8 rounded-lg">
                </div>
                <div>
                    <h1 class="text-xl font-bold" style="color: var(--text-primary);">Librería Pulsar</h1>
                    <p class="text-sm" style="color: var(--text-secondary);">Panel Administrativo</p>
                </div>
            </a>

            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" style="color: var(--text-secondary);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <div class="theme-toggle" onclick="toggleTheme()"><div class="theme-toggle-inner"><svg id="theme-icon" class="w-4 h-4" style="color: var(--bg-primary);" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg></div></div>
                    <svg class="w-5 h-5" style="color: var(--text-secondary);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </div>

                <div class="relative">
                    <button @click="openUserMenu = !openUserMenu" class="flex items-center space-x-3 glassmorphism px-4 py-2 rounded-xl">
                        <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium" style="color: var(--text-primary);">{{ Auth::user()->name }}</p>
                            <p class="text-xs" style="color: var(--text-secondary);">Administrador</p>
                        </div>
                    </button>
                    <div x-show="openUserMenu" @click.away="openUserMenu = false" x-transition class="absolute right-0 mt-2 w-48 glassmorphism rounded-xl shadow-lg py-1 z-50">
                        <a href="#" class="block px-4 py-2 text-sm" style="color: var(--text-primary);">Mi Perfil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm" style="color: var(--text-primary);">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="flex pt-24">
        <aside class="sidebar-gradient w-64 h-screen fixed left-0 top-20 overflow-y-auto p-4">
            <nav class="space-y-2">
                <a href="#" onclick="showSection('dashboard-content')" data-section="dashboard-content" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white bg-white/10"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path></svg><span class="font-medium">Dashboard</span></a>
                <a href="#" onclick="showSection('libros')" data-section="libros" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg><span class="font-medium">Libros</span></a>
                <a href="#" onclick="showSection('inventario')" data-section="inventario" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg><span class="font-medium">Inventario</span></a>
                <a href="#" onclick="showSection('pedidos')" data-section="pedidos" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg><span class="font-medium">Pedidos</span></a>
                <a href="#" onclick="showSection('usuarios')" data-section="usuarios" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m9 5.197H15"></path></svg><span class="font-medium">Usuarios</span></a>
                <a href="#" onclick="showSection('soporte-usuario')" data-section="soporte-usuario" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span class="font-medium">Soporte</span></a>
                <a href="#" onclick="showSection('promociones')" data-section="promociones" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM14.5 18.5a2.5 2.5 0 105 0 2.5 2.5 0 00-5 0z"></path></svg><span class="font-medium">Promociones</span></a>
                <a href="#" onclick="showSection('reportes')" data-section="reportes" class="nav-button nav-item flex items-center space-x-3 p-3 rounded-xl text-white/80 hover:bg-white/10"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg><span class="font-medium">Reportes</span></a>
            </nav>
        </aside>

        <main class="ml-64 flex-1 p-6">
            <div id="dashboard-content" class="content-section">
                <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
                    <div class="metric-card rounded-2xl p-5"><h3 class="text-sm font-medium mb-2" style="color: var(--text-secondary);">Ventas de Hoy</h3><p class="text-3xl font-bold" style="color: var(--text-primary);">S/ {{ number_format($ventasDelDia, 2) }}</p></div>
                    <div class="metric-card rounded-2xl p-5"><h3 class="text-sm font-medium mb-2" style="color: var(--text-secondary);">Libros Vendidos (Hoy)</h3><p class="text-3xl font-bold" style="color: var(--text-primary);">{{ $totalLibrosVendidos }}</p></div>
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
            <div id="inventario" class="content-section hidden"><x-section-title title="Inventario" /></div>
            <div id="pedidos" class="content-section hidden"><x-section-title title="Pedidos" /></div>
            <div id="usuarios" class="content-section hidden">@livewire('usuarios-post')</div>
            <div id="soporte-usuario" class="content-section hidden"><x-section-title title="Soporte de Usuario" /></div>
            <div id="promociones" class="content-section hidden"><x-section-title title="Promociones" /></div>
            <div id="reportes" class="content-section hidden"><x-section-title title="Reportes" /></div>
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
});
</script>
@endpush
</div>
