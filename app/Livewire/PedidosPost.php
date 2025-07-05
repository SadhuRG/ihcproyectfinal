<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use App\Models\User;
use App\Models\Address;
use App\Models\PaymentType;
use App\Models\ShipmentType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PedidosPost extends Component
{
    use WithPagination;

    // Propiedades de búsqueda y ordenamiento
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $statusFilter = '';
    public $dateFilter = '';

    // Propiedades de edición
    public $showEditModal = false;
    public $pedidoEditado = [];

    // Propiedades de eliminación
    public $showDeleteModal = false;
    public $pedidoAEliminar = null;
    public $selectedPedidos = [];
    public $selectAll = false;
    public $eliminacionmode = 'unico';

    // Propiedades de notificación
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success';

    // Propiedades de vista detallada
    public $showDetailModal = false;
    public $pedidoDetalle = null;

    // Filtros adicionales
    public $userFilter = '';
    public $paymentFilter = '';
    public $shipmentFilter = '';

    protected $paginationTheme = 'tailwind';

    public function updatedSearch()
    {
        // Solo resetear la página, NO modificar el valor del search
        $this->resetPage();
    }

    /**
     * Normaliza el texto de búsqueda para hacerlo más amigable
     */
    private function normalizarBusqueda($texto)
    {
        if (empty($texto)) {
            return '';
        }
        
        // Eliminar espacios al inicio y final
        $texto = trim($texto);
        
        // Reemplazar múltiples espacios con un solo espacio
        $texto = preg_replace('/\s+/', ' ', $texto);
        
        return $texto;
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function updatedDateFilter()
    {
        $this->resetPage();
    }

    public function updatedUserFilter()
    {
        $this->resetPage();
    }

    public function order($sort)
    {
        if ($this->sort === $sort) {
            $this->direction = $this->direction === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sort = $sort;
            $this->direction = 'desc';
        }
        $this->resetPage();
    }

    /**
     * Prepara los datos del pedido y abre el modal de edición.
     */
    public function editarPedido($id)
    {
        $pedido = Order::with(['user', 'address', 'paymentType', 'shipmentType', 'editions'])->find($id);

        if ($pedido) {
            $this->pedidoEditado = [
                'id' => $pedido->id,
                'user_id' => $pedido->user_id,
                'address_id' => $pedido->address_id,
                'payment_type_id' => $pedido->payment_type_id,
                'shipment_type_id' => $pedido->shipment_type_id,
                'fecha_orden' => $pedido->fecha_orden,
                'estado' => $pedido->estado,
                'total' => $pedido->total
            ];
            $this->showEditModal = true;
        }
    }

    /**
     * Guarda los cambios del pedido desde el modal de edición.
     */
    public function guardarPedido()
    {
        $this->validate([
            'pedidoEditado.user_id' => 'required|exists:users,id',
            'pedidoEditado.payment_type_id' => 'required|exists:payment_types,id',
            'pedidoEditado.shipment_type_id' => 'required|exists:shipment_types,id',
            'pedidoEditado.fecha_orden' => 'required|date',
            'pedidoEditado.estado' => 'required|in:0,1',
            'pedidoEditado.total' => 'required|numeric|min:0'
        ]);

        try {
            $pedido = Order::find($this->pedidoEditado['id']);

            $pedido->update([
                'user_id' => $this->pedidoEditado['user_id'],
                'payment_type_id' => $this->pedidoEditado['payment_type_id'],
                'shipment_type_id' => $this->pedidoEditado['shipment_type_id'],
                'fecha_orden' => $this->pedidoEditado['fecha_orden'],
                'estado' => $this->pedidoEditado['estado'],
                'total' => $this->pedidoEditado['total']
            ]);

            $this->showEditModal = false;
            $this->showNotification = true;
            $this->notificationMessage = 'Pedido actualizado correctamente.';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al actualizar el pedido.';
            $this->notificationType = 'error';
        }
    }

    /**
     * Muestra el detalle completo del pedido.
     */
    public function verDetalle($id)
    {
        $this->pedidoDetalle = Order::with([
            'user',
            'address',
            'paymentType',
            'shipmentType',
            'editions.book',
            'editions.editorial'
        ])->find($id);

        $this->showDetailModal = true;
    }

    /**
     * Cambia el estado del pedido.
     */
    public function cambiarEstado($id, $nuevoEstado)
    {
        try {
            $pedido = Order::find($id);
            $pedido->update(['estado' => $nuevoEstado]);

            $this->showNotification = true;
            $this->notificationMessage = 'Estado del pedido actualizado correctamente.';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al actualizar el estado del pedido.';
            $this->notificationType = 'error';
        }
    }

    public function confirmarEliminacion($id)
    {
        $this->pedidoAEliminar = $id;
        $this->showDeleteModal = true;
        $this->eliminacionmode = 'unico';
    }

    public function eliminarPedido()
    {
        if ($this->pedidoAEliminar) {
            try {
                DB::transaction(function () {
                    $pedido = Order::find($this->pedidoAEliminar);
                    $pedido->editions()->detach(); // Eliminar relaciones
                    $pedido->delete();
                });

                $this->showDeleteModal = false;
                $this->pedidoAEliminar = null;
                $this->showNotification = true;
                $this->notificationMessage = 'Pedido eliminado correctamente.';
                $this->notificationType = 'success';

            } catch (\Exception $e) {
                $this->showNotification = true;
                $this->notificationMessage = 'Error al eliminar el pedido.';
                $this->notificationType = 'error';
            }
        }
    }

    public function eliminarshowmodal()
    {
        if (count($this->selectedPedidos) >= 2) {
            $this->showDeleteModal = true;
            $this->eliminacionmode = 'multiple';
        }
    }

    public function eliminarPedidosSeleccionados()
    {
        if (count($this->selectedPedidos) >= 2) {
            try {
                DB::transaction(function () {
                    $pedidos = Order::whereIn('id', $this->selectedPedidos)->get();

                    foreach ($pedidos as $pedido) {
                        $pedido->editions()->detach();
                        $pedido->delete();
                    }
                });

                $this->selectedPedidos = [];
                $this->selectAll = false;
                $this->showDeleteModal = false;
                $this->eliminacionmode = 'unico';
                $this->showNotification = true;
                $this->notificationMessage = 'Pedidos eliminados correctamente.';
                $this->notificationType = 'success';

            } catch (\Exception $e) {
                $this->showNotification = true;
                $this->notificationMessage = 'Error al eliminar los pedidos.';
                $this->notificationType = 'error';
            }
        }
    }

    public function cancelarEliminacion()
    {
        $this->showDeleteModal = false;
        $this->pedidoAEliminar = null;
        $this->eliminacionmode = 'unico';
    }

    public function cerrarNotificacion()
    {
        $this->showNotification = false;
        $this->notificationMessage = '';
        $this->notificationType = 'success';
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedPedidos = $this->getPedidos()->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedPedidos = [];
        }
    }

    public function updatedSelectedPedidos()
    {
        $totalPedidosEnPagina = $this->getPedidos()->count();
        $this->selectAll = count($this->selectedPedidos) === $totalPedidosEnPagina;
    }

    private function getPedidos()
    {
        return Order::with(['user', 'address', 'paymentType', 'shipmentType'])
            ->when($this->search, function ($query) {
                $searchNormalized = $this->normalizarBusqueda($this->search);
                $query->where(function ($q) use ($searchNormalized) {
                    $q->where('id', 'like', '%' . $searchNormalized . '%')
                      ->orWhereHas('user', function ($userQuery) use ($searchNormalized) {
                          $userQuery->where('name', 'like', '%' . $searchNormalized . '%')
                                   ->orWhere('email', 'like', '%' . $searchNormalized . '%')
                                   ->orWhere('apellido', 'like', '%' . $searchNormalized . '%');
                      });
                });
            })
            ->when($this->statusFilter !== '', function ($query) {
                $query->where('estado', $this->statusFilter);
            })
            ->when($this->dateFilter, function ($query) {
                switch ($this->dateFilter) {
                    case 'today':
                        $query->whereDate('created_at', Carbon::today());
                        break;
                    case 'week':
                        $query->where('created_at', '>=', Carbon::now()->subWeek());
                        break;
                    case 'month':
                        $query->where('created_at', '>=', Carbon::now()->subMonth());
                        break;
                    case 'year':
                        $query->where('created_at', '>=', Carbon::now()->subYear());
                        break;
                }
            })
            ->when($this->userFilter, function ($query) {
                $query->where('user_id', $this->userFilter);
            })
            ->when($this->paymentFilter, function ($query) {
                $query->where('payment_type_id', $this->paymentFilter);
            })
            ->when($this->shipmentFilter, function ($query) {
                $query->where('shipment_type_id', $this->shipmentFilter);
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.pedidos-post', [
            'pedidos' => $this->getPedidos(),
            'usuarios' => User::orderBy('name')->get(),
            'paymentTypes' => PaymentType::orderBy('nombre')->get(),
            'shipmentTypes' => ShipmentType::orderBy('nombre')->get(),
        ]);
    }
}
