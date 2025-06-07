<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Controllers\DatosController;
use Livewire\WithPagination;

class UsuariosPost extends Component
{
    public $datosOriginales = []; // Datos sin modificar
    public $datos = []; // Datos que se muestran en la vista
    public $sort = 'id';
    public $direction = 'asc';
    public $search = '';
    public $editando = null;
    public $usuarioEditado = [];
    public $currentPage = 1;
    public $perPage = 10;
    public $totalPages = 0;
    public $showDeleteModal = false;
    public $usuarioAEliminar = null;
    public $showNotification = false;
    public $notificationMessage = '';
    public $selectedUsuarios = [];
    public $selectAll = false;
    public $eliminacionmode = 'unico';

    public function mount()
    {
        $datosController = new DatosController();
        $this->datosOriginales = $datosController->usuarios;
        $this->totalPages = ceil(count($this->datosOriginales) / $this->perPage);
        $this->filtrarDatos(); // Aplicar paginación desde el inicio
    }

    public function order($sort)
    {
        if ($this->sort === $sort) {
            $this->direction = $this->direction === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
        $this->filtrarDatos(); // Reordenar después de cambiar el criterio
    }

    public function editarUsuario($id)
    {
        $indice = array_search($id, array_column($this->datos, 'id'));

        if ($indice !== false) {
            $this->usuarioEditado = $this->datos[$indice];
            $this->editando = $id;
        }
    }

    public function guardarUsuario()
    {
        if ($this->editando !== null) {
            // Encontrar el índice correcto en $datos usando el ID que estamos editando
            $indice = array_search($this->editando, array_column($this->datos, 'id'));
            if ($indice !== false) {
                $this->datos[$indice] = $this->usuarioEditado;
            }

            // Encontrar y actualizar en datosOriginales
            $indiceOriginal = array_search($this->editando, array_column($this->datosOriginales, 'id'));
            if ($indiceOriginal !== false) {
                $this->datosOriginales[$indiceOriginal] = $this->usuarioEditado;
            }
        }

        $this->editando = null;
        $this->usuarioEditado = [];
    }

    public function nextPage()
    {
        if ($this->currentPage < $this->totalPages) {
            $this->currentPage++;
            $this->filtrarDatos();
        }
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->filtrarDatos();
        }
    }

    public function filtrarDatos()
    {
        // Filtrar sobre `$datosOriginales` en lugar de `$datos`
        $datosFiltrados = collect($this->datosOriginales);

        if (!empty($this->search)) {
            $datosFiltrados = $datosFiltrados->filter(function ($item) {
                return stripos($item['nombre'], $this->search) !== false ||
                       stripos($item['apellido'], $this->search) !== false;
                       stripos($item['email'], $this->search) !== false ||
                       stripos($item['rol'], $this->search) !== false;
            });
        }

        // Aplicar ordenamiento
        $datosFiltrados = $datosFiltrados->sortBy($this->sort, SORT_REGULAR, $this->direction === 'desc');

        // Aplicar paginación
        $this->totalPages = ceil($datosFiltrados->count() / $this->perPage);
        $this->datos = $datosFiltrados->forPage($this->currentPage, $this->perPage)->all();
    }

    public function updatedSearch()
    {
        $this->filtrarDatos(); // Se ejecuta cada vez que cambia `$search`
    }

    public function confirmarEliminacion($id)
    {
        $this->usuarioAEliminar = $id;
        $this->showDeleteModal = true;
    }

    public function cancelarEliminacion()
    {
        $this->showDeleteModal = false;
        $this->usuarioAEliminar = null;
    }

    public function eliminarUsuario()
    {
        if ($this->usuarioAEliminar) {
            // Encontrar y eliminar el usuario de datosOriginales
            $this->datosOriginales = array_filter($this->datosOriginales, function($usuario) {
                return $usuario['id'] != $this->usuarioAEliminar;
            });

            // Recalcular el total de páginas y ajustar la página actual si es necesario
            $this->totalPages = ceil(count($this->datosOriginales) / $this->perPage);
            if ($this->currentPage > $this->totalPages && $this->totalPages > 0) {
                $this->currentPage = $this->totalPages;
            }

            // Actualizar los datos mostrados
            $this->filtrarDatos();

            // Mostrar notificación
            $this->notificationMessage = 'El usuario ha sido eliminado correctamente';
            $this->showNotification = true;

            // Cerrar el modal de confirmación
            $this->showDeleteModal = false;
            $this->usuarioAEliminar = null;
        }
    }

    public function cerrarNotificacion()
    {
        $this->showNotification = false;
        $this->notificationMessage = '';
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedUsuarios = collect($this->datos)->pluck('id')->toArray();
        } else {
            $this->selectedUsuarios = [];
        }
    }

    public function updatedSelectedUsuarios()
    {
        $this->selectAll = count($this->selectedUsuarios) === count($this->datos);
    }

    public function eliminarshowmodal()
    {
        $this->selectedUsuarios = $this->selectedUsuarios;
        $this->showDeleteModal = true;
        $this->eliminacionmode = 'multiple';
    }

    public function canceleliminarshowmodal()
    {
        $this->showDeleteModal = false;
    }

    public function eliminarUsuariosSeleccionados()
    {
        if (count($this->selectedUsuarios) >= 2) {
            // Eliminar los usuarios seleccionados
            $this->datosOriginales = array_filter($this->datosOriginales, function($usuario) {
                return !in_array($usuario['id'], $this->selectedUsuarios);
            });

            // Recalcular el total de páginas y ajustar la página actual si es necesario
            $this->totalPages = ceil(count($this->datosOriginales) / $this->perPage);
            if ($this->currentPage > $this->totalPages && $this->totalPages > 0) {
                $this->currentPage = $this->totalPages;
            }

            // Actualizar los datos mostrados
            $this->filtrarDatos();

            // Mostrar notificación
            $this->notificationMessage = 'Los usuarios han sido eliminados correctamente';
            $this->showNotification = true;

            // Limpiar selección
            $this->selectedUsuarios = [];
            $this->selectAll = false;
            $this->showDeleteModal = false;
            $this->eliminacionmode = 'unico';
        }
    }

    public function render()
    {
        return view('livewire.usuarios-post', ['datos' => $this->datos]);
    }
}
