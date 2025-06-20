<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Author;
use Illuminate\Validation\Rule;

class AutoresPost extends Component
{
    use WithPagination;

    // Propiedades de búsqueda y ordenamiento
    public $search = '';
    public $sort = 'id';
    public $direction = 'asc';

    // Propiedades de edición
    public $showEditModal = false;
    public $autorEditado = [];

    // Propiedades de eliminación
    public $showDeleteModal = false;
    public $autorAEliminar = null;
    public $selectedAutores = [];
    public $selectAll = false;
    public $eliminacionmode = 'unico';

    // Propiedades de notificación
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success';

    // Propiedades de creación
    public $showCreateModal = false;
    public $nuevoAutor = [];

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->resetNuevoAutor();
    }

    public function resetNuevoAutor()
    {
        $this->nuevoAutor = [
            'nombre' => '',
            'apellido' => ''
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

    public function editarAutor($id)
    {
        $autor = Author::find($id);

        if ($autor) {
            $this->autorEditado = [
                'id' => $autor->id,
                'nombre' => $autor->nombre,
                'apellido' => $autor->apellido
            ];
            $this->showEditModal = true;
        }
    }

    public function guardarAutor()
    {
        $this->validate([
            'autorEditado.nombre' => 'required|string|max:100',
            'autorEditado.apellido' => 'required|string|max:100'
        ]);

        try {
            $autor = Author::find($this->autorEditado['id']);
            $autor->update([
                'nombre' => $this->autorEditado['nombre'],
                'apellido' => $this->autorEditado['apellido']
            ]);

            $this->showEditModal = false;
            $this->autorEditado = [];
            $this->showNotification = true;
            $this->notificationMessage = 'Autor actualizado correctamente.';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al actualizar el autor.';
            $this->notificationType = 'error';
        }
    }

    public function crearAutor()
    {
        $this->validate([
            'nuevoAutor.nombre' => 'required|string|max:100',
            'nuevoAutor.apellido' => 'required|string|max:100'
        ]);

        try {
            Author::create([
                'nombre' => $this->nuevoAutor['nombre'],
                'apellido' => $this->nuevoAutor['apellido']
            ]);

            $this->showCreateModal = false;
            $this->resetNuevoAutor();
            $this->showNotification = true;
            $this->notificationMessage = 'Autor creado correctamente.';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al crear el autor.';
            $this->notificationType = 'error';
        }
    }

    public function confirmarEliminacion($id)
    {
        $this->autorAEliminar = $id;
        $this->showDeleteModal = true;
        $this->eliminacionmode = 'unico';
    }

    public function eliminarAutor()
    {
        if ($this->autorAEliminar) {
            try {
                $autor = Author::find($this->autorAEliminar);

                // Verificar si tiene libros asociados
                if ($autor->books()->count() > 0) {
                    $this->showNotification = true;
                    $this->notificationMessage = 'No se puede eliminar el autor porque tiene libros asociados.';
                    $this->notificationType = 'error';
                    $this->showDeleteModal = false;
                    return;
                }

                $autor->delete();

                $this->showDeleteModal = false;
                $this->autorAEliminar = null;
                $this->showNotification = true;
                $this->notificationMessage = 'Autor eliminado correctamente.';
                $this->notificationType = 'success';

            } catch (\Exception $e) {
                $this->showNotification = true;
                $this->notificationMessage = 'Error al eliminar el autor.';
                $this->notificationType = 'error';
            }
        }
    }

    public function eliminarshowmodal()
    {
        if (count($this->selectedAutores) >= 2) {
            $this->showDeleteModal = true;
            $this->eliminacionmode = 'multiple';
        }
    }

    public function eliminarAutoresSeleccionados()
    {
        if (count($this->selectedAutores) >= 2) {
            try {
                $autoresConLibros = Author::whereIn('id', $this->selectedAutores)
                    ->whereHas('books')
                    ->count();

                if ($autoresConLibros > 0) {
                    $this->showNotification = true;
                    $this->notificationMessage = 'Algunos autores no se pueden eliminar porque tienen libros asociados.';
                    $this->notificationType = 'error';
                    $this->showDeleteModal = false;
                    return;
                }

                Author::whereIn('id', $this->selectedAutores)->delete();

                $this->selectedAutores = [];
                $this->selectAll = false;
                $this->showDeleteModal = false;
                $this->eliminacionmode = 'unico';
                $this->showNotification = true;
                $this->notificationMessage = 'Autores eliminados correctamente.';
                $this->notificationType = 'success';

            } catch (\Exception $e) {
                $this->showNotification = true;
                $this->notificationMessage = 'Error al eliminar los autores.';
                $this->notificationType = 'error';
            }
        }
    }

    public function cancelarEliminacion()
    {
        $this->showDeleteModal = false;
        $this->autorAEliminar = null;
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
            $this->selectedAutores = $this->getAutores()->pluck('id')->toArray();
        } else {
            $this->selectedAutores = [];
        }
    }

    public function updatedSelectedAutores()
    {
        $totalAutoresEnPagina = $this->getAutores()->count();
        $this->selectAll = count($this->selectedAutores) === $totalAutoresEnPagina;
    }

    private function getAutores()
    {
        return Author::withCount('books')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nombre', 'like', '%' . $this->search . '%')
                      ->orWhere('apellido', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.autores-post', [
            'autores' => $this->getAutores()
        ]);
    }
}
