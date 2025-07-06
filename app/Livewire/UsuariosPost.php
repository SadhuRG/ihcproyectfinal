<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UsuariosPost extends Component
{
    use WithPagination;

    // Propiedades de búsqueda y ordenamiento
    public $search = '';
    public $sort = 'id';
    public $direction = 'asc';

    // Propiedades de edición (MODIFICADO para usar modal)
    public $showEditModal = false;
    public $usuarioEditado = [];

    // Propiedades de eliminación
    public $showDeleteModal = false;
    public $usuarioAEliminar = null;
    public $selectedUsuarios = [];
    public $selectAll = false;
    public $eliminacionmode = 'unico';

    // Propiedades de notificación (MODIFICADO para tipos)
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success'; // Puede ser 'success' o 'error'

    // Propiedades de creación
    public $showCreateModal = false;
    public $nuevoUsuario = [];

    // Roles disponibles
    public $rolesDisponibles = [];

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->rolesDisponibles = Role::all();
        $this->resetNuevoUsuario();
    }

    public function resetNuevoUsuario()
    {
        $this->nuevoUsuario = [
            'name' => '',
            'apellido' => '',
            'email' => '',
            'password' => '',
            'telefono' => '',
            'fecha_n' => '',
            'url_foto' => '',
            'rol' => 'usuario'
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

    /**
     * Prepara los datos del usuario y abre el modal de edición.
     */
    public function editarUsuario($id)
    {
        $usuario = User::with('roles')->find($id);

        if ($usuario) {
            $this->usuarioEditado = [
                'id' => $usuario->id,
                'name' => $usuario->name,
                'apellido' => $usuario->apellido,
                'email' => $usuario->email,
                'telefono' => $usuario->telefono,
                'fecha_n' => $usuario->fecha_n?->format('Y-m-d'),
                'url_foto' => $usuario->url_foto,
                'rol' => $usuario->roles->first()?->name ?? 'usuario'
            ];

            $this->showEditModal = true;
        }
    }

    /**
     * Limpia valores vacíos convirtiéndolos a null para campos específicos
     */
    private function limpiarDatos($datos)
    {
        // Convertir strings vacías a null para campos que lo requieren
        if (isset($datos['telefono']) && $datos['telefono'] === '') {
            $datos['telefono'] = null;
        }

        if (isset($datos['fecha_n']) && $datos['fecha_n'] === '') {
            $datos['fecha_n'] = null;
        }

        if (isset($datos['apellido']) && $datos['apellido'] === '') {
            $datos['apellido'] = null;
        }

        if (isset($datos['url_foto']) && $datos['url_foto'] === '') {
            $datos['url_foto'] = null;
        }

        return $datos;
    }

    /**
     * Guarda los cambios del usuario desde el modal de edición.
     * Solo permite cambiar el rol del usuario.
     */
    public function guardarUsuario()
    {
        // Solo validar el rol
        $this->validate([
            'usuarioEditado.rol' => 'required|exists:roles,name'
        ]);

        try {
            DB::beginTransaction();

            $usuario = User::find($this->usuarioEditado['id']);
            
            if (!$usuario) {
                throw new \Exception('Usuario no encontrado.');
            }

            // Solo actualizar el rol
            $usuario->syncRoles([$this->usuarioEditado['rol']]);

            DB::commit();

            $this->showEditModal = false;
            $this->mostrarNotificacion('Rol del usuario actualizado correctamente.', 'success');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al actualizar rol de usuario: ' . $e->getMessage());
            $this->mostrarNotificacion('Error al actualizar el rol del usuario: ' . $e->getMessage(), 'error');
        }
    }

    /**
     * Crea un nuevo usuario desde el modal de creación.
     */
    public function crearUsuario()
    {
        $this->validate([
            'nuevoUsuario.name' => 'required|string|max:255',
            'nuevoUsuario.apellido' => 'nullable|string|max:50',
            'nuevoUsuario.email' => 'required|email|unique:users,email',
            'nuevoUsuario.password' => 'required|string|min:8',
            'nuevoUsuario.telefono' => 'nullable|numeric|digits_between:9,15',
            'nuevoUsuario.fecha_n' => 'nullable|date',
            'nuevoUsuario.url_foto' => 'nullable|url|max:100',
            'nuevoUsuario.rol' => 'required|exists:roles,name'
        ]);

        try {
            DB::beginTransaction();

            // Verificar que el rol existe
            $rol = Role::where('name', $this->nuevoUsuario['rol'])->first();
            if (!$rol) {
                throw new \Exception('El rol especificado no existe.');
            }

            // Limpiar datos antes de crear
            $datosLimpios = $this->limpiarDatos([
                'name' => $this->nuevoUsuario['name'],
                'apellido' => $this->nuevoUsuario['apellido'],
                'email' => $this->nuevoUsuario['email'],
                'password' => Hash::make($this->nuevoUsuario['password']),
                'telefono' => $this->nuevoUsuario['telefono'],
                'fecha_n' => $this->nuevoUsuario['fecha_n'],
                'url_foto' => $this->nuevoUsuario['url_foto']
            ]);

            // Crear el usuario
            $usuario = User::create($datosLimpios);

            // Asignar rol
            $usuario->assignRole($this->nuevoUsuario['rol']);

            DB::commit();

            $this->showCreateModal = false;
            $this->resetNuevoUsuario();
            $this->mostrarNotificacion('Usuario creado correctamente.', 'success');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al crear usuario: ' . $e->getMessage());
            $this->mostrarNotificacion('Error al crear el usuario: ' . $e->getMessage(), 'error');
        }
    }

    /**
     * Método auxiliar para mostrar notificaciones
     */
    private function mostrarNotificacion($mensaje, $tipo = 'success')
    {
        $this->showNotification = true;
        $this->notificationMessage = $mensaje;
        $this->notificationType = $tipo;
    }

    public function confirmarEliminacion($id)
    {
        $this->usuarioAEliminar = $id;
        $this->showDeleteModal = true;
        $this->eliminacionmode = 'unico';
    }

    public function eliminarUsuario()
    {
        if ($this->usuarioAEliminar) {
            try {
                DB::beginTransaction();

                $usuario = User::find($this->usuarioAEliminar);
                if ($usuario) {
                    $usuario->delete();
                }

                DB::commit();

                $this->showDeleteModal = false;
                $this->usuarioAEliminar = null;
                $this->mostrarNotificacion('Usuario eliminado correctamente.', 'success');

            } catch (\Exception $e) {
                DB::rollBack();
                \Log::error('Error al eliminar usuario: ' . $e->getMessage());
                $this->mostrarNotificacion('Error al eliminar el usuario: ' . $e->getMessage(), 'error');
            }
        }
    }

    public function eliminarshowmodal()
    {
        if (count($this->selectedUsuarios) >= 2) {
            $this->showDeleteModal = true;
            $this->eliminacionmode = 'multiple';
        }
    }

    public function eliminarUsuariosSeleccionados()
    {
        if (count($this->selectedUsuarios) >= 2) {
            try {
                DB::beginTransaction();

                User::whereIn('id', $this->selectedUsuarios)->delete();

                DB::commit();

                $this->selectedUsuarios = [];
                $this->selectAll = false;
                $this->showDeleteModal = false;
                $this->eliminacionmode = 'unico';
                $this->mostrarNotificacion('Usuarios eliminados correctamente.', 'success');

            } catch (\Exception $e) {
                DB::rollBack();
                \Log::error('Error al eliminar usuarios: ' . $e->getMessage());
                $this->mostrarNotificacion('Error al eliminar los usuarios: ' . $e->getMessage(), 'error');
            }
        }
    }

    public function cancelarEliminacion()
    {
        $this->showDeleteModal = false;
        $this->usuarioAEliminar = null;
        $this->eliminacionmode = 'unico';
    }

    public function cerrarNotificacion()
    {
        $this->showNotification = false;
        $this->notificationMessage = '';
    }

    /**
     * Cierra el modal de edición y resetea las propiedades
     */
    public function cerrarModalEdicion()
    {
        $this->showEditModal = false;
        $this->usuarioEditado = [];
        $this->cambiarPassword = false;
        $this->nuevaPassword = '';
        $this->confirmarPassword = '';
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedUsuarios = $this->getUsuarios()->pluck('id')->map(fn($id) => (string) $id);
        } else {
            $this->selectedUsuarios = [];
        }
    }

    public function updatedSelectedUsuarios()
    {
        $totalUsuariosEnPagina = $this->getUsuarios()->count();
        $this->selectAll = count($this->selectedUsuarios) === $totalUsuariosEnPagina;
    }

    private function getUsuarios()
    {
        return User::with(['roles'])
            ->when($this->search, function ($query) {
                $searchNormalized = $this->normalizarBusqueda($this->search);
                $query->search($searchNormalized); // Usando el scope del modelo
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.usuarios-post', [
            'usuarios' => $this->getUsuarios()
        ]);
    }
}
