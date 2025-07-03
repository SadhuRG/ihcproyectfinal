<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Edition;
use App\Models\Book;
use App\Models\Editorial;
use App\Models\Inventory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class EdicionesPost extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'asc';
    public $showEditModal = false;
    public $edicionEditada = [];
    public $showDeleteModal = false;
    public $edicionAEliminar = null;
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success';
    public $selectedEdiciones = [];
    public $selectAll = false;
    public $eliminacionmode = 'unico';
    public $showCreateModal = false;
    public $nuevaEdicion = [];

    // Para selects
    public $libros = [];
    public $editoriales = [];

    protected $listeners = [
        'libroCreado' => 'actualizarLibros',
        'libroActualizado' => 'actualizarLibros',
        'libroEliminado' => 'actualizarLibros'
    ];

    public function mount()
    {
        $this->cargarDatos();
    }

    public function cargarDatos()
    {
        $this->libros = Book::all();
        $this->editoriales = Editorial::all();
        $this->resetNuevaEdicion();
    }

    public function actualizarLibros()
    {
        $this->cargarDatos();
    }

    public function resetNuevaEdicion()
    {
        $this->nuevaEdicion = [
            'book_id' => '',
            'editorial_id' => '',
            'numero_edicion' => '',
            'precio' => '',
            'cantidad' => '',
            'umbral' => '',
            'url_portada' => '/images/covers/default.jpg'
        ];
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

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function editarEdicion($id)
    {
        $edicion = Edition::with(['book', 'editorial', 'inventory'])->find($id);

        if ($edicion) {
            $this->edicionEditada = [
                'id' => $edicion->id,
                'book_id' => $edicion->book_id,
                'editorial_id' => $edicion->editorial_id,
                'numero_edicion' => $edicion->numero_edicion,
                'precio' => $edicion->precio,
                'url_portada' => $edicion->url_portada,
                'cantidad' => $edicion->inventory ? $edicion->inventory->cantidad : 0,
                'umbral' => $edicion->inventory ? $edicion->inventory->umbral : 0
            ];
            $this->showEditModal = true;
        }
    }

    public function guardarEdicion()
    {
        $this->validate([
            'edicionEditada.book_id' => 'required|exists:books,id',
            'edicionEditada.editorial_id' => 'required|exists:editorials,id',
            'edicionEditada.numero_edicion' => 'required|string|max:50',
            'edicionEditada.precio' => 'required|numeric|min:0',
            'edicionEditada.cantidad' => 'required|integer|min:0',
            'edicionEditada.umbral' => 'required|integer|min:0'
        ]);

        try {
            DB::transaction(function () {
                $edicion = Edition::with('inventory')->find($this->edicionEditada['id']);

                // Actualizar edición
                $edicion->update([
                    'book_id' => $this->edicionEditada['book_id'],
                    'editorial_id' => $this->edicionEditada['editorial_id'],
                    'numero_edicion' => $this->edicionEditada['numero_edicion'],
                    'precio' => $this->edicionEditada['precio'],
                    'url_portada' => $this->edicionEditada['url_portada']
                ]);

                // Actualizar inventario
                if ($edicion->inventory) {
                    $edicion->inventory->update([
                        'cantidad' => $this->edicionEditada['cantidad'],
                        'umbral' => $this->edicionEditada['umbral']
                    ]);
                }
            });

            $this->showEditModal = false;
            $this->edicionEditada = [];

            $this->showNotification = true;
            $this->notificationMessage = 'Edición actualizada correctamente';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al actualizar la edición';
            $this->notificationType = 'error';
        }
    }

    public function crearEdicion()
    {
        $this->validate([
            'nuevaEdicion.book_id' => 'required|exists:books,id',
            'nuevaEdicion.editorial_id' => 'required|exists:editorials,id',
            'nuevaEdicion.numero_edicion' => 'required|string|max:50',
            'nuevaEdicion.precio' => 'required|numeric|min:0',
            'nuevaEdicion.cantidad' => 'required|integer|min:0',
            'nuevaEdicion.umbral' => 'required|integer|min:0'
        ]);

        try {
            DB::transaction(function () {
                // Crear inventario
                $inventario = Inventory::create([
                    'cantidad' => $this->nuevaEdicion['cantidad'],
                    'umbral' => $this->nuevaEdicion['umbral']
                ]);

                // Crear edición
                Edition::create([
                    'book_id' => $this->nuevaEdicion['book_id'],
                    'editorial_id' => $this->nuevaEdicion['editorial_id'],
                    'inventorie_id' => $inventario->id,
                    'numero_edicion' => $this->nuevaEdicion['numero_edicion'],
                    'precio' => $this->nuevaEdicion['precio'],
                    'url_portada' => $this->nuevaEdicion['url_portada']
                ]);
            });

            $this->showCreateModal = false;
            $this->resetNuevaEdicion();
            $this->showNotification = true;
            $this->notificationMessage = 'Edición creada correctamente';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al crear la edición';
            $this->notificationType = 'error';
        }
    }

    public function confirmarEliminacion($id)
    {
        $this->edicionAEliminar = $id;
        $this->showDeleteModal = true;
        $this->eliminacionmode = 'unico';
    }

    public function eliminarEdicion()
    {
        DB::transaction(function () {
            $edicion = Edition::with('inventory')->find($this->edicionAEliminar);

            if ($edicion) {
                // Eliminar inventario
                if ($edicion->inventory) {
                    $edicion->inventory->delete();
                }

                // Eliminar edición
                $edicion->delete();
            }
        });

        $this->showDeleteModal = false;
        $this->edicionAEliminar = null;
        $this->showNotification = true;
        $this->notificationMessage = 'Edición eliminada correctamente';
    }

    public function eliminarshowmodal()
    {
        if (count($this->selectedEdiciones) >= 2) {
            $this->showDeleteModal = true;
            $this->eliminacionmode = 'multiple';
        }
    }

    public function eliminarEdicionesSeleccionadas()
    {
        DB::transaction(function () {
            foreach ($this->selectedEdiciones as $edicionId) {
                $edicion = Edition::with('inventory')->find($edicionId);

                if ($edicion) {
                    // Eliminar inventario
                    if ($edicion->inventory) {
                        $edicion->inventory->delete();
                    }

                    // Eliminar edición
                    $edicion->delete();
                }
            }
        });

        $this->selectedEdiciones = [];
        $this->selectAll = false;
        $this->showDeleteModal = false;
        $this->eliminacionmode = 'unico';
        $this->showNotification = true;
        $this->notificationMessage = 'Ediciones eliminadas correctamente';
    }

    public function cancelarEliminacion()
    {
        $this->showDeleteModal = false;
        $this->edicionAEliminar = null;
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
            $this->selectedEdiciones = $this->getEdiciones()->pluck('id')->toArray();
        } else {
            $this->selectedEdiciones = [];
        }
    }

    public function updatedSelectedEdiciones()
    {
        $this->selectAll = count($this->selectedEdiciones) === $this->getEdiciones()->count();
    }

    public function getEdiciones()
    {
        return Edition::with(['book', 'editorial', 'inventory'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('numero_edicion', 'like', '%' . $this->search . '%')
                      ->orWhere('precio', 'like', '%' . $this->search . '%')
                      ->orWhereHas('book', function ($bookQuery) {
                          $bookQuery->where('titulo', 'like', '%' . $this->search . '%')
                                   ->orWhere('ISBN', 'like', '%' . $this->search . '%');
                      })
                      ->orWhereHas('editorial', function ($editorialQuery) {
                          $editorialQuery->where('nombre', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.ediciones-post', [
            'ediciones' => $this->getEdiciones()
        ]);
    }
} 