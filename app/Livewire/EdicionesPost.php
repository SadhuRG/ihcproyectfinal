<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Edition;
use App\Models\Book;
use App\Models\Editorial;
use App\Models\Inventory;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class EdicionesPost extends Component
{
    use WithPagination, WithFileUploads;

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
    public $nuevaPortada = null;
    public $portadaPreview = null; // Para vista previa en tiempo real
    public $portadaCrear = null; // Para portada en crear edición
    public $portadaCrearPreview = null; // Para vista previa en crear edición

    // Para selects
    public $libros = [];
    public $editoriales = [];
    
    // Array estático de ediciones disponibles (formato exacto del seeder)
    public $edicionesDisponibles = [
        '1ra edición',
        '2da edición', 
        '3ra edición',
        '4ta edición',
        '5ta edición',
        '6ta edición',
        '7ma edición',
        '8va edición',
        '9na edición',
        '10ma edición',
        'edición especial'
    ];
    
    // Ediciones disponibles filtradas para el libro seleccionado
    public $edicionesDisponiblesFiltradas = [];

    protected $listeners = [
        'libroCreado' => 'actualizarLibros',
        'libroActualizado' => 'actualizarLibros',
        'libroEliminado' => 'actualizarLibros',
        'promocion-creada' => 'actualizarEdiciones',
        'promocion-actualizada' => 'actualizarEdiciones',
        'promocion-eliminada' => 'actualizarEdiciones',
        'promociones-eliminadas' => 'actualizarEdiciones'
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

    public function actualizarEdiciones()
    {
        // Forzar la actualización de las ediciones para mostrar los precios promocionales actualizados
        $this->dispatch('$refresh');
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
        $this->edicionesDisponiblesFiltradas = [];
        $this->portadaCrear = null;
        $this->portadaCrearPreview = null;
    }
    
    /**
     * Filtra las ediciones disponibles basándose en las ediciones existentes del libro seleccionado
     */
    public function updatedNuevaEdicionBookId($value)
    {
        if (!empty($value)) {
            // Obtener las ediciones existentes del libro seleccionado
            $edicionesExistentes = Edition::where('book_id', $value)
                ->pluck('numero_edicion')
                ->toArray();
            
            // Filtrar las ediciones disponibles excluyendo las que ya existen
            $this->edicionesDisponiblesFiltradas = array_values(array_filter(
                $this->edicionesDisponibles,
                function($edicion) use ($edicionesExistentes) {
                    return !in_array($edicion, $edicionesExistentes);
                }
            ));
            
            // Resetear el campo de edición cuando cambia el libro
            $this->nuevaEdicion['numero_edicion'] = '';
        } else {
            $this->edicionesDisponiblesFiltradas = [];
            $this->nuevaEdicion['numero_edicion'] = '';
        }
        
        // Forzar el renderizado
        $this->dispatch('edicionesFiltradas');
    }
    
    /**
     * Maneja el cambio de libro en el modal de edición
     */
    public function updatedEdicionEditadaBookId($value)
    {
        if (!empty($value)) {
            // Obtener las ediciones existentes del libro seleccionado
            $edicionesExistentes = Edition::where('book_id', $value)
                ->pluck('numero_edicion')
                ->toArray();
            
            // Filtrar las ediciones disponibles excluyendo las que ya existen
            $this->edicionesDisponiblesFiltradas = array_values(array_filter(
                $this->edicionesDisponibles,
                function($edicion) use ($edicionesExistentes) {
                    return !in_array($edicion, $edicionesExistentes);
                }
            ));
            
            // Resetear el campo de edición cuando cambia el libro
            $this->edicionEditada['numero_edicion'] = '';
        } else {
            $this->edicionesDisponiblesFiltradas = [];
            $this->edicionEditada['numero_edicion'] = '';
        }
        
        // Forzar el renderizado
        $this->dispatch('edicionesFiltradas');
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
            
            // Resetear la nueva portada y vista previa
            $this->nuevaPortada = null;
            $this->portadaPreview = null;
            
            // Filtrar ediciones disponibles para edición (excluyendo la actual)
            $this->filtrarEdicionesParaEdicion($edicion->book_id, $edicion->numero_edicion);
            
            $this->showEditModal = true;
        }
    }
    
    /**
     * Filtra las ediciones disponibles para edición (excluyendo la edición actual)
     */
    public function filtrarEdicionesParaEdicion($bookId, $edicionActual)
    {
        if (!empty($bookId)) {
            // Obtener las ediciones existentes del libro seleccionado
            $edicionesExistentes = Edition::where('book_id', $bookId)
                ->pluck('numero_edicion')
                ->toArray();
            
            // Filtrar las ediciones disponibles excluyendo las que ya existen
            // PERO incluyendo la edición actual que se está editando
            $this->edicionesDisponiblesFiltradas = array_values(array_filter(
                $this->edicionesDisponibles,
                function($edicion) use ($edicionesExistentes, $edicionActual) {
                    // Incluir la edición actual o las que no existen
                    return $edicion === $edicionActual || !in_array($edicion, $edicionesExistentes);
                }
            ));
        } else {
            $this->edicionesDisponiblesFiltradas = [];
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
            'edicionEditada.umbral' => 'required|integer|min:0',
            'nuevaPortada' => 'nullable|image|max:2048'
        ]);

        try {
            DB::transaction(function () {
                $edicion = Edition::with('inventory')->find($this->edicionEditada['id']);
                $book = Book::find($this->edicionEditada['book_id']);
                
                // Manejar la nueva portada si se subió una
                $urlPortada = $edicion->url_portada; // Mantener la portada actual por defecto
                
                if ($this->nuevaPortada) {
                    // Generar nombre único para la portada
                    $nombreArchivo = $book->titulo . '_' . $this->edicionEditada['numero_edicion'] . '.' . $this->nuevaPortada->getClientOriginalExtension();
                    $nombreArchivo = str_replace([' ', '/', '\\', ':', '*', '?', '"', '<', '>', '|'], '_', $nombreArchivo);
                    
                    // Guardar la portada usando store (como en el perfil)
                    $portadaPath = $this->nuevaPortada->storeAs('portadas', $nombreArchivo, 'public');
                    $urlPortada = '/storage/' . $portadaPath;
                }

                // Actualizar edición
                $edicion->update([
                    'book_id' => $this->edicionEditada['book_id'],
                    'editorial_id' => $this->edicionEditada['editorial_id'],
                    'numero_edicion' => $this->edicionEditada['numero_edicion'],
                    'precio' => $this->edicionEditada['precio'],
                    'url_portada' => $urlPortada
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
            $this->nuevaPortada = null; // Resetear la nueva portada
            $this->portadaPreview = null; // Resetear la vista previa

            $this->showNotification = true;
            $this->notificationMessage = 'Edición actualizada correctamente';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            \Log::error('Error al actualizar edición: ' . $e->getMessage());
            $this->showNotification = true;
            $this->notificationMessage = 'Error al actualizar la edición: ' . $e->getMessage();
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
            'nuevaEdicion.umbral' => 'required|integer|min:0',
            'portadaCrear' => 'nullable|image|max:2048'
        ]);

        try {
            DB::transaction(function () {
                $book = Book::find($this->nuevaEdicion['book_id']);
                
                // Procesar portada si se subió una
                $urlPortada = '/images/covers/default.jpg'; // Portada por defecto
                if ($this->portadaCrear) {
                    // Generar nombre único para la portada
                    $nombreArchivo = $book->titulo . '_' . $this->nuevaEdicion['numero_edicion'] . '.' . $this->portadaCrear->getClientOriginalExtension();
                    $nombreArchivo = str_replace([' ', '/', '\\', ':', '*', '?', '"', '<', '>', '|'], '_', $nombreArchivo);
                    
                    // Guardar la portada usando store (como en el perfil)
                    $portadaPath = $this->portadaCrear->storeAs('portadas', $nombreArchivo, 'public');
                    $urlPortada = '/storage/' . $portadaPath;
                }

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
                    'url_portada' => $urlPortada
                ]);
            });

            $this->showCreateModal = false;
            $this->resetNuevaEdicion();
            $this->showNotification = true;
            $this->notificationMessage = 'Edición creada correctamente';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al crear la edición: ' . $e->getMessage();
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

    public function updatedNuevaPortada()
    {
        $this->validate([
            'nuevaPortada' => 'nullable|image|max:2048' // 2MB máximo
        ]);
        
        // Actualizar la vista previa en tiempo real
        if ($this->nuevaPortada) {
            $this->portadaPreview = $this->nuevaPortada->temporaryUrl();
        } else {
            $this->portadaPreview = null;
        }
    }

    public function updatedPortadaCrear()
    {
        $this->validate([
            'portadaCrear' => 'nullable|image|max:2048' // 2MB máximo
        ]);
        
        // Actualizar la vista previa en tiempo real para crear edición
        if ($this->portadaCrear) {
            $this->portadaCrearPreview = $this->portadaCrear->temporaryUrl();
        } else {
            $this->portadaCrearPreview = null;
        }
    }

    public function getEdiciones()
    {
        return Edition::with(['book', 'editorial', 'inventory'])
            ->when($this->search, function ($query) {
                $searchNormalized = $this->normalizarBusqueda($this->search);
                $query->where(function ($q) use ($searchNormalized) {
                    $q->where('numero_edicion', 'like', '%' . $searchNormalized . '%')
                      ->orWhere('precio', 'like', '%' . $searchNormalized . '%')
                      ->orWhereHas('book', function ($bookQuery) use ($searchNormalized) {
                          $bookQuery->where('titulo', 'like', '%' . $searchNormalized . '%')
                                   ->orWhere('ISBN', 'like', '%' . $searchNormalized . '%');
                      })
                      ->orWhereHas('editorial', function ($editorialQuery) use ($searchNormalized) {
                          $editorialQuery->where('nombre', 'like', '%' . $searchNormalized . '%');
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