<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Promotion;
use App\Models\Category;
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
        'tipo' => '',
        'modalidad_promocion' => '',
        'cantidad' => '',
    ];

    public $promocionEditada = [
        'id' => '',
        'nombre' => '',
        'tipo' => '',
        'modalidad_promocion' => '',
        'cantidad' => '',
    ];

    // Propiedades para relaciones
    public $categoriaSeleccionada = [];
    public $edicionSeleccionada = [];

    // Propiedades para eliminación
    public $promocionIdAEliminar;
    public $eliminacionmode = 'unico';

    // Propiedades para notificaciones
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success';

    // Datos para formularios
    public $categorias = [];
    public $ediciones = [];

    public function mount()
    {
        $this->categorias = Category::all();
        $this->ediciones = Edition::with(['book', 'editorial'])->get();
    }

    public function render()
    {
        $promociones = Promotion::with(['categories', 'editions'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nombre', 'like', '%' . $this->search . '%')
                      ->orWhere('tipo', 'like', '%' . $this->search . '%')
                      ->orWhere('modalidad_promocion', 'like', '%' . $this->search . '%')
                      ->orWhereHas('categories', function ($categoryQuery) {
                          $categoryQuery->where('nombre', 'like', '%' . $this->search . '%');
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
        $this->resetPage();
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
                    $q->where('nombre', 'like', '%' . $this->search . '%')
                      ->orWhere('tipo', 'like', '%' . $this->search . '%')
                      ->orWhere('modalidad_promocion', 'like', '%' . $this->search . '%');
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
            'nuevaPromocion.tipo' => 'required|string|max:100',
            'nuevaPromocion.modalidad_promocion' => 'required|string|max:100',
            'nuevaPromocion.cantidad' => 'required|numeric|min:0',
        ], [
            'nuevaPromocion.nombre.required' => 'El nombre es obligatorio.',
            'nuevaPromocion.tipo.required' => 'El tipo es obligatorio.',
            'nuevaPromocion.modalidad_promocion.required' => 'La modalidad de promoción es obligatoria.',
            'nuevaPromocion.cantidad.required' => 'La cantidad es obligatoria.',
            'nuevaPromocion.cantidad.numeric' => 'La cantidad debe ser un número.',
            'nuevaPromocion.cantidad.min' => 'La cantidad debe ser mayor o igual a 0.',
        ]);

        try {
            $promocion = Promotion::create($this->nuevaPromocion);

            // Sincronizar relaciones
            if (!empty($this->categoriaSeleccionada)) {
                $promocion->categories()->sync($this->categoriaSeleccionada);
            }

            if (!empty($this->edicionSeleccionada)) {
                $promocion->editions()->sync($this->edicionSeleccionada);
            }

            $this->resetearFormulario();
            $this->showCreateModal = false;
            $this->mostrarNotificacion('Promoción creada exitosamente.', 'success');
        } catch (\Exception $e) {
            $this->mostrarNotificacion('Error al crear la promoción: ' . $e->getMessage(), 'error');
        }
    }

    public function editarPromocion($promocionId)
    {
        $promocion = Promotion::with(['categories', 'editions'])->findOrFail($promocionId);

        $this->promocionEditada = [
            'id' => $promocion->id,
            'nombre' => $promocion->nombre,
            'tipo' => $promocion->tipo,
            'modalidad_promocion' => $promocion->modalidad_promocion,
            'cantidad' => $promocion->cantidad,
        ];

        // Cargar relaciones existentes
        $this->categoriaSeleccionada = $promocion->categories->pluck('id')->toArray();
        $this->edicionSeleccionada = $promocion->editions->pluck('id')->toArray();

        $this->showEditModal = true;
    }

    public function guardarPromocion()
    {
        $this->validate([
            'promocionEditada.nombre' => 'required|string|max:255',
            'promocionEditada.tipo' => 'required|string|max:100',
            'promocionEditada.modalidad_promocion' => 'required|string|max:100',
            'promocionEditada.cantidad' => 'required|numeric|min:0',
        ], [
            'promocionEditada.nombre.required' => 'El nombre es obligatorio.',
            'promocionEditada.tipo.required' => 'El tipo es obligatorio.',
            'promocionEditada.modalidad_promocion.required' => 'La modalidad de promoción es obligatoria.',
            'promocionEditada.cantidad.required' => 'La cantidad es obligatoria.',
            'promocionEditada.cantidad.numeric' => 'La cantidad debe ser un número.',
            'promocionEditada.cantidad.min' => 'La cantidad debe ser mayor o igual a 0.',
        ]);

        try {
            $promocion = Promotion::findOrFail($this->promocionEditada['id']);
            $promocion->update([
                'nombre' => $this->promocionEditada['nombre'],
                'tipo' => $this->promocionEditada['tipo'],
                'modalidad_promocion' => $this->promocionEditada['modalidad_promocion'],
                'cantidad' => $this->promocionEditada['cantidad'],
            ]);

            // Sincronizar relaciones
            $promocion->categories()->sync($this->categoriaSeleccionada);
            $promocion->editions()->sync($this->edicionSeleccionada);

            $this->resetearFormulario();
            $this->showEditModal = false;
            $this->mostrarNotificacion('Promoción actualizada exitosamente.', 'success');
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
            $promocion = Promotion::findOrFail($this->promocionIdAEliminar);

            // Desvincular relaciones antes de eliminar
            $promocion->categories()->detach();
            $promocion->editions()->detach();

            $promocion->delete();

            $this->showDeleteModal = false;
            $this->mostrarNotificacion('Promoción eliminada exitosamente.', 'success');
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
            $promociones = Promotion::whereIn('id', $this->selectedPromociones)->get();

            foreach ($promociones as $promocion) {
                // Desvincular relaciones antes de eliminar
                $promocion->categories()->detach();
                $promocion->editions()->detach();
                $promocion->delete();
            }

            $this->selectedPromociones = [];
            $this->selectAll = false;
            $this->showDeleteModal = false;
            $this->mostrarNotificacion('Promociones eliminadas exitosamente.', 'success');
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

    private function resetearFormulario()
    {
        $this->nuevaPromocion = [
            'nombre' => '',
            'tipo' => '',
            'modalidad_promocion' => '',
            'cantidad' => '',
        ];

        $this->promocionEditada = [
            'id' => '',
            'nombre' => '',
            'tipo' => '',
            'modalidad_promocion' => '',
            'cantidad' => '',
        ];

        $this->categoriaSeleccionada = [];
        $this->edicionSeleccionada = [];
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
