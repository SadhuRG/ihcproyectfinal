<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Book;
use App\Models\User;
use App\Models\Edition;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardStatsModern extends Component
{
    public $ventasDelDia;
    public $totalLibrosVendidos;
    public $totalUsuarios;
    public $librosDisponibles;
    public $ventasMensuales;
    public $ventasPorCategoria;
    public $crecimientoVentas;
    public $nuevosUsuariosHoy;
    public $stockBajo;

    public function mount()
    {
        $this->cargarEstadisticas();
    }

    public function cargarEstadisticas()
    {
        // Métricas principales
        $this->ventasDelDia = Order::whereDate('fecha_orden', today())
            ->where('estado', 1)
            ->sum('total');

        $this->totalLibrosVendidos = DB::table('edition_order')
            ->join('orders', 'orders.id', '=', 'edition_order.order_id')
            ->where('orders.estado', 1)
            ->sum('edition_order.cantidad');

        $this->totalUsuarios = User::count();

        $this->librosDisponibles = DB::table('inventories')
            ->join('editions', 'editions.inventorie_id', '=', 'inventories.id')
            ->sum('inventories.cantidad');

        // Libros con stock bajo
        $this->stockBajo = DB::table('inventories')
            ->join('editions', 'editions.inventorie_id', '=', 'inventories.id')
            ->join('books', 'editions.book_id', '=', 'books.id')
            ->select('books.titulo', 'inventories.cantidad', 'inventories.umbral')
            ->whereRaw('inventories.cantidad <= inventories.umbral')
            ->limit(5)
            ->get();

        // Datos para gráficos
        $this->ventasMensuales = $this->getVentasMensuales();
        $this->ventasPorCategoria = $this->getVentasPorCategoria();
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
            ->get()
            ->keyBy('mes');

        $ventasMensuales = [];
        for ($i = 1; $i <= 12; $i++) {
            $ventasMensuales[] = $ventas->get($i)->total_ventas ?? 0;
        }

        return $ventasMensuales;
    }

    private function getVentasPorCategoria()
    {
        return DB::table('categories')
            ->select(
                'categories.id',
                'categories.nombre',
                DB::raw('SUM(edition_order.cantidad) as total_vendido')
            )
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
