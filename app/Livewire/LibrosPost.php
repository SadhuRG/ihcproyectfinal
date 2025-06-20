<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Controllers\DatosController;

class LibrosPost extends Component
{
    public $datosOriginales = [];
    public $datos = [];
    public $sort = 'id';
    public $direction = 'asc';
    public $search = '';
    public $editando = null;
    public $libroEditado = [];
    public $currentPage = 1;
    public $perPage = 10;
    public $totalPages = 0;
    public $showDeleteModal = false;
    public $libroAEliminar = null;
    public $showNotification = false;
    public $notificationMessage = '';
    public $selectedLibros = [];
    public $selectAll = false;
    public $eliminacionmode = 'unico';
    public $mostrarModal = false;
    public $nuevaCategoria = '';
    public $nuevoAutor = '';
    public $nuevaEdicion = '';

    public function mount()
    {
        $datosController = new DatosController();
        $this->datosOriginales = $datosController->libros;

        // Transformar IDs a nombres
        foreach ($this->datosOriginales as &$libro) {
            // Transformar categorías
            $categorias = [];
            foreach ($libro['categorías'] as $catId) {
                foreach ($datosController->categories as $categoria) {
                    if ($categoria['id'] === $catId) {
                        $categorias[] = $categoria['nombre'];
                        break;
                    }
                }
            }
            $libro['categorías'] = $categorias;

            // Transformar autores
            $autores = [];
            foreach ($libro['autores'] as $autorId) {
                foreach ($datosController->authors as $autor) {
                    if ($autor['id'] === $autorId) {
                        $autores[] = $autor['nombre'] . ' ' . $autor['apellido'];
                        break;
                    }
                }
            }
            $libro['autores'] = $autores;

            // Transformar ediciones
            $ediciones = [];
            foreach ($libro['ediciones'] as $edicionId) {
                foreach ($datosController->editions as $edicion) {
                    if ($edicion['id'] === $edicionId) {
                        $ediciones[] = $edicion['numero_edicion'];
                        break;
                    }
                }
            }
            $libro['ediciones'] = $ediciones;
        }

        $this->filtrarDatos();
    }

    public function order($sort)
    {
        if ($this->sort === $sort) {
            $this->direction = $this->direction === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
        $this->currentPage = 1; // Resetear a la primera página al ordenar
        $this->filtrarDatos();
    }

    public function updatedSearch()
    {
        $this->currentPage = 1; // Resetear a la primera página al buscar
        $this->filtrarDatos();
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
        // Convertir el array a una colección para facilitar el manejo
        $datosFiltrados = collect($this->datosOriginales);

        // Aplicar filtro de búsqueda si existe
        if (!empty($this->search)) {
            $datosFiltrados = $datosFiltrados->filter(function ($item) {
                return stripos($item['titulo'], $this->search) !== false ||
                       stripos($item['ISBN'], $this->search) !== false ||
                       stripos($item['descripcion'], $this->search) !== false;
            });
        }

        // Ordenar los datos
        $datosFiltrados = $datosFiltrados->sortBy($this->sort, SORT_REGULAR, $this->direction === 'desc');

        // Calcular el número total de páginas
        $totalItems = $datosFiltrados->count();
        $this->totalPages = max(1, ceil($totalItems / $this->perPage));

        // Asegurar que la página actual esté dentro de los límites
        $this->currentPage = max(1, min($this->currentPage, $this->totalPages));

        // Obtener los elementos para la página actual
        $startIndex = ($this->currentPage - 1) * $this->perPage;
        $this->datos = $datosFiltrados->slice($startIndex, $this->perPage)->values()->all();
    }

    public function editarLibro($id)
    {
        $indice = array_search($id, array_column($this->datosOriginales, 'id'));
        if ($indice !== false) {
            $this->libroEditado = $this->datosOriginales[$indice];
            $this->editando = $id;
            $this->mostrarModal = true;
        }
    }

    public function agregarCategoria()
    {
        if (!empty($this->nuevaCategoria)) {
            if (!in_array($this->nuevaCategoria, $this->libroEditado['categorías'])) {
                $this->libroEditado['categorías'][] = $this->nuevaCategoria;
            }
            $this->nuevaCategoria = '';
        }
    }

    public function quitarCategoria($categoria)
    {
        $this->libroEditado['categorías'] = array_diff($this->libroEditado['categorías'], [$categoria]);
    }

    public function agregarAutor()
    {
        if (!empty($this->nuevoAutor)) {
            if (!in_array($this->nuevoAutor, $this->libroEditado['autores'])) {
                $this->libroEditado['autores'][] = $this->nuevoAutor;
            }
            $this->nuevoAutor = '';
        }
    }

    public function quitarAutor($autor)
    {
        $this->libroEditado['autores'] = array_diff($this->libroEditado['autores'], [$autor]);
    }

    public function agregarEdicion()
    {
        if (!empty($this->nuevaEdicion)) {
            if (!in_array($this->nuevaEdicion, $this->libroEditado['ediciones'])) {
                $this->libroEditado['ediciones'][] = $this->nuevaEdicion;
            }
            $this->nuevaEdicion = '';
        }
    }

    public function quitarEdicion($edicion)
    {
        $this->libroEditado['ediciones'] = array_diff($this->libroEditado['ediciones'], [$edicion]);
    }

    public function guardarLibro()
    {
        if ($this->editando !== null) {
            $indice = array_search($this->editando, array_column($this->datosOriginales, 'id'));
            if ($indice !== false) {
                $this->datosOriginales[$indice] = $this->libroEditado;
            }
        }

        $this->editando = null;
        $this->libroEditado = [];
        $this->mostrarModal = false;
        $this->filtrarDatos();
    }

    public function cancelarEdicion()
    {
        $this->mostrarModal = false;
        $this->editando = null;
        $this->libroEditado = [];
        $this->nuevaCategoria = '';
        $this->nuevoAutor = '';
        $this->nuevaEdicion = '';
    }

    public function confirmarEliminacion($id)
    {
        $this->libroAEliminar = $id;
        $this->showDeleteModal = true;
    }

    public function cancelarEliminacion()
    {
        $this->showDeleteModal = false;
        $this->libroAEliminar = null;
    }

    public function eliminarLibro()
    {
        if ($this->libroAEliminar) {
            $this->datosOriginales = array_filter($this->datosOriginales, function($libro) {
                return $libro['id'] != $this->libroAEliminar;
            });

            $this->notificationMessage = 'El libro ha sido eliminado correctamente';
            $this->showNotification = true;

            $this->showDeleteModal = false;
            $this->libroAEliminar = null;

            // Ajustar la página actual si es necesario
            $this->totalPages = ceil(count($this->datosOriginales) / $this->perPage);
            if ($this->currentPage > $this->totalPages && $this->totalPages > 0) {
                $this->currentPage = $this->totalPages;
            }

            $this->filtrarDatos();
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
            $this->selectedLibros = collect($this->datos)->pluck('id')->toArray();
        } else {
            $this->selectedLibros = [];
        }
    }

    public function updatedSelectedLibros()
    {
        $this->selectAll = count($this->selectedLibros) === count($this->datos);
    }

    public function eliminarshowmodal()
    {
        $this->showDeleteModal = true;
        $this->eliminacionmode = 'multiple';
    }

    public function canceleliminarshowmodal()
    {
        $this->showDeleteModal = false;
    }

    public function eliminarLibrosSeleccionados()
    {
        if (count($this->selectedLibros) >= 2) {
            $this->datosOriginales = array_filter($this->datosOriginales, function($libro) {
                return !in_array($libro['id'], $this->selectedLibros);
            });

            $this->notificationMessage = 'Los libros han sido eliminados correctamente';
            $this->showNotification = true;

            $this->selectedLibros = [];
            $this->selectAll = false;
            $this->showDeleteModal = false;
            $this->eliminacionmode = 'unico';

            // Ajustar la página actual si es necesario
            $this->totalPages = ceil(count($this->datosOriginales) / $this->perPage);
            if ($this->currentPage > $this->totalPages && $this->totalPages > 0) {
                $this->currentPage = $this->totalPages;
            }

            $this->filtrarDatos();
        }
    }

    public function render()
    {
        return view('livewire.libros-post', [
            'datos' => $this->datos,
            'total' => count($this->datosOriginales),
        ]);
    }

}
