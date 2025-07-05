<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Promotion;
use App\Models\Book;
use App\Models\Edition;

class PromocionesPost extends Component
{
    use WithPagination;

    // Propiedades de búsqueda y filtros
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';

    // Propiedades para selección múltiple
    public $selectAll = false;
    public $selectedPromociones = [];

    // Propiedades para modales
    public $showCreateModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;

    // Propiedades para promociones
    public $nuevaPromocion = [
        'nombre' => '',
        'cantidad' => '',
    ];

    public $promocionEditada = [
        'id' => '',
        'nombre' => '',
        'cantidad' => '',
    ];

    // Propiedades para relaciones
    public $libroSeleccionado = '';

    // Propiedades para eliminación
    public $promocionIdAEliminar;
    public $eliminacionmode = 'unico';

    // Propiedades para notificaciones
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success';

    // Datos para formularios
    public $libros = [];

    public function mount()
    {
        $this->libros = Book::all();
    }

    public function render()
    {
        $promociones = Promotion::with(['books'])
            ->when($this->search, function ($query) {
                $searchNormalized = $this->normalizarBusqueda($this->search);
                $query->where(function ($q) use ($searchNormalized) {
                    $q->where('nombre', 'like', '%' . $searchNormalized . '%')
                      ->orWhereHas('books', function ($bookQuery) use ($searchNormalized) {
                          $bookQuery->where('titulo', 'like', '%' . $searchNormalized . '%');
                      });
                });
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.promociones-post', [
            'promociones' => $promociones
        ]);
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
        if ($this->sort == $sort) {
            $this->direction = $this->direction == 'desc' ? 'asc' : 'desc';
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
        $this->resetPage();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedPromociones = Promotion::when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nombre', 'like', '%' . $this->search . '%');
                });
            })->pluck('id')->toArray();
        } else {
            $this->selectedPromociones = [];
        }
    }

    public function crearPromocion()
    {
        $this->validate([
            'nuevaPromocion.nombre' => 'required|string|max:255',
            'nuevaPromocion.cantidad' => 'required|numeric|min:0|max:100',
            'libroSeleccionado' => 'required|exists:books,id',
        ], [
            'nuevaPromocion.nombre.required' => 'El nombre es obligatorio.',
            'nuevaPromocion.cantidad.required' => 'El porcentaje de descuento es obligatorio.',
            'nuevaPromocion.cantidad.numeric' => 'El porcentaje debe ser un número.',
            'nuevaPromocion.cantidad.min' => 'El porcentaje debe ser mayor o igual a 0.',
            'nuevaPromocion.cantidad.max' => 'El porcentaje no puede ser mayor a 100.',
            'libroSeleccionado.required' => 'Debe seleccionar un libro.',
            'libroSeleccionado.exists' => 'El libro seleccionado no existe.',
        ]);

        try {
            $promocion = Promotion::create($this->nuevaPromocion);

            // Asociar el libro a la promoción
            $promocion->books()->attach($this->libroSeleccionado);

            // Aplicar el descuento a todas las ediciones del libro
            $this->aplicarDescuentoALibro($this->libroSeleccionado, $this->nuevaPromocion['cantidad']);

            $this->resetearFormulario();
            $this->showCreateModal = false;
            $this->mostrarNotificacion('Promoción creada exitosamente.', 'success');
            
            // Disparar evento para actualizar automáticamente las ediciones
            $this->dispatch('promocion-creada');
        } catch (\Exception $e) {
            $this->mostrarNotificacion('Error al crear la promoción: ' . $e->getMessage(), 'error');
        }
    }

    public function editarPromocion($promocionId)
    {
        $promocion = Promotion::with(['books'])->findOrFail($promocionId);

        $this->promocionEditada = [
            'id' => $promocion->id,
            'nombre' => $promocion->nombre,
            'cantidad' => $promocion->cantidad,
        ];

        // Cargar libro asociado
        $this->libroSeleccionado = $promocion->books->first()->id ?? '';

        $this->showEditModal = true;
    }

    public function guardarPromocion()
    {
        $this->validate([
            'promocionEditada.nombre' => 'required|string|max:255',
            'promocionEditada.cantidad' => 'required|numeric|min:0|max:100',
            'libroSeleccionado' => 'required|exists:books,id',
        ], [
            'promocionEditada.nombre.required' => 'El nombre es obligatorio.',
            'promocionEditada.cantidad.required' => 'El porcentaje de descuento es obligatorio.',
            'promocionEditada.cantidad.numeric' => 'El porcentaje debe ser un número.',
            'promocionEditada.cantidad.min' => 'El porcentaje debe ser mayor o igual a 0.',
            'promocionEditada.cantidad.max' => 'El porcentaje no puede ser mayor a 100.',
            'libroSeleccionado.required' => 'Debe seleccionar un libro.',
            'libroSeleccionado.exists' => 'El libro seleccionado no existe.',
        ]);

        try {
            $promocion = Promotion::findOrFail($this->promocionEditada['id']);
            
            // Obtener el libro anterior para revertir descuentos
            $libroAnterior = $promocion->books->first();
            if ($libroAnterior) {
                $this->revertirDescuentoALibro($libroAnterior->id);
            }

            $promocion->update([
                'nombre' => $this->promocionEditada['nombre'],
                'cantidad' => $this->promocionEditada['cantidad'],
            ]);

            // Sincronizar relación con libro
            $promocion->books()->sync([$this->libroSeleccionado]);

            // Aplicar el nuevo descuento
            $this->aplicarDescuentoALibro($this->libroSeleccionado, $this->promocionEditada['cantidad']);

            $this->resetearFormulario();
            $this->showEditModal = false;
            $this->mostrarNotificacion('Promoción actualizada exitosamente.', 'success');
            
            // Disparar evento para actualizar automáticamente las ediciones
            $this->dispatch('promocion-actualizada');
        } catch (\Exception $e) {
            $this->mostrarNotificacion('Error al actualizar la promoción: ' . $e->getMessage(), 'error');
        }
    }

    public function confirmarEliminacion($promocionId)
    {
        $this->promocionIdAEliminar = $promocionId;
        $this->eliminacionmode = 'unico';
        $this->showDeleteModal = true;
    }

    public function eliminarPromocion()
    {
        try {
            $promocion = Promotion::with(['books'])->findOrFail($this->promocionIdAEliminar);

            // Revertir descuentos antes de eliminar
            foreach ($promocion->books as $libro) {
                $this->revertirDescuentoALibro($libro->id);
            }

            // Desvincular relaciones antes de eliminar
            $promocion->books()->detach();
            $promocion->delete();

            $this->showDeleteModal = false;
            $this->mostrarNotificacion('Promoción eliminada exitosamente.', 'success');
            
            // Disparar evento para actualizar automáticamente las ediciones
            $this->dispatch('promocion-eliminada');
        } catch (\Exception $e) {
            $this->mostrarNotificacion('Error al eliminar la promoción: ' . $e->getMessage(), 'error');
        }
    }

    public function eliminarshowmodal()
    {
        $this->eliminacionmode = 'multiple';
        $this->showDeleteModal = true;
    }

    public function eliminarPromocionesSeleccionadas()
    {
        try {
            $promociones = Promotion::with(['books'])->whereIn('id', $this->selectedPromociones)->get();

            foreach ($promociones as $promocion) {
                // Revertir descuentos antes de eliminar
                foreach ($promocion->books as $libro) {
                    $this->revertirDescuentoALibro($libro->id);
                }

                // Desvincular relaciones antes de eliminar
                $promocion->books()->detach();
                $promocion->delete();
            }

            $this->selectedPromociones = [];
            $this->selectAll = false;
            $this->showDeleteModal = false;
            $this->mostrarNotificacion('Promociones eliminadas exitosamente.', 'success');
            
            // Disparar evento para actualizar automáticamente las ediciones
            $this->dispatch('promociones-eliminadas');
        } catch (\Exception $e) {
            $this->mostrarNotificacion('Error al eliminar las promociones: ' . $e->getMessage(), 'error');
        }
    }

    public function cancelarEliminacion()
    {
        $this->showDeleteModal = false;
        $this->promocionIdAEliminar = null;
        $this->eliminacionmode = 'unico';
    }

    private function aplicarDescuentoALibro($libroId, $porcentajeDescuento)
    {
        $libro = Book::with('editions')->findOrFail($libroId);
        
        foreach ($libro->editions as $edicion) {
            $descuento = $edicion->precio * ($porcentajeDescuento / 100);
            $precio_promocional = $edicion->precio - $descuento;
            
            $edicion->update([
                'precio_promocional' => round($precio_promocional, 2)
            ]);
        }
    }

    private function revertirDescuentoALibro($libroId)
    {
        $libro = Book::with('editions')->findOrFail($libroId);
        
        foreach ($libro->editions as $edicion) {
            $edicion->update([
                'precio_promocional' => null
            ]);
        }
    }

    private function resetearFormulario()
    {
        $this->nuevaPromocion = [
            'nombre' => '',
            'cantidad' => '',
        ];

        $this->promocionEditada = [
            'id' => '',
            'nombre' => '',
            'cantidad' => '',
        ];

        $this->libroSeleccionado = '';
    }

    private function mostrarNotificacion($mensaje, $tipo = 'success')
    {
        $this->notificationMessage = $mensaje;
        $this->notificationType = $tipo;
        $this->showNotification = true;
    }

    public function cerrarNotificacion()
    {
        $this->showNotification = false;
        $this->notificationMessage = '';
        $this->notificationType = 'success';
    }
}
