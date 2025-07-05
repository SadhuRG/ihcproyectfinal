<?php

namespace App\Livewire;

use App\Models\SupportTicket;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class SoportePost extends Component
{
    use WithPagination;

    // Propiedades para la tabla
    public $search = '';
    public $sort = 'created_at';
    public $direction = 'desc';
    public $statusFilter = '';

    // Propiedades para el modal de respuesta
    public $showResponseModal = false;
    public $ticketSeleccionado = null;
    public $mensajeAdmin = '';
    public $nuevoEstado = '';

    // Propiedades para notificaciones
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success';

    public function mount()
    {
        // Inicializar filtros
    }

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

    public function order($sort)
    {
        if ($this->sort === $sort) {
            $this->direction = $this->direction === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function responderTicket($ticketId)
    {
        $ticket = SupportTicket::with('user')->find($ticketId);
        
        if ($ticket) {
            $this->ticketSeleccionado = $ticket;
            $this->mensajeAdmin = $ticket->mensaje_admin ?? '';
            $this->nuevoEstado = $ticket->estado;
            $this->showResponseModal = true;
        }
    }

    public function guardarRespuesta()
    {
        $this->validate([
            'mensajeAdmin' => 'nullable|string|max:1000',
            'nuevoEstado' => 'required|in:enviado,recibido,solucionado'
        ], [
            'mensajeAdmin.max' => 'El mensaje no puede exceder 1000 caracteres.',
            'nuevoEstado.required' => 'Debe seleccionar un estado.',
            'nuevoEstado.in' => 'El estado seleccionado no es válido.'
        ]);

        // Verificar límite de palabras si hay mensaje
        if (!empty($this->mensajeAdmin)) {
            if (SupportTicket::exceedsWordLimit($this->mensajeAdmin, 500)) {
                $this->showNotification = true;
                $this->notificationMessage = 'El mensaje no puede exceder 500 palabras.';
                $this->notificationType = 'error';
                return;
            }
        }

        try {
            $ticket = SupportTicket::find($this->ticketSeleccionado['id']);
            
            $ticket->update([
                'mensaje_admin' => $this->mensajeAdmin,
                'estado' => $this->nuevoEstado
            ]);

            $this->showResponseModal = false;
            $this->ticketSeleccionado = null;
            $this->mensajeAdmin = '';
            $this->nuevoEstado = '';

            $this->showNotification = true;
            $this->notificationMessage = 'Respuesta guardada correctamente.';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al guardar la respuesta.';
            $this->notificationType = 'error';
        }
    }

    public function cerrarModal()
    {
        $this->showResponseModal = false;
        $this->ticketSeleccionado = null;
        $this->mensajeAdmin = '';
        $this->nuevoEstado = '';
    }

    public function cerrarNotificacion()
    {
        $this->showNotification = false;
        $this->notificationMessage = '';
        $this->notificationType = 'success';
    }

    public function getTickets()
    {
        return SupportTicket::with(['user'])
            ->when($this->search, function ($query) {
                $searchNormalized = $this->normalizarBusqueda($this->search);
                $query->where(function ($q) use ($searchNormalized) {
                    $q->where('asunto', 'like', '%' . $searchNormalized . '%')
                      ->orWhere('mensaje_usuario', 'like', '%' . $searchNormalized . '%')
                      ->orWhere('mensaje_admin', 'like', '%' . $searchNormalized . '%')
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
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
    }

    public function getContadorPalabras()
    {
        return SupportTicket::countWords($this->mensajeAdmin);
    }

    public function render()
    {
        return view('livewire.soporte-post', [
            'tickets' => $this->getTickets()
        ]);
    }
}
