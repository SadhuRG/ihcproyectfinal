<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Editorial;

class EditorialesPost extends Component
{
    use WithPagination;

    // Propiedades de búsqueda y ordenamiento
    public $search = '';
    public $sort = 'id';
    public $direction = 'asc';

    // Propiedades de edición
    public $showEditModal = false;
    public $editorialEditada = [];

    // Propiedades de eliminación
    public $showDeleteModal = false;
    public $editorialAEliminar = null;
    public $selectedEditoriales = [];
    public $selectAll = false;
    public $eliminacionmode = 'unico';

    // Propiedades de notificación
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success';

    // Propiedades de creación
    public $showCreateModal = false;
    public $nuevaEditorial = [];

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->resetNuevaEditorial();
    }

    public function resetNuevaEditorial()
    {
        $this->nuevaEditorial = [
            'nombre' => ''
        ];
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

    public function editarEditorial($id)
    {
        $editorial = Editorial::find($id);

        if ($editorial) {
            $this->editorialEditada = [
                'id' => $editorial->id,
                'nombre' => $editorial->nombre
            ];
            $this->showEditModal = true;
        }
    }

    public function guardarEditorial()
    {
        $this->validate([
            'editorialEditada.nombre' => 'required|string|max:100|unique:editorials,nombre,' . $this->editorialEditada['id']
        ]);

        try {
            $editorial = Editorial::find($this->editorialEditada['id']);
            $editorial->update([
                'nombre' => $this->editorialEditada['nombre']
            ]);

            $this->showEditModal = false;
            $this->showNotification = true;
            $this->notificationMessage = 'Editorial actualizada correctamente.';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al actualizar la editorial.';
            $this->notificationType = 'error';
        }
    }

    public function crearEditorial()
    {
        $this->validate([
            'nuevaEditorial.nombre' => 'required|string|max:100|unique:editorials,nombre'
        ]);

        try {
            Editorial::create([
                'nombre' => $this->nuevaEditorial['nombre']
            ]);

            $this->showCreateModal = false;
            $this->resetNuevaEditorial();
            $this->showNotification = true;
            $this->notificationMessage = 'Editorial creada correctamente.';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al crear la editorial.';
            $this->notificationType = 'error';
        }
    }

    public function confirmarEliminacion($id)
    {
        $this->editorialAEliminar = $id;
        $this->showDeleteModal = true;
        $this->eliminacionmode = 'unico';
    }

    public function eliminarEditorial()
    {
        if ($this->editorialAEliminar) {
            try {
                $editorial = Editorial::find($this->editorialAEliminar);

                // Verificar si tiene ediciones asociadas
                if ($editorial->editions()->count() > 0) {
                    $this->showNotification = true;
                    $this->notificationMessage = 'No se puede eliminar la editorial porque tiene libros asociados.';
                    $this->notificationType = 'error';
                    $this->showDeleteModal = false;
                    return;
                }

                $editorial->delete();

                $this->showDeleteModal = false;
                $this->editorialAEliminar = null;
                $this->showNotification = true;
                $this->notificationMessage = 'Editorial eliminada correctamente.';
                $this->notificationType = 'success';

            } catch (\Exception $e) {
                $this->showNotification = true;
                $this->notificationMessage = 'Error al eliminar la editorial.';
                $this->notificationType = 'error';
            }
        }
    }

    public function eliminarshowmodal()
    {
        if (count($this->selectedEditoriales) >= 2) {
            $this->showDeleteModal = true;
            $this->eliminacionmode = 'multiple';
        }
    }

    public function eliminarEditorialesSeleccionadas()
    {
        if (count($this->selectedEditoriales) >= 2) {
            try {
                $editorialesConLibros = Editorial::whereIn('id', $this->selectedEditoriales)
                    ->whereHas('editions')
                    ->count();

                if ($editorialesConLibros > 0) {
                    $this->showNotification = true;
                    $this->notificationMessage = 'Algunas editoriales no se pueden eliminar porque tienen libros asociados.';
                    $this->notificationType = 'error';
                    $this->showDeleteModal = false;
                    return;
                }

                Editorial::whereIn('id', $this->selectedEditoriales)->delete();

                $this->selectedEditoriales = [];
                $this->selectAll = false;
                $this->showDeleteModal = false;
                $this->eliminacionmode = 'unico';
                $this->showNotification = true;
                $this->notificationMessage = 'Editoriales eliminadas correctamente.';
                $this->notificationType = 'success';

            } catch (\Exception $e) {
                $this->showNotification = true;
                $this->notificationMessage = 'Error al eliminar las editoriales.';
                $this->notificationType = 'error';
            }
        }
    }

    public function cancelarEliminacion()
    {
        $this->showDeleteModal = false;
        $this->editorialAEliminar = null;
        $this->eliminacionmode = 'unico';
    }

    public function cerrarNotificacion()
    {
        $this->showNotification = false;
        $this->notificationMessage = '';
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedEditoriales = $this->getEditoriales()->pluck('id')->map(fn($id) => (string) $id);
        } else {
            $this->selectedEditoriales = [];
        }
    }

    public function updatedSelectedEditoriales()
    {
        $totalEditorialesEnPagina = $this->getEditoriales()->count();
        $this->selectAll = count($this->selectedEditoriales) === $totalEditorialesEnPagina;
    }

    private function getEditoriales()
    {
        return Editorial::withCount('editions')
            ->when($this->search, function ($query) {
                $searchNormalized = $this->normalizarBusqueda($this->search);
                $query->where('nombre', 'like', '%' . $searchNormalized . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.editoriales-post', [
            'editoriales' => $this->getEditoriales()
        ]);
    }
}
