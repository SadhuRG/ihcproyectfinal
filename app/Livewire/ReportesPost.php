<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use App\Models\Edition;
use App\Models\Inventory;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportesPost extends Component
{
    public $selectedReportes = [];
    public $selectAll = false;
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success';

    // Lista de reportes disponibles
    public $reportes = [
        [
            'id' => 'ventas_anio_actual',
            'titulo' => 'Reporte de Ventas del Año Actual',
            'descripcion' => 'Ventas totales, cantidad de pedidos y libros vendidos del año actual',
            'icon' => 'chart-bar'
        ],
        [
            'id' => 'usuarios_registrados',
            'titulo' => 'Reporte de Usuarios Registrados',
            'descripcion' => 'Lista completa de usuarios registrados con sus datos básicos',
            'icon' => 'users'
        ],
        [
            'id' => 'libros_inventario',
            'titulo' => 'Reporte de Inventario de Libros',
            'descripcion' => 'Estado actual del inventario con stock disponible y agotado',
            'icon' => 'book-open'
        ],
        [
            'id' => 'libros_mas_vendidos',
            'titulo' => 'Libros Más Vendidos',
            'descripcion' => 'Ranking de libros con mayor número de ventas',
            'icon' => 'star'
        ],
        [
            'id' => 'ventas_mensuales',
            'titulo' => 'Ventas Mensuales',
            'descripcion' => 'Desglose de ventas por mes del año actual',
            'icon' => 'calendar'
        ],
        [
            'id' => 'stock_bajo',
            'titulo' => 'Productos con Stock Bajo',
            'descripcion' => 'Libros que requieren reposición de inventario',
            'icon' => 'exclamation-triangle'
        ],
        [
            'id' => 'categorias_populares',
            'titulo' => 'Categorías Más Populares',
            'descripcion' => 'Categorías con mayor número de ventas',
            'icon' => 'tag'
        ],
        [
            'id' => 'editoriales_ventas',
            'titulo' => 'Ventas por Editorial',
            'descripcion' => 'Desglose de ventas organizadas por editorial',
            'icon' => 'building'
        ]
    ];

    public function mount()
    {
        // Inicializar array de reportes seleccionados
        $this->selectedReportes = [];
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedReportes = collect($this->reportes)->pluck('id')->toArray();
        } else {
            $this->selectedReportes = [];
        }
    }

    public function updatedSelectedReportes()
    {
        $this->selectAll = count($this->selectedReportes) === count($this->reportes);
    }

    public function descargarPDF()
    {
        if (empty($this->selectedReportes)) {
            $this->showNotification = true;
            $this->notificationMessage = 'Debes seleccionar al menos un reporte para descargar.';
            $this->notificationType = 'error';
            return;
        }

        // Aquí iría la lógica de generación de PDF
        $this->showNotification = true;
        $this->notificationMessage = 'Descarga de PDF iniciada. Los reportes seleccionados se están generando...';
        $this->notificationType = 'success';
    }

    public function descargarExcel()
    {
        if (empty($this->selectedReportes)) {
            $this->showNotification = true;
            $this->notificationMessage = 'Debes seleccionar al menos un reporte para descargar.';
            $this->notificationType = 'error';
            return;
        }

        // Aquí iría la lógica de generación de Excel
        $this->showNotification = true;
        $this->notificationMessage = 'Descarga de Excel iniciada. Los reportes seleccionados se están generando...';
        $this->notificationType = 'success';
    }

    public function cerrarNotificacion()
    {
        $this->showNotification = false;
        $this->notificationMessage = '';
        $this->notificationType = 'success';
    }

    // Métodos para obtener datos de los reportes
    public function getVentasAnioActual()
    {
        $anioActual = Carbon::now()->year;
        
        $ventas = Order::whereYear('created_at', $anioActual)
                      ->where('estado', 1)
                      ->get();

        $totalVentas = $ventas->sum('total');
        $cantidadPedidos = $ventas->count();
        $librosVendidos = $ventas->sum(function($orden) {
            return $orden->editions->sum('pivot.cantidad');
        });

        return [
            'total_ventas' => $totalVentas,
            'cantidad_pedidos' => $cantidadPedidos,
            'libros_vendidos' => $librosVendidos,
            'anio' => $anioActual
        ];
    }

    public function getUsuariosRegistrados()
    {
        return User::with('roles')->get();
    }

    public function getLibrosInventario()
    {
        return Edition::with(['book', 'inventory', 'editorial'])
                     ->whereHas('inventory')
                     ->get();
    }

    public function getLibrosMasVendidos()
    {
        return DB::table('books')
                 ->join('editions', 'books.id', '=', 'editions.book_id')
                 ->join('edition_order', 'editions.id', '=', 'edition_order.edition_id')
                 ->join('orders', 'edition_order.order_id', '=', 'orders.id')
                 ->where('orders.estado', 1)
                 ->select('books.titulo', 'books.ISBN', DB::raw('SUM(edition_order.cantidad) as total_vendido'))
                 ->groupBy('books.id', 'books.titulo', 'books.ISBN')
                 ->orderBy('total_vendido', 'desc')
                 ->limit(10)
                 ->get();
    }

    public function getVentasMensuales()
    {
        $anioActual = Carbon::now()->year;
        
        return Order::whereYear('created_at', $anioActual)
                   ->where('estado', 1)
                   ->selectRaw('MONTH(created_at) as mes, SUM(total) as total_ventas, COUNT(*) as cantidad_pedidos')
                   ->groupBy('mes')
                   ->orderBy('mes')
                   ->get();
    }

    public function getStockBajo()
    {
        return Edition::with(['book', 'inventory'])
                     ->whereHas('inventory', function($query) {
                         $query->where('cantidad', '<=', DB::raw('umbral'));
                     })
                     ->get();
    }

    public function render()
    {
        return view('livewire.reportes-post', [
            'reportes' => $this->reportes
        ]);
    }
}
