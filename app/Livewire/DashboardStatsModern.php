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
            ->select('books.titulo', 'inventories.cantidad')
            ->whereRaw('inventories.cantidad <= inventories.umbral')
            ->limit(5)
            ->get();
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

    public function render()
    {
        return view('livewire.dashboard-stats-modern');
    }
}
