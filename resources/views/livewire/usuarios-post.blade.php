{{--
    VISTA CORREGIDA CON MODO OSCURO
    --------------------------------
    - Implementado modo oscuro siguiendo el patrón de libros-post y pedidos-post
    - Todas las clases dark: añadidas para consistencia visual
--}}
<div>
    <x-section-title title="GESTIÓN DE USUARIOS" />

    <div class="mx-10">
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-lg">
            <div class="bg-primary-25 dark:bg-gray-700 p-4 rounded-lg">
                <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                    <div class="relative mt-1 flex-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search" type="text"
                            class="bg-white dark:bg-gray-600 border shadow-md border-gray-300 dark:border-gray-500 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full max-w-sm pl-10 p-2 placeholder-gray-500 dark:placeholder-gray-400"
                            placeholder="Buscar por nombre, email, rol...">
                    </div>

                    <div class="flex items-center gap-2">
                        <button wire:click="$set('showCreateModal', true)"
                            class="px-4 py-2 flex items-center justify-center bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            <span>Nuevo Usuario</span>
                        </button>
                    </div>
                </div>

                @if($usuarios->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-600">
                            <tr>
                                <th scope="col" class="p-4">
                                    <input type="checkbox" wire:model.live="selectAll" class="w-5 h-5 border-2 border-gray-500 dark:border-gray-400 rounded-md bg-white dark:bg-gray-700 checked:bg-blue-600 checked:border-gray-700 dark:checked:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 shadow-md hover:shadow-lg hover:scale-110 cursor-pointer">
                                </th>
                                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('id')">
                                    <div class="flex items-center">
                                        ID
                                        <div class="flex flex-col ml-3">
                                            <button wire:click="order('id')" class="w-3 h-3 cursor-pointer {{ $sort === 'id' && $direction === 'asc' ? 'opacity-100' : 'opacity-40' }}">
                                                <svg viewBox="0 0 10 10" class="w-3 h-3 fill-current text-gray-700 dark:text-gray-300">
                                                    <path d="M5 0L10 5H0z"/>
                                                </svg>
                                            </button>
                                            <button wire:click="order('id')" class="w-3 h-3 cursor-pointer {{ $sort === 'id' && $direction === 'desc' ? 'opacity-100' : 'opacity-40' }}">
                                                <svg viewBox="0 0 10 10" class="w-3 h-3 fill-current rotate-180 text-gray-700 dark:text-gray-300">
                                                    <path d="M5 0L10 5H0z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('name')">
                                    <div class="flex items-center">
                                        Nombre
                                        <div class="flex flex-col ml-3">
                                            <button wire:click="order('name')" class="w-3 h-3 cursor-pointer {{ $sort === 'name' && $direction === 'asc' ? 'opacity-100' : 'opacity-40' }}">
                                                <svg viewBox="0 0 10 10" class="w-3 h-3 fill-current text-gray-700 dark:text-gray-300">
                                                    <path d="M5 0L10 5H0z"/>
                                                </svg>
                                            </button>
                                            <button wire:click="order('name')" class="w-3 h-3 cursor-pointer {{ $sort === 'name' && $direction === 'desc' ? 'opacity-100' : 'opacity-40' }}">
                                                <svg viewBox="0 0 10 10" class="w-3 h-3 fill-current rotate-180 text-gray-700 dark:text-gray-300">
                                                    <path d="M5 0L10 5H0z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Rol</th>
                                <th scope="col" class="px-6 py-3">Fecha Registro</th>
                                <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            <tr class="bg-white dark:bg-gray-700 border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600" wire:key="{{ $usuario->id }}">
                                <td class="w-4 p-4">
                                    <input type="checkbox" wire:model.live="selectedUsuarios" value="{{ $usuario->id }}" class="w-5 h-5 border-2 border-gray-500 dark:border-gray-400 rounded-md bg-white dark:bg-gray-700 checked:bg-blue-600 checked:border-gray-700 dark:checked:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-200 shadow-sm hover:scale-105 cursor-pointer">
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-400 dark:text-gray-500 whitespace-nowrap">{{ $usuario->id }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $usuario->name }} {{ $usuario->apellido }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-300">{{ $usuario->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 font-semibold leading-tight rounded-full text-xs
                                        {{ $usuario->rol === 'administrador' ? 'bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200' :
                                           ($usuario->rol === 'colaborador' ? 'bg-purple-100 dark:bg-purple-800 text-purple-800 dark:text-purple-200' : 'bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200') }}">
                                        {{ ucfirst($usuario->rol) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-300">{{ $usuario->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button wire:click="editarUsuario({{ $usuario->id }})" class="p-2 bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 text-white rounded-lg transition-transform hover:scale-110 w-10 h-10 flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </button>
                                        <button wire:click="confirmarEliminacion({{ $usuario->id }})" class="p-2 bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 text-white rounded-lg transition-transform hover:scale-110 w-10 h-10 flex items-center justify-center">
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
                    {{-- Botón Eliminar Múltiple --}}
                    <div>
                         <button wire:click="eliminarshowmodal"
                            class="px-4 py-2 flex items-center justify-center font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 border-2 {{ count($selectedUsuarios) >= 2 ? 'bg-white dark:bg-gray-700 hover:bg-red-400 dark:hover:bg-red-600 text-black dark:text-white border-black dark:border-gray-500 cursor-pointer' : 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 border-gray-300 dark:border-gray-600 cursor-not-allowed opacity-60' }}"
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
                <div class="p-8 text-center text-gray-500 dark:text-gray-400 bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-700 rounded-lg">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-lg font-medium text-red-800 dark:text-red-300">No se encontraron usuarios</p>
                    <p class="text-sm">No hay usuarios que coincidan con la búsqueda.</p>
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
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center border-b dark:border-gray-600 pb-3 mb-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Crear Nuevo Usuario</h3>
                <button wire:click="$set('showCreateModal', false)" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="crearUsuario" class="space-y-6">
                {{-- INFORMACIÓN BÁSICA --}}
                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Información Básica</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nombre <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                wire:model.defer="nuevoUsuario.name"
                                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Ingresa el nombre">
                            @error('nuevoUsuario.name')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Apellido</label>
                            <input type="text"
                                wire:model.defer="nuevoUsuario.apellido"
                                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Ingresa el apellido">
                            @error('nuevoUsuario.apellido')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- INFORMACIÓN DE CONTACTO --}}
                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Información de Contacto</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email"
                                wire:model.defer="nuevoUsuario.email"
                                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="ejemplo@correo.com">
                            @error('nuevoUsuario.email')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Teléfono</label>
                            <input type="tel"
                                wire:model.defer="nuevoUsuario.telefono"
                                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="987654321">
                            @error('nuevoUsuario.telefono')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- INFORMACIÓN PERSONAL --}}
                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Información Personal</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha de Nacimiento</label>
                            <input type="date"
                                wire:model.defer="nuevoUsuario.fecha_n"
                                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('nuevoUsuario.fecha_n')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">URL de Foto</label>
                            <input type="url"
                                wire:model.defer="nuevoUsuario.url_foto"
                                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="https://ejemplo.com/foto.jpg">
                            @error('nuevoUsuario.url_foto')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- SEGURIDAD Y ROL --}}
                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Seguridad y Permisos</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Contraseña <span class="text-red-500">*</span>
                            </label>
                            <input type="password"
                                wire:model.defer="nuevoUsuario.password"
                                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Mínimo 8 caracteres">
                            @error('nuevoUsuario.password')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Rol <span class="text-red-500">*</span>
                            </label>
                            <select wire:model.defer="nuevoUsuario.rol"
                                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @foreach($rolesDisponibles as $rol)
                                    <option value="{{ $rol->name }}">{{ ucfirst($rol->name) }}</option>
                                @endforeach
                            </select>
                            @error('nuevoUsuario.rol')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- BOTONES --}}
                <div class="flex justify-end space-x-4 pt-6 border-t dark:border-gray-600">
                    <button type="button"
                            wire:click="$set('showCreateModal', false)"
                            class="px-6 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-6 py-2 bg-green-500 dark:bg-green-600 text-white rounded-lg hover:bg-green-600 dark:hover:bg-green-700 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crear Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- MODAL PARA EDITAR USUARIO --}}
    @if($showEditModal)
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center border-b dark:border-gray-600 pb-3 mb-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Editar Usuario</h3>
                <button wire:click="cerrarModalEdicion" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="guardarUsuario" class="space-y-6">
                {{-- INFORMACIÓN BÁSICA --}}
                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Información Básica</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nombre <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                wire:model.defer="usuarioEditado.name"
                                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Ingresa el nombre">
                            @error('usuarioEditado.name')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Apellido</label>
                            <input type="text"
                                wire:model.defer="usuarioEditado.apellido"
                                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Ingresa el apellido">
                            @error('usuarioEditado.apellido')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- INFORMACIÓN DE CONTACTO --}}
                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Información de Contacto</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email"
                                wire:model.defer="usuarioEditado.email"
                                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="ejemplo@correo.com">
                            @error('usuarioEditado.email')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Teléfono</label>
                            <input type="tel"
                                wire:model.defer="usuarioEditado.telefono"
                                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="987654321">
                            @error('usuarioEditado.telefono')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- INFORMACIÓN PERSONAL --}}
                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Información Personal</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha de Nacimiento</label>
                            <input type="date"
                                wire:model.defer="usuarioEditado.fecha_n"
                                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('usuarioEditado.fecha_n')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">URL de Foto</label>
                            <input type="url"
                                wire:model.defer="usuarioEditado.url_foto"
                                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="https://ejemplo.com/foto.jpg">
                            @error('usuarioEditado.url_foto')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- SEGURIDAD Y ROL --}}
                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Permisos y Seguridad</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Rol <span class="text-red-500">*</span>
                            </label>
                            <select wire:model.defer="usuarioEditado.rol"
                                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @foreach($rolesDisponibles as $rol)
                                    <option value="{{ $rol->name }}">{{ ucfirst($rol->name) }}</option>
                                @endforeach
                            </select>
                            @error('usuarioEditado.rol')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Información adicional del usuario --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ID del Usuario</label>
                            <input type="text"
                                value="{{ $usuarioEditado['id'] ?? '' }}"
                                disabled
                                class="w-full border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-400 rounded-md shadow-sm cursor-not-allowed">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">El ID no se puede modificar</p>
                        </div>
                    </div>
                </div>

                {{-- CAMBIO DE CONTRASEÑA (OPCIONAL) --}}
                <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg border border-yellow-200 dark:border-yellow-800">
                    <div class="flex items-center mb-3">
                        <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <h4 class="text-lg font-medium text-yellow-800 dark:text-yellow-300">Cambio de Contraseña</h4>
                    </div>

                    <div class="flex items-center mb-3">
                        <input type="checkbox"
                            wire:model.live="cambiarPassword"
                            id="cambiarPassword"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="cambiarPassword" class="ml-2 text-sm font-medium text-yellow-800 dark:text-yellow-300">
                            Cambiar contraseña del usuario
                        </label>
                    </div>

                    @if($cambiarPassword ?? false)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-yellow-700 dark:text-yellow-300 mb-1">
                                Nueva Contraseña <span class="text-red-500">*</span>
                            </label>
                            <input type="password"
                                wire:model.defer="nuevaPassword"
                                class="w-full border-yellow-300 dark:border-yellow-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                                placeholder="Mínimo 8 caracteres">
                            @error('nuevaPassword')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-yellow-700 dark:text-yellow-300 mb-1">
                                Confirmar Contraseña <span class="text-red-500">*</span>
                            </label>
                            <input type="password"
                                wire:model.defer="confirmarPassword"
                                class="w-full border-yellow-300 dark:border-yellow-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                                placeholder="Repetir contraseña">
                            @error('confirmarPassword')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @else
                    <p class="text-sm text-yellow-700 dark:text-yellow-300">
                        Si no marcas esta opción, la contraseña del usuario no será modificada.
                    </p>
                    @endif
                </div>

                {{-- BOTONES --}}
                <div class="flex justify-end space-x-4 pt-6 border-t dark:border-gray-600">
                    <button type="button"
                            wire:click="cerrarModalEdicion"
                            class="px-6 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-6 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded-lg hover:bg-blue-600 dark:hover:bg-blue-700 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Actualizar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- MODAL DE CONFIRMACIÓN DE ELIMINACIÓN --}}
    @if($showDeleteModal)
     <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-md w-full">
            <h3 class="text-lg font-semibold mb-4 text-center text-gray-900 dark:text-white">Confirmar Eliminación</h3>
            @if($eliminacionmode === 'unico')
            <p class="mb-6 text-center text-gray-700 dark:text-gray-300">¿Seguro que quieres eliminar este usuario?<br>Esta acción no se puede deshacer.</p>
            @else
            <p class="mb-6 text-center text-gray-700 dark:text-gray-300">¿Seguro que quieres eliminar los <b>{{ count($selectedUsuarios) }}</b> usuarios seleccionados?<br>Esta acción no se puede deshacer.</p>
            @endif
            <div class="flex justify-center space-x-4">
                <button wire:click="cancelarEliminacion" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">Cancelar</button>
                <button wire:click="{{ $eliminacionmode === 'unico' ? 'eliminarUsuario' : 'eliminarUsuariosSeleccionados' }}" class="px-4 py-2 bg-red-500 dark:bg-red-600 text-white rounded hover:bg-red-600 dark:hover:bg-red-700 transition-colors">Eliminar</button>
            </div>
        </div>
    </div>
    @endif

    {{-- NOTIFICACIÓN AVANZADA --}}
    @if($showNotification)
    <div x-data="{
        visible: true,
        timeout: null,
        startTimer() {
            this.timeout = setTimeout(() => {
                this.visible = false;
                $wire.cerrarNotificacion();
            }, 4000);
        },
        resetTimer() {
            clearTimeout(this.timeout);
            this.startTimer();
        }
    }"
    x-init="startTimer()"
    x-show="visible"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-2"
    class="fixed top-4 right-4 z-50 max-w-md w-full mx-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl border-l-4 {{ $notificationType === 'success' ? 'border-green-500' : ($notificationType === 'error' ? 'border-red-500' : 'border-yellow-500') }}"
             @mouseenter="resetTimer" @click.stop>
            <div class="flex items-center justify-center mb-4">
                @if($notificationType === 'success')
                <div class="bg-green-100 dark:bg-green-800/30 p-3 rounded-full">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                @elseif($notificationType === 'error')
                <div class="bg-red-100 dark:bg-red-800/30 p-3 rounded-full">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                @else
                <div class="bg-yellow-100 dark:bg-yellow-800/30 p-3 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                @endif
            </div>
            <h3 class="text-lg font-semibold text-center text-gray-800 dark:text-gray-200 mb-2">
                @if($notificationType === 'success')
                    ¡Éxito!
                @elseif($notificationType === 'error')
                    Error
                @else
                    Atención
                @endif
            </h3>
            <p class="text-center text-gray-600 dark:text-gray-300">{{ $notificationMessage }}</p>

            <!-- Botón para cerrar manual -->
            <button wire:click="cerrarNotificacion" class="absolute top-2 right-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    @endif
</div>
