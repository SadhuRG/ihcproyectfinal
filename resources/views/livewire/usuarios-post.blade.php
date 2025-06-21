{{--
    VISTA CORREGIDA
    ----------------
    - El botón "Eliminar Seleccionados" ha sido devuelto a su posición original
      en la parte inferior izquierda, junto a los controles de paginación.
--}}
<div>
    <h1 class="pt-5"></h1>
    <x-section-title title="GESTIÓN DE USUARIOS" />

    <div class="mx-10">
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <div class="bg-primary-25 p-4 rounded-lg">
                <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                    <div class="relative mt-1 flex-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search" type="text"
                            class="bg-white border shadow-md border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full max-w-sm pl-10 p-2"
                            placeholder="Buscar por nombre, email, rol...">
                    </div>

                    <div class="flex items-center gap-2">
                        <button wire:click="$set('showCreateModal', true)"
                            class="px-4 py-2 flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            <span>Nuevo Usuario</span>
                        </button>
                    </div>
                </div>

                @if($usuarios->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="p-4">
                                    <input type="checkbox" wire:model.live="selectAll" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                </th>
                                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('id')">ID @if($sort === 'id')<span>{{ $direction === 'asc' ? '▲' : '▼' }}</span>@endif</th>
                                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('name')">Nombre @if($sort === 'name')<span>{{ $direction === 'asc' ? '▲' : '▼' }}</span>@endif</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Rol</th>
                                <th scope="col" class="px-6 py-3">Fecha Registro</th>
                                <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            <tr class="bg-white border-b hover:bg-gray-50" wire:key="{{ $usuario->id }}">
                                <td class="w-4 p-4">
                                    <input type="checkbox" wire:model.live="selectedUsuarios" value="{{ $usuario->id }}" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-500">{{ $usuario->id }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $usuario->name }} {{ $usuario->apellido }}</td>
                                <td class="px-6 py-4">{{ $usuario->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 font-semibold leading-tight rounded-full text-xs
                                        {{ $usuario->rol === 'administrador' ? 'bg-blue-100 text-blue-800' :
                                           ($usuario->rol === 'colaborador' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800') }}">
                                        {{ ucfirst($usuario->rol) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $usuario->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button wire:click="editarUsuario({{ $usuario->id }})" class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-transform hover:scale-110">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </button>
                                        <button wire:click="confirmarEliminacion({{ $usuario->id }})" class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-transform hover:scale-110">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- CONTROLES INFERIORES: PAGINACIÓN Y ACCIONES MASIVAS --}}
                <div class="flex justify-between items-center mt-4">
                    {{-- Botón Eliminar Múltiple (POSICIÓN ORIGINAL RESTAURADA) --}}
                    <div>
                         <button wire:click="eliminarshowmodal"
                            class="px-4 py-2 flex items-center justify-center font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 border-2 {{ count($selectedUsuarios) >= 2 ? 'bg-red-500 hover:bg-red-600 text-white border-red-500 cursor-pointer' : 'bg-gray-300 text-gray-500 border-gray-300 cursor-not-allowed opacity-60' }}"
                            {{ count($selectedUsuarios) < 2 ? 'disabled' : '' }}>
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            <span>Eliminar ({{ count($selectedUsuarios) }})</span>
                        </button>
                    </div>

                    {{-- Paginación Laravel --}}
                    <div>
                        {{ $usuarios->links() }}
                    </div>
                </div>

                @else
                <div class="p-4 text-center text-gray-500 bg-gray-50 rounded-lg">
                    No se encontraron usuarios que coincidan con la búsqueda.
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ================================================================== --}}
    {{-- ======================= MODALES Y NOTIFICACIONES ======================= --}}
    {{-- ================================================================== --}}

    {{-- MODAL PARA CREAR USUARIO --}}
    @if($showCreateModal)
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto" @click.away="$set('showCreateModal', false)">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Crear Nuevo Usuario</h3>
                <button wire:click="$set('showCreateModal', false)" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <form wire:submit.prevent="crearUsuario" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre *</label>
                        <input type="text" wire:model.defer="nuevoUsuario.name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('nuevoUsuario.name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Apellido</label>
                        <input type="text" wire:model.defer="nuevoUsuario.apellido" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('nuevoUsuario.apellido') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email *</label>
                        <input type="email" wire:model.defer="nuevoUsuario.email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('nuevoUsuario.email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contraseña *</label>
                        <input type="password" wire:model.defer="nuevoUsuario.password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('nuevoUsuario.password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                     <div>
                        <label class="block text-sm font-medium text-gray-700">Rol *</label>
                        <select wire:model.defer="nuevoUsuario.rol" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($rolesDisponibles as $rol)
                            <option value="{{ $rol->name }}">{{ ucfirst($rol->name) }}</option>
                            @endforeach
                        </select>
                         @error('nuevoUsuario.rol') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" wire:click="$set('showCreateModal', false)" class="px-4 py-2 bg-gray-300 rounded-md">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md">Crear Usuario</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- MODAL PARA EDITAR USUARIO --}}
    @if($showEditModal)
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto" @click.away="$set('showEditModal', false)">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Editar Usuario</h3>
                <button wire:click="$set('showEditModal', false)" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <form wire:submit.prevent="guardarUsuario" class="space-y-4">
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre *</label>
                        <input type="text" wire:model.defer="usuarioEditado.name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('usuarioEditado.name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Apellido</label>
                        <input type="text" wire:model.defer="usuarioEditado.apellido" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('usuarioEditado.apellido') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                     <div>
                        <label class="block text-sm font-medium text-gray-700">Email *</label>
                        <input type="email" wire:model.defer="usuarioEditado.email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('usuarioEditado.email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                     <div>
                        <label class="block text-sm font-medium text-gray-700">Rol *</label>
                        <select wire:model.defer="usuarioEditado.rol" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($rolesDisponibles as $rol)
                            <option value="{{ $rol->name }}">{{ ucfirst($rol->name) }}</option>
                            @endforeach
                        </select>
                         @error('usuarioEditado.rol') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" wire:click="$set('showEditModal', false)" class="px-4 py-2 bg-gray-300 rounded-md">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Actualizar Usuario</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- MODAL DE CONFIRMACIÓN DE ELIMINACIÓN --}}
    @if($showDeleteModal)
     <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full" @click.away="$set('showDeleteModal', false)">
            <h3 class="text-lg font-semibold mb-4 text-center">Confirmar Eliminación</h3>
            @if($eliminacionmode === 'unico')
            <p class="mb-6 text-center">¿Seguro que quieres eliminar este usuario?<br>Esta acción no se puede deshacer.</p>
            @else
            <p class="mb-6 text-center">¿Seguro que quieres eliminar los <b>{{ count($selectedUsuarios) }}</b> usuarios seleccionados?<br>Esta acción no se puede deshacer.</p>
            @endif
            <div class="flex justify-center space-x-4">
                <button wire:click="cancelarEliminacion" class="px-4 py-2 bg-gray-300 rounded-md">Cancelar</button>
                <button wire:click="{{ $eliminacionmode === 'unico' ? 'eliminarUsuario' : 'eliminarUsuariosSeleccionados' }}" class="px-4 py-2 bg-red-500 text-white rounded-md">Eliminar</button>
            </div>
        </div>
    </div>
    @endif

    {{-- NOTIFICACIÓN AVANZADA --}}
    @if($showNotification)
    <div x-data="{ visible: true }" x-init="setTimeout(() => { visible = false; $wire.cerrarNotificacion() }, 3000)" x-show="visible"
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-2"
         class="fixed bottom-5 right-5 z-50">
        <div class="p-4 rounded-lg shadow-xl text-white
            {{ $notificationType === 'success' ? 'bg-green-500' : 'bg-red-500' }}">
            <div class="flex items-center">
                @if($notificationType === 'success')
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @else
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @endif
                <span>{{ $notificationMessage }}</span>
            </div>
        </div>
    </div>
    @endif
</div>
