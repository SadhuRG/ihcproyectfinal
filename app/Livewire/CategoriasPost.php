<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class CategoriasPost extends Component
{
    use WithPagination;

    // Propiedades de búsqueda y ordenamiento
    public $search = '';
    public $sort = 'id';
    public $direction = 'asc';

    // Propiedades de edición
    public $showEditModal = false;
    public $categoriaEditada = [];

    // Propiedades de eliminación
    public $showDeleteModal = false;
    public $categoriaAEliminar = null;
    public $selectedCategorias = [];
    public $selectAll = false;
    public $eliminacionmode = 'unico';

    // Propiedades de notificación
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success';

    // Propiedades de creación
    public $showCreateModal = false;
    public $nuevaCategoria = [];

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->resetNuevaCategoria();
    }

    public function resetNuevaCategoria()
    {
        $this->nuevaCategoria = [
            'nombre' => ''
        ];
    }

    public function updatedSearch()
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

    public function editarCategoria($id)
    {
        $categoria = Category::find($id);

        if ($categoria) {
            $this->categoriaEditada = [
                'id' => $categoria->id,
                'nombre' => $categoria->nombre
            ];
            $this->showEditModal = true;
        }
    }

    public function guardarCategoria()
    {
        $this->validate([
            'categoriaEditada.nombre' => 'required|string|max:50|unique:categories,nombre,' . $this->categoriaEditada['id']
        ]);

        try {
            $categoria = Category::find($this->categoriaEditada['id']);
            $categoria->update([
                'nombre' => $this->categoriaEditada['nombre']
            ]);

            $this->showEditModal = false;
            $this->categoriaEditada = [];
            $this->showNotification = true;
            $this->notificationMessage = 'Categoría actualizada correctamente.';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al actualizar la categoría.';
            $this->notificationType = 'error';
        }
    }

    public function crearCategoria()
    {
        $this->validate([
            'nuevaCategoria.nombre' => 'required|string|max:50|unique:categories,nombre'
        ]);

        try {
            Category::create([
                'nombre' => $this->nuevaCategoria['nombre']
            ]);

            $this->showCreateModal = false;
            $this->resetNuevaCategoria();
            $this->showNotification = true;
            $this->notificationMessage = 'Categoría creada correctamente.';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al crear la categoría.';
            $this->notificationType = 'error';
        }
    }

    public function confirmarEliminacion($id)
    {
        $this->categoriaAEliminar = $id;
        $this->showDeleteModal = true;
        $this->eliminacionmode = 'unico';
    }

    public function eliminarCategoria()
    {
        if ($this->categoriaAEliminar) {
            try {
                $categoria = Category::find($this->categoriaAEliminar);

                // Verificar si tiene libros asociados
                if ($categoria->books()->count() > 0) {
                    $this->showNotification = true;
                    $this->notificationMessage = 'No se puede eliminar la categoría porque tiene libros asociados.';
                    $this->notificationType = 'error';
                    $this->showDeleteModal = false;
                    return;
                }

                $categoria->delete();

                $this->showDeleteModal = false;
                $this->categoriaAEliminar = null;
                $this->showNotification = true;
                $this->notificationMessage = 'Categoría eliminada correctamente.';
                $this->notificationType = 'success';

            } catch (\Exception $e) {
                $this->showNotification = true;
                $this->notificationMessage = 'Error al eliminar la categoría.';
                $this->notificationType = 'error';
            }
        }
    }

    public function eliminarshowmodal()
    {
        if (count($this->selectedCategorias) >= 2) {
            $this->showDeleteModal = true;
            $this->eliminacionmode = 'multiple';
        }
    }

    public function eliminarCategoriasSeleccionadas()
    {
        if (count($this->selectedCategorias) >= 2) {
            try {
                $categoriasConLibros = Category::whereIn('id', $this->selectedCategorias)
                    ->whereHas('books')
                    ->count();

                if ($categoriasConLibros > 0) {
                    $this->showNotification = true;
                    $this->notificationMessage = 'Algunas categorías no se pueden eliminar porque tienen libros asociados.';
                    $this->notificationType = 'error';
                    $this->showDeleteModal = false;
                    return;
                }

                Category::whereIn('id', $this->selectedCategorias)->delete();

                $this->selectedCategorias = [];
                $this->selectAll = false;
                $this->showDeleteModal = false;
                $this->eliminacionmode = 'unico';
                $this->showNotification = true;
                $this->notificationMessage = 'Categorías eliminadas correctamente.';
                $this->notificationType = 'success';

            } catch (\Exception $e) {
                $this->showNotification = true;
                $this->notificationMessage = 'Error al eliminar las categorías.';
                $this->notificationType = 'error';
            }
        }
    }

    public function cancelarEliminacion()
    {
        $this->showDeleteModal = false;
        $this->categoriaAEliminar = null;
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
            $this->selectedCategorias = $this->getCategorias()->pluck('id')->toArray();
        } else {
            $this->selectedCategorias = [];
        }
    }

    public function updatedSelectedCategorias()
    {
        $totalCategoriasEnPagina = $this->getCategorias()->count();
        $this->selectAll = count($this->selectedCategorias) === $totalCategoriasEnPagina;
    }

    private function getCategorias()
    {
        return Category::withCount('books')
            ->when($this->search, function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.categorias-post', [
            'categorias' => $this->getCategorias()
        ]);
    }
}
