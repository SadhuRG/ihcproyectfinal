<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
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
            'rol' => 'usuario'
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
                'rol' => $usuario->roles->first()?->name ?? 'usuario'
            ];
            $this->showEditModal = true;
        }
    }

    /**
     * Guarda los cambios del usuario desde el modal de edición.
     */
    public function guardarUsuario()
    {
        $this->validate([
            'usuarioEditado.name' => 'required|string|max:255',
            'usuarioEditado.apellido' => 'nullable|string|max:50',
            'usuarioEditado.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->usuarioEditado['id'])
            ],
            'usuarioEditado.telefono' => 'nullable|numeric|digits_between:9,15',
            'usuarioEditado.fecha_n' => 'nullable|date',
            'usuarioEditado.rol' => 'required|exists:roles,name'
        ]);

        try {
            $usuario = User::find($this->usuarioEditado['id']);

            $usuario->update([
                'name' => $this->usuarioEditado['name'],
                'apellido' => $this->usuarioEditado['apellido'],
                'email' => $this->usuarioEditado['email'],
                'telefono' => $this->usuarioEditado['telefono'],
                'fecha_n' => $this->usuarioEditado['fecha_n']
            ]);

            $usuario->syncRoles([$this->usuarioEditado['rol']]);

            $this->showEditModal = false;
            $this->showNotification = true;
            $this->notificationMessage = 'Usuario actualizado correctamente.';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al actualizar el usuario.';
            $this->notificationType = 'error';
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
            'nuevoUsuario.rol' => 'required|exists:roles,name'
        ]);

        try {
            $usuario = User::create([
                'name' => $this->nuevoUsuario['name'],
                'apellido' => $this->nuevoUsuario['apellido'],
                'email' => $this->nuevoUsuario['email'],
                'password' => Hash::make($this->nuevoUsuario['password']),
                'telefono' => $this->nuevoUsuario['telefono'],
                'fecha_n' => $this->nuevoUsuario['fecha_n']
            ]);

            $usuario->assignRole($this->nuevoUsuario['rol']);

            $this->showCreateModal = false;
            $this->resetNuevoUsuario();
            $this->showNotification = true;
            $this->notificationMessage = 'Usuario creado correctamente.';
            $this->notificationType = 'success';

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al crear el usuario.';
            $this->notificationType = 'error';
        }
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
                User::find($this->usuarioAEliminar)->delete();

                $this->showDeleteModal = false;
                $this->usuarioAEliminar = null;
                $this->showNotification = true;
                $this->notificationMessage = 'Usuario eliminado correctamente.';
                $this->notificationType = 'success';

            } catch (\Exception $e) {
                $this->showNotification = true;
                $this->notificationMessage = 'Error al eliminar el usuario.';
                $this->notificationType = 'error';
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
                User::whereIn('id', $this->selectedUsuarios)->delete();

                $this->selectedUsuarios = [];
                $this->selectAll = false;
                $this->showDeleteModal = false;
                $this->eliminacionmode = 'unico';
                $this->showNotification = true;
                $this->notificationMessage = 'Usuarios eliminados correctamente.';
                $this->notificationType = 'success';

            } catch (\Exception $e) {
                $this->showNotification = true;
                $this->notificationMessage = 'Error al eliminar los usuarios.';
                $this->notificationType = 'error';
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
                $query->search($this->search); // Usando el scope del modelo
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
