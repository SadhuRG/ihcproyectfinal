<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inventory;
use App\Models\Edition;
use App\Models\Book;
use App\Models\Editorial;
use Illuminate\Support\Facades\DB;

class InventarioPost extends Component
{
    use WithPagination;

    // Propiedades de búsqueda y ordenamiento
    public $search = '';
    public $sort = 'id';
    public $direction = 'asc';
    public $stockFilter = ''; // todos, bajo_umbral, stock_normal

    // Propiedades de edición
    public $showEditModal = false;
    public $inventarioEditado = [];

    // Propiedades de eliminación
    public $showDeleteModal = false;
    public $inventarioAEliminar = null;
    public $selectedInventarios = [];
    public $selectAll = false;
    public $eliminacionmode = 'unico';

    // Propiedades de notificación
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success';

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

    public function updatedStockFilter()
    {
        $this->resetPage();
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

    /**
     * Crea un nuevo inventario.
     */
    public function crearInventario()
    {
        $this->validate([
            'nuevoInventario.edition_id' => 'required|exists:editions,id|unique:inventories,edition_id',
            'nuevoInventario.cantidad' => 'required|integer|min:0',
            'nuevoInventario.umbral' => 'required|integer|min:0'
        ]);

        try {
            DB::transaction(function () {
                Inventory::create([
                    'cantidad' => $this->nuevoInventario['cantidad'],
                    'umbral' => $this->nuevoInventario['umbral']
                ]);

                // Actualizar la edición con el inventario creado
                $inventario = Inventory::latest('id')->first();
                Edition::where('id', $this->nuevoInventario['edition_id'])
                       ->update(['inventorie_id' => $inventario->id]);
            });

            $this->showCreateModal = false;
            $this->resetNuevoInventario();
            $this->showNotification = true;
            $this->notificationMessage = 'Inventario creado correctamente';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al crear el inventario';
            $this->notificationType = 'error';
        }
    }

    /**
     * Prepara los datos del inventario y abre el modal de edición.
     */
    public function editarInventario($id)
    {
        $inventario = Inventory::find($id);
        $edicion = Edition::where('inventorie_id', $id)->with(['book', 'editorial'])->first();

        if ($inventario) {
            $this->inventarioEditado = [
                'id' => $inventario->id,
                'cantidad' => $inventario->cantidad,
                'umbral' => $inventario->umbral,
                'edition_id' => $edicion ? $edicion->id : null
            ];
            $this->showEditModal = true;
        }
    }

    /**
     * Guarda los cambios del inventario desde el modal de edición.
     */
    public function guardarInventario()
    {
        $this->validate([
            'inventarioEditado.cantidad' => 'required|integer|min:0',
            'inventarioEditado.umbral' => 'required|integer|min:0'
        ]);

        try {
            $inventario = Inventory::find($this->inventarioEditado['id']);

            $inventario->update([
                'cantidad' => $this->inventarioEditado['cantidad'],
                'umbral' => $this->inventarioEditado['umbral']
            ]);

            $this->showEditModal = false;
            $this->inventarioEditado = [];
            $this->showNotification = true;
            $this->notificationMessage = 'Inventario actualizado correctamente';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al actualizar el inventario';
            $this->notificationType = 'error';
        }
    }

    public function confirmarEliminacion($id)
    {
        $this->inventarioAEliminar = $id;
        $this->showDeleteModal = true;
        $this->eliminacionmode = 'unico';
    }

    public function eliminarInventario()
    {
        if ($this->inventarioAEliminar) {
            try {
                DB::transaction(function () {
                    $inventario = Inventory::find($this->inventarioAEliminar);

                    // Desasociar de la edición
                    Edition::where('inventorie_id', $inventario->id)
                           ->update(['inventorie_id' => null]);

                    $inventario->delete();
                });

                $this->showDeleteModal = false;
                $this->inventarioAEliminar = null;
                $this->showNotification = true;
                $this->notificationMessage = 'Inventario eliminado correctamente';
                $this->notificationType = 'success';

            } catch (\Exception $e) {
                $this->showNotification = true;
                $this->notificationMessage = 'Error al eliminar el inventario';
                $this->notificationType = 'error';
            }
        }
    }

    public function eliminarshowmodal()
    {
        if (count($this->selectedInventarios) >= 2) {
            $this->showDeleteModal = true;
            $this->eliminacionmode = 'multiple';
        }
    }

    public function eliminarInventariosSeleccionados()
    {
        if (count($this->selectedInventarios) >= 2) {
            try {
                DB::transaction(function () {
                    $inventarios = Inventory::whereIn('id', $this->selectedInventarios)->get();

                    foreach ($inventarios as $inventario) {
                        // Desasociar de la edición
                        Edition::where('inventorie_id', $inventario->id)
                               ->update(['inventorie_id' => null]);
                        $inventario->delete();
                    }
                });

                $this->selectedInventarios = [];
                $this->selectAll = false;
                $this->showDeleteModal = false;
                $this->eliminacionmode = 'unico';
                $this->showNotification = true;
                $this->notificationMessage = 'Inventarios eliminados correctamente';
                $this->notificationType = 'success';

            } catch (\Exception $e) {
                $this->showNotification = true;
                $this->notificationMessage = 'Error al eliminar los inventarios';
                $this->notificationType = 'error';
            }
        }
    }

    public function cancelarEliminacion()
    {
        $this->showDeleteModal = false;
        $this->inventarioAEliminar = null;
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
            $this->selectedInventarios = $this->getInventarios()->pluck('id')->toArray();
        } else {
            $this->selectedInventarios = [];
        }
    }

    public function updatedSelectedInventarios()
    {
        $this->selectAll = count($this->selectedInventarios) === $this->getInventarios()->count();
    }

    private function getInventarios()
    {
        return Inventory::select('inventories.*')
            ->leftJoin('editions', 'editions.inventorie_id', '=', 'inventories.id')
            ->leftJoin('books', 'editions.book_id', '=', 'books.id')
            ->leftJoin('editorials', 'editions.editorial_id', '=', 'editorials.id')
            ->whereNotNull('editions.id') // Solo inventarios con edición asociada
            ->when($this->search, function ($query) {
                $searchNormalized = $this->normalizarBusqueda($this->search);
                $query->where(function ($q) use ($searchNormalized) {
                    $q->where('inventories.cantidad', 'like', '%' . $searchNormalized . '%')
                      ->orWhere('inventories.umbral', 'like', '%' . $searchNormalized . '%')
                      ->orWhere('books.titulo', 'like', '%' . $searchNormalized . '%')
                      ->orWhere('books.ISBN', 'like', '%' . $searchNormalized . '%')
                      ->orWhere('editorials.nombre', 'like', '%' . $searchNormalized . '%');
                });
            })
            ->when($this->stockFilter === 'bajo_umbral', function ($query) {
                $query->whereRaw('inventories.cantidad <= inventories.umbral');
            })
            ->when($this->stockFilter === 'stock_normal', function ($query) {
                $query->whereRaw('inventories.cantidad > inventories.umbral');
            })
            ->orderBy('inventories.' . $this->sort, $this->direction)
            ->with(['edition.book', 'edition.editorial'])
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.inventario-post', [
            'inventarios' => $this->getInventarios()
        ]);
    }
}
