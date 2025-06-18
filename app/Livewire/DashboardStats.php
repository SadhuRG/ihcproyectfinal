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

class DashboardStats extends Component
{
    public $ventasDelDia;
    public $totalLibrosVendidos;
    public $totalUsuarios;
    public $librosDisponibles;
    public $ventasMensuales;
    public $ventasPorCategoria;

    public function mount()
    {
        $this->cargarEstadisticas();
    }

    public function cargarEstadisticas()
    {
        // 1. Ventas del día (suma de orders de hoy)
        $this->ventasDelDia = Order::whereDate('fecha_orden', today())
            ->where('estado', 1) // Solo órdenes confirmadas
            ->sum('total');

        // 2. Total de libros vendidos (suma de cantidades en edition_order)
        $this->totalLibrosVendidos = DB::table('edition_order')
            ->join('orders', 'orders.id', '=', 'edition_order.order_id')
            ->where('orders.estado', 1)
            ->sum('edition_order.cantidad');

        // 3. Total de usuarios registrados
        $this->totalUsuarios = User::count();

        // 4. Libros disponibles (suma de inventarios)
        $this->librosDisponibles = DB::table('inventories')
            ->join('editions', 'editions.inventorie_id', '=', 'inventories.id')
            ->sum('inventories.cantidad');

        // 5. Ventas mensuales del año actual
        $this->ventasMensuales = $this->getVentasMensuales();

        // 6. Ventas por categoría (para el gráfico)
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

        // Crear array con todos los meses (1-12)
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
            ->limit(5) // Top 5 categorías
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}
