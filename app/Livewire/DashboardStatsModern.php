<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Book;
use App\Models\User;
use App\Models\Edition;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DashboardStatsModern extends Component
{
    // Métricas principales
    public $ventasDelDia;
    public $totalLibrosVendidos;
    public $totalUsuarios;
    public $librosDisponibles;

    // Datos para gráficos
    public $ventasMensuales;
    public $ventasPorCategoria;

    // Datos para paneles de resumen
    public $stockBajo;
    public $ultimasOrdenes;
    public $librosMasVendidos;
    public $tendencias;

    public function mount()
    {
        $this->cargarEstadisticas();
    }

    public function cargarEstadisticas()
    {
        // 1. Métricas principales
        $this->ventasDelDia = Order::whereDate('fecha_orden', today())->where('estado', 1)->sum('total');
        $this->totalLibrosVendidos = DB::table('edition_order')->join('orders', 'orders.id', '=', 'edition_order.order_id')->where('orders.estado', 1)->sum('edition_order.cantidad');
        $this->totalUsuarios = User::count();
        $this->librosDisponibles = DB::table('inventories')->sum('cantidad');

        // 2. Datos para gráficos
        $this->ventasMensuales = $this->getVentasMensuales();
        $this->ventasPorCategoria = $this->getVentasPorCategoria();

        // 3. Datos para paneles de resumen (lógica traída de tu dashboard original)
        $this->ultimasOrdenes = Order::with('user')->latest('fecha_orden')->take(5)->get();

        $this->librosMasVendidos = DB::table('books')
            ->select('books.titulo', DB::raw('SUM(edition_order.cantidad) as total_vendido'))
            ->join('editions', 'books.id', '=', 'editions.book_id')
            ->join('edition_order', 'editions.id', '=', 'edition_order.edition_id')
            ->join('orders', 'edition_order.order_id', '=', 'orders.id')
            ->where('orders.estado', 1)
            ->groupBy('books.id', 'books.titulo')
            ->orderBy('total_vendido', 'desc')
            ->limit(5)
            ->get();

        $this->stockBajo = DB::table('editions')
            ->join('books', 'editions.book_id', '=', 'books.id')
            ->join('inventories', 'editions.inventorie_id', '=', 'inventories.id')
            ->select(
                'books.titulo',
                'editions.numero_edicion',
                'inventories.cantidad',
                'inventories.umbral'
            )
            ->orderBy('inventories.cantidad', 'asc')
            ->limit(5)
            ->get();

        // 4. Datos de tendencias
        $this->tendencias = $this->getTendencias();
    }

    private function getVentasMensuales()
    {
        $ventas = Order::select(
                DB::raw('MONTH(fecha_orden) as mes'),
                DB::raw('SUM(total) as total_ventas')
            )
            ->whereYear('fecha_orden', date('Y'))
            ->where('estado', 1)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get()->keyBy('mes');

        $ventasMensuales = [];
        for ($i = 1; $i <= 12; $i++) {
            $ventasMensuales[] = $ventas->get($i)->total_ventas ?? 0;
        }
        return $ventasMensuales;
    }

    private function getVentasPorCategoria()
    {
        return DB::table('categories')
            ->select('categories.nombre', DB::raw('SUM(edition_order.cantidad) as total_vendido'))
            ->join('book_category', 'categories.id', '=', 'book_category.category_id')
            ->join('books', 'book_category.book_id', '=', 'books.id')
            ->join('editions', 'books.id', '=', 'editions.book_id')
            ->join('edition_order', 'editions.id', '=', 'edition_order.edition_id')
            ->join('orders', 'edition_order.order_id', '=', 'orders.id')
            ->where('orders.estado', 1)
            ->groupBy('categories.id', 'categories.nombre')
            ->orderBy('total_vendido', 'desc')
            ->limit(5)
            ->get();
    }

    private function getTendencias()
    {
        $tendencias = [];

        // 1. Categoría más popular del mes
        $categoriaPopular = DB::table('categories')
            ->select('categories.nombre', DB::raw('SUM(edition_order.cantidad) as total_vendido'))
            ->join('book_category', 'categories.id', '=', 'book_category.category_id')
            ->join('books', 'book_category.book_id', '=', 'books.id')
            ->join('editions', 'books.id', '=', 'editions.book_id')
            ->join('edition_order', 'editions.id', '=', 'edition_order.edition_id')
            ->join('orders', 'edition_order.order_id', '=', 'orders.id')
            ->where('orders.estado', 1)
            ->whereMonth('orders.fecha_orden', now()->month)
            ->whereYear('orders.fecha_orden', now()->year)
            ->groupBy('categories.id', 'categories.nombre')
            ->orderBy('total_vendido', 'desc')
            ->first();

        $tendencias['categoria_popular'] = $categoriaPopular ? $categoriaPopular->nombre : 'Sin datos';
        $tendencias['categoria_vendida'] = $categoriaPopular ? $categoriaPopular->total_vendido : 0;

        // 2. Autor más vendido
        $autorMasVendido = DB::table('authors')
            ->select('authors.nombre', DB::raw('SUM(edition_order.cantidad) as total_vendido'))
            ->join('author_book', 'authors.id', '=', 'author_book.author_id')
            ->join('books', 'author_book.book_id', '=', 'books.id')
            ->join('editions', 'books.id', '=', 'editions.book_id')
            ->join('edition_order', 'editions.id', '=', 'edition_order.edition_id')
            ->join('orders', 'edition_order.order_id', '=', 'orders.id')
            ->where('orders.estado', 1)
            ->groupBy('authors.id', 'authors.nombre')
            ->orderBy('total_vendido', 'desc')
            ->first();

        $tendencias['autor_mas_vendido'] = $autorMasVendido ? $autorMasVendido->nombre : 'Sin datos';
        $tendencias['autor_vendido'] = $autorMasVendido ? $autorMasVendido->total_vendido : 0;

        // 3. Editorial con más libros
        $editorialMasLibros = DB::table('editorials')
            ->select('editorials.nombre', DB::raw('COUNT(editions.id) as total_libros'))
            ->join('editions', 'editorials.id', '=', 'editions.editorial_id')
            ->groupBy('editorials.id', 'editorials.nombre')
            ->orderBy('total_libros', 'desc')
            ->first();

        $tendencias['editorial_mas_libros'] = $editorialMasLibros ? $editorialMasLibros->nombre : 'Sin datos';
        $tendencias['editorial_libros'] = $editorialMasLibros ? $editorialMasLibros->total_libros : 0;

        // 4. Mes con más ventas
        $mesMasVentas = Order::select(
                DB::raw('MONTH(fecha_orden) as mes'),
                DB::raw('SUM(total) as total_ventas')
            )
            ->whereYear('fecha_orden', date('Y'))
            ->where('estado', 1)
            ->groupBy('mes')
            ->orderBy('total_ventas', 'desc')
            ->first();

        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        $tendencias['mes_mas_ventas'] = $mesMasVentas ? $meses[$mesMasVentas->mes] : 'Sin datos';
        $tendencias['mes_ventas'] = $mesMasVentas ? $mesMasVentas->total_ventas : 0;

        return $tendencias;
    }

    public function render()
    {
        return view('livewire.dashboard-stats-modern');
    }
}
