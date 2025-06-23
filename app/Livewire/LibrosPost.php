<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Editorial;
use App\Models\Edition;
use App\Models\Inventory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class LibrosPost extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'asc';
    public $showEditModal = false;
    public $libroEditado = [];
    public $showDeleteModal = false;
    public $libroAEliminar = null;
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success'; // success, error, warning
    public $selectedLibros = [];
    public $selectAll = false;
    public $eliminacionmode = 'unico';
    public $showCreateModal = false;
    public $nuevoLibro = [];

    // Para selects
    public $autores = [];
    public $categorias = [];
    public $editoriales = [];
    public $autorSeleccionado = [];
    public $categoriaSeleccionada = [];

    public function mount()
    {
        $this->autores = Author::all();
        $this->categorias = Category::all();
        $this->editoriales = Editorial::all();
        $this->resetNuevoLibro();
    }

    public function resetNuevoLibro()
    {
        $this->nuevoLibro = [
            'titulo' => '',
            'ISBN' => '',
            'descripcion' => '',
            'editorial_id' => '',
            'numero_edicion' => '',
            'precio' => '',
            'cantidad' => '',
            'umbral' => ''
        ];
        $this->autorSeleccionado = [];
        $this->categoriaSeleccionada = [];
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

    public function editarLibro($id)
    {
        $libro = Book::with(['authors', 'categories', 'editions.editorial'])->find($id);

        if ($libro) {
            $edicion = $libro->editions->first();

            $this->libroEditado = [
                'id' => $libro->id,
                'titulo' => $libro->titulo,
                'ISBN' => $libro->ISBN,
                'descripcion' => $libro->descripcion,
                'editorial_id' => $edicion ? $edicion->editorial_id : '',
                'numero_edicion' => $edicion ? $edicion->numero_edicion : '',
                'precio' => $edicion ? $edicion->precio : ''
            ];

            $this->autorSeleccionado = $libro->authors->pluck('id')->toArray();
            $this->categoriaSeleccionada = $libro->categories->pluck('id')->toArray();
            $this->showEditModal = true;
        }
    }

    public function guardarLibro()
    {
        $this->validate([
            'libroEditado.titulo' => 'required|string|max:100',
            'libroEditado.ISBN' => 'required|string|max:50',
            'libroEditado.descripcion' => 'nullable|string|max:100',
            'libroEditado.editorial_id' => 'required|exists:editorials,id',
            'libroEditado.numero_edicion' => 'required|string|max:50',
            'libroEditado.precio' => 'required|numeric|min:0'
        ]);

        try {
            DB::transaction(function () {
                $libro = Book::find($this->libroEditado['id']);

                // Actualizar libro
                $libro->update([
                    'titulo' => $this->libroEditado['titulo'],
                    'ISBN' => $this->libroEditado['ISBN'],
                    'descripcion' => $this->libroEditado['descripcion']
                ]);

                // Actualizar relaciones
                $libro->authors()->sync($this->autorSeleccionado);
                $libro->categories()->sync($this->categoriaSeleccionada);

                // Actualizar edición
                $edicion = $libro->editions->first();
                if ($edicion) {
                    $edicion->update([
                        'editorial_id' => $this->libroEditado['editorial_id'],
                        'numero_edicion' => $this->libroEditado['numero_edicion'],
                        'precio' => $this->libroEditado['precio']
                    ]);
                }
            });

            $this->showEditModal = false;
            $this->libroEditado = [];
            $this->autorSeleccionado = [];
            $this->categoriaSeleccionada = [];

            $this->showNotification = true;
            $this->notificationMessage = 'Libro actualizado correctamente';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al actualizar el libro';
            $this->notificationType = 'error';
        }
    }

    public function crearLibro()
    {
        $this->validate([
            'nuevoLibro.titulo' => 'required|string|max:100',
            'nuevoLibro.ISBN' => 'required|string|max:50|unique:books,ISBN',
            'nuevoLibro.descripcion' => 'nullable|string|max:100',
            'nuevoLibro.editorial_id' => 'required|exists:editorials,id',
            'nuevoLibro.numero_edicion' => 'required|string|max:50',
            'nuevoLibro.precio' => 'required|numeric|min:0',
            'nuevoLibro.cantidad' => 'required|integer|min:0',
            'nuevoLibro.umbral' => 'required|integer|min:0'
        ]);

        try {
            DB::transaction(function () {
                // Crear libro
                $libro = Book::create([
                    'titulo' => $this->nuevoLibro['titulo'],
                    'ISBN' => $this->nuevoLibro['ISBN'],
                    'descripcion' => $this->nuevoLibro['descripcion']
                ]);

                // Crear inventario con los valores proporcionados
                $inventario = Inventory::create([
                    'cantidad' => $this->nuevoLibro['cantidad'],
                    'umbral' => $this->nuevoLibro['umbral']
                ]);

                // Crear edición
                Edition::create([
                    'editorial_id' => $this->nuevoLibro['editorial_id'],
                    'inventorie_id' => $inventario->id,
                    'book_id' => $libro->id,
                    'url_portada' => '/images/covers/default.jpg',
                    'numero_edicion' => $this->nuevoLibro['numero_edicion'],
                    'precio' => $this->nuevoLibro['precio']
                ]);

                // Asignar relaciones
                if (!empty($this->autorSeleccionado)) {
                    $libro->authors()->sync($this->autorSeleccionado);
                }
                if (!empty($this->categoriaSeleccionada)) {
                    $libro->categories()->sync($this->categoriaSeleccionada);
                }
            });

            $this->showCreateModal = false;
            $this->resetNuevoLibro();
            $this->showNotification = true;
            $this->notificationMessage = 'Libro creado correctamente con inventario inicial establecido.';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al crear el libro';
            $this->notificationType = 'error';
        }
    }

    public function confirmarEliminacion($id)
    {
        $this->libroAEliminar = $id;
        $this->showDeleteModal = true;
        $this->eliminacionmode = 'unico';
    }

    public function eliminarLibro()
    {
        DB::transaction(function () {
            $libro = Book::find($this->libroAEliminar);

            // Eliminar ediciones e inventarios asociados
            foreach ($libro->editions as $edicion) {
                if ($edicion->inventory) {
                    $edicion->inventory->delete();
                }
                $edicion->delete();
            }

            // Eliminar relaciones
            $libro->authors()->detach();
            $libro->categories()->detach();
            $libro->favoriteUsers()->detach();

            // Eliminar comentarios
            DB::table('book_user_coment')->where('book_id', $libro->id)->delete();

            // Eliminar libro
            $libro->delete();
        });

        $this->showDeleteModal = false;
        $this->libroAEliminar = null;
        $this->showNotification = true;
        $this->notificationMessage = 'Libro eliminado correctamente';
    }

    public function eliminarshowmodal()
    {
        if (count($this->selectedLibros) >= 2) {
            $this->showDeleteModal = true;
            $this->eliminacionmode = 'multiple';
        }
    }

    public function eliminarLibrosSeleccionados()
    {
        DB::transaction(function () {
            foreach ($this->selectedLibros as $libroId) {
                $libro = Book::find($libroId);

                if ($libro) {
                    // Eliminar ediciones e inventarios
                    foreach ($libro->editions as $edicion) {
                        if ($edicion->inventory) {
                            $edicion->inventory->delete();
                        }
                        $edicion->delete();
                    }

                    // Eliminar relaciones
                    $libro->authors()->detach();
                    $libro->categories()->detach();
                    $libro->favoriteUsers()->detach();

                    // Eliminar comentarios
                    DB::table('book_user_coment')->where('book_id', $libro->id)->delete();

                    // Eliminar libro
                    $libro->delete();
                }
            }
        });

        $this->selectedLibros = [];
        $this->selectAll = false;
        $this->showDeleteModal = false;
        $this->eliminacionmode = 'unico';
        $this->showNotification = true;
        $this->notificationMessage = 'Libros eliminados correctamente';
    }

    public function cancelarEliminacion()
    {
        $this->showDeleteModal = false;
        $this->libroAEliminar = null;
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
            $this->selectedLibros = $this->getLibros()->pluck('id')->toArray();
        } else {
            $this->selectedLibros = [];
        }
    }

    public function updatedSelectedLibros()
    {
        $this->selectAll = count($this->selectedLibros) === $this->getLibros()->count();
    }

    public function getLibros()
    {
        return Book::with(['authors', 'categories', 'editions.editorial'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('titulo', 'like', '%' . $this->search . '%')
                      ->orWhere('ISBN', 'like', '%' . $this->search . '%')
                      ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                      ->orWhereHas('authors', function ($authorQuery) {
                          $authorQuery->where('nombre', 'like', '%' . $this->search . '%')
                                     ->orWhere('apellido', 'like', '%' . $this->search . '%');
                      })
                      ->orWhereHas('categories', function ($categoryQuery) {
                          $categoryQuery->where('nombre', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.libros-post', [
            'libros' => $this->getLibros()
        ]);
    }
}
