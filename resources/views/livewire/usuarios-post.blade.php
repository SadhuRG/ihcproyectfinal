<div>

    <h1 class="pt-5"></h1>

    <x-section-title title="USUARIOS" />

  <div class="mx-10">
    <div class="bg-white p-4 rounded-lg shadow-lg">
      <div class="bg-primary-25 p-4 rounded-lg">
        <div class="flex items-center gap-4">

          <div class="relative mt-1 mb-5 flex-1">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg class="w-3.5 h-3.5 text-gray-500 :text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                  clip-rule="evenodd"></path>
              </svg>
            </div>
            <input wire:model.live="search"
              type="text"
              id="table-search"
              class="bg-white border shadow-md border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-1.5 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500"
              placeholder="Buscar por nombre, apellido, email o rol...">
          </div>
        </div>

        @if(is_array($datos) && count($datos) > 0)
        <table class="w-full text-sm text-left text-gray-500 :text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
            <tr>
              <th scope="col" class="p-4">
                <div class="flex items-center relative">
                    <input
                    id="checkbox-all-search"
                    type="checkbox"
                    wire:model.live="selectAll"
                    class="peer appearance-none w-5 h-5 border-[2.5px] border-gray-500 rounded-md bg-white
                            checked:bg-blue-600 checked:border-gray-700
                            focus:outline-none focus:ring-2 focus:ring-blue-400
                            transition duration-200 shadow-md hover:shadow-lg hover:scale-110 cursor-pointer"
                    />

                    <span class="pointer-events-none absolute left-[1px] top-[1px] w-5 h-5 flex items-center justify-center hidden peer-checked:flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 13l4 4L19 7" />
                    </svg>
                    </span>

                    <label for="checkbox-all-search" class="sr-only">Seleccionar todos</label>
                </div>
              </th>

              <th>
                <div class="flex items-center">
                  ID
                  <div class="flex flex-col ml-3">
                    <img src="{{ asset('icons/triangle.svg') }}" wire:click="order('id')"
                      class="w-3 h-3 cursor-pointer {{ $sort === 'id' && $direction === 'asc' ? 'opacity-100' : 'opacity-40' }}"
                      alt="Ascendente">
                    <img src="{{ asset('icons/triangle-inverted.svg') }}" wire:click="order('id')"
                      class="w-3 h-3 cursor-pointer {{ $sort === 'id' && $direction === 'desc' ? 'opacity-100' : 'opacity-40' }}"
                      alt="Descendente">
                  </div>
                </div>
              </th>
              <th class="pl-6">
                <div class="flex items-center">
                  Nombre
                  <div class="flex flex-col ml-3">
                    <img src="{{ asset('icons/triangle.svg') }}" wire:click="order('nombre')"
                      class="w-3 h-3 cursor-pointer {{ $sort === 'nombre' && $direction === 'asc' ? 'opacity-100' : 'opacity-40' }}"
                      alt="Ascendente">
                    <img src="{{ asset('icons/triangle-inverted.svg') }}" wire:click="order('nombre')"
                      class="w-3 h-3 cursor-pointer {{ $sort === 'nombre' && $direction === 'desc' ? 'opacity-100' : 'opacity-40' }}"
                      alt="Descendente">
                  </div>
                </div>
              </th>
              <th class="pl-6">
                <div class="flex items-center">
                  Apellido
                  <div class="flex flex-col ml-3">
                    <img src="{{ asset('icons/triangle.svg') }}" wire:click="order('apellido')"
                      class="w-3 h-3 cursor-pointer {{ $sort === 'apellido' && $direction === 'asc' ? 'opacity-100' : 'opacity-40' }}"
                      alt="Ascendente">
                    <img src="{{ asset('icons/triangle-inverted.svg') }}" wire:click="order('apellido')"
                      class="w-3 h-3 cursor-pointer {{ $sort === 'apellido' && $direction === 'desc' ? 'opacity-100' : 'opacity-40' }}"
                      alt="Descendente">
                  </div>
                </div>
              </th>
              <th scope="col" class="px-6 py-3">Email</th>
              <th scope="col" class="px-6 py-3">Rol</th>
              <th scope="col" class="px-6 py-3">Fecha de Registro</th>
              <th scope="col" class="px-6 py-3">Fecha de Nacimiento</th>
              <th scope="col" class="px-6 py-3">Telefono</th>
              <th scope="col" class="px-6 py-3">Dirección</th>
              <th scope="col" class="px-6 py-3 text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($datos as $usuario)

              <td class="w-4 p-4">
                <div class="flex items-center relative">
                    <input
                    id="checkbox-table-search-{{ $usuario['id'] }}"
                    type="checkbox"
                    wire:model.live="selectedUsuarios"
                    value="{{ $usuario['id'] }}"
                    class="peer appearance-none w-5 h-5 border-2 border-gray-500 rounded-md bg-white
                            checked:bg-blue-600 checked:border-gray-700
                            focus:outline-none focus:ring-2 focus:ring-blue-300
                            transition duration-200 shadow-sm hover:scale-105 cursor-pointer"
                    />

                    <span class="pointer-events-none absolute left-[1px] top-[1px] w-5 h-5 flex items-center justify-center hidden peer-checked:flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 13l4 4L19 7" />
                    </svg>
                    </span>

                    <label for="checkbox-table-search-{{ $usuario['id'] }}" class="sr-only">Seleccionar registro</label>
                </div>
              </td>

              <th scope="row" class="px-6 py-4 font-medium text-gray-400 :text-white whitespace-nowrap">
                {{ $usuario['id'] }}
              </th>
              <td class="px-6 py-4">
                {{ $usuario['nombre'] }}
              </td>
              <td class="px-6 py-4">
                {{ $usuario['apellido'] }}
              </td>
              <td class="px-6 py-4">
                {{ $usuario['email'] }}
              </td>
              <td class="px-6 py-4">
                <span class="px-2 py-1 rounded-full text-sm {{ $usuario['rol'] === 'administrador' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                  {{ $usuario['rol'] }}
                </span>
              </td>
              <td class="px-6 py-4">
                {{ $usuario['fecha_registro'] }}
              </td>
              <td class="px-6 py-4">
                {{ $usuario['fecha_nacimiento'] }}
              </td>
              <td class="px-6 py-4">
                {{ $usuario['telefono'] }}
              </td>
              <td class="px-6 py-4">
                {{ $usuario['direccion'] }}
              </td>

              <td class="px-6 py-4 text-center w-32">
                <div class="flex items-center justify-center space-x-3">

                  @if($editando === $usuario['id'])
                    @if($mostrarModal)
                        <!-- Overlay con animación -->
                        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 animate-fade-in">
                            <!-- Modal Container -->
                            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 transform transition-all duration-300 animate-slide-up">

                                <!-- Header del Modal -->
                                <div class="relative bg-gradient-to-r from-blue-600 to-purple-600 rounded-t-2xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h2 class="text-xl font-bold text-white">Editar Usuario</h2>
                                                <p class="text-blue-100 text-sm">Actualiza la información del usuario</p>
                                            </div>
                                        </div>
                                        <button wire:click="cancelarEdicion"
                                                class="w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center text-white transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Contenido del Modal -->
                                <div class="p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                        <!-- Campo Nombre -->
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                <span>Nombre</span>
                                            </label>
                                            <input type="text"
                                                wire:model.defer="usuarioEditado.nombre"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white">
                                        </div>

                                        <!-- Campo Apellido -->
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                <span>Apellido</span>
                                            </label>
                                            <input type="text"
                                                wire:model.defer="usuarioEditado.apellido"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white">
                                        </div>

                                        <!-- Campo Email -->
                                        <div class="md:col-span-2 space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 3.26a2 2 0 001.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                                <span>Email</span>
                                            </label>
                                            <input type="email"
                                                wire:model.defer="usuarioEditado.email"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white">
                                        </div>

                                        <!-- Campo Rol -->
                                        <div class="md:col-span-2 space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                </svg>
                                                <span>Rol</span>
                                            </label>
                                            <select wire:model.defer="usuarioEditado.rol"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white">
                                                <option value="administrador" class="py-2">👑 Administrador</option>
                                                <option value="usuario" class="py-2">👤 Usuario</option>
                                            </select>
                                        </div>

                                        <!-- Campo Fecha de Registro -->
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <span>Fecha de Registro</span>
                                            </label>
                                            <input type="date"
                                                wire:model.defer="usuarioEditado.fecha_registro"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white">
                                        </div>

                                        <!-- Campo Fecha de Nacimiento -->
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                                </svg>
                                                <span>Fecha de Nacimiento</span>
                                            </label>
                                            <input type="date"
                                                wire:model.defer="usuarioEditado.fecha_nacimiento"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white">
                                        </div>

                                        <!-- Campo Teléfono -->
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.6a1 1 0 01.9.55l1.38 2.76a1 1 0 01-.26 1.26l-1.2.9a11.04 11.04 0 005.5 5.5l.9-1.2a1 1 0 011.26-.26l2.76 1.38a1 1 0 01.55.9V19a2 2 0 01-2 2h-.5C7.82 21 3 16.18 3 10.5V10a2 2 0 012-2z"/>
                                                </svg>
                                                <span>Teléfono</span>
                                            </label>
                                            <input type="tel"
                                                wire:model.defer="usuarioEditado.telefono"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white">
                                        </div>

                                        <!-- Campo Dirección -->
                                        <div class="md:col-span-2 space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12l4.243-4.243a6 6 0 10-8.485 8.485L12 13.414l4.243 4.243a1 1 0 001.414-1.414z"/>
                                                </svg>
                                                <span>Dirección</span>
                                            </label>
                                            <input type="text"
                                                wire:model.defer="usuarioEditado.direccion"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white">
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer del Modal -->
                                <div class="bg-gray-50 px-6 py-4 rounded-b-2xl border-t border-gray-200">
                                    <div class="flex justify-end space-x-3">
                                        <button wire:click="cancelarEdicion"
                                                class="px-6 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 focus:ring-2 focus:ring-gray-200 transition-all duration-200 font-medium flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            <span>Cancelar</span>
                                        </button>
                                        <button wire:click="guardarUsuario"
                                                class="px-6 py-2.5 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 focus:ring-2 focus:ring-green-200 transition-all duration-200 font-medium shadow-lg hover:shadow-xl flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Guardar Cambios</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Estilos CSS adicionales -->
                        <style>
                            @keyframes fade-in {
                                from { opacity: 0; }
                                to { opacity: 1; }
                            }

                            @keyframes slide-up {
                                from {
                                    opacity: 0;
                                    transform: translateY(20px) scale(0.95);
                                }
                                to {
                                    opacity: 1;
                                    transform: translateY(0) scale(1);
                                }
                            }

                            .animate-fade-in {
                                animation: fade-in 0.2s ease-out;
                            }

                            .animate-slide-up {
                                animation: slide-up 0.3s ease-out;
                            }
                        </style>
                    @endif
                @else
                  <button wire:click="editarUsuario({{ $usuario['id'] }})"
                    class="p-2 cursor-pointer bg-blue-500 rounded-lg hover:scale-110 transition-transform w-10 h-10 flex items-center justify-center">
                    <img src="{{asset('/imagenes/icons/editar.svg')}}" alt="Editar" class="w-5 h-5">
                  </button>
                  <button wire:click="confirmarEliminacion({{ $usuario['id'] }})"
                    class="p-2 cursor-pointer bg-red-500 rounded-lg hover:scale-110 transition-transform w-10 h-10 flex items-center justify-center">
                    <img src="{{asset('/imagenes/icons/borrar.svg')}}" alt="Eliminar" class="w-5 h-5">
                  </button>
                  @endif
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        @else
        <div class="rounded-lg text-lg ml-4 text-gray-700 bg-[#F8D7DA] :bg-gray-700 :text-gray-400">
          <h1 class="px-3 py-3 text-[#991C24]">
            No existe ningún usuario coincidente en la búsqueda
          </h1>
        </div>
        @endif

      </div>

        <div class="flex justify-between items-center mt-3 gap-8">
            <!-- Botón Borrar (sin cambios) -->
            <div class="flex items-center gap-8 ml-4">
                <button id="deleteMultiple"
                wire:click="eliminarshowmodal"
                @if(count($selectedUsuarios) < 2) disabled @endif
                class="cursor-pointer px-4 py-3 flex items-center justify-center bg-white hover:bg-red-400 text-accent-300 font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 border-accent-300 border-2 border-black disabled:opacity-50 disabled:cursor-not-allowed">
                <img src="{{asset('/imagenes/icons/supertrash.svg')}}" alt="Trash Icon" class="w-6 h-6 mr-2">
                <span class="text-center text-black text-xs lg:text-sm">Borrar</span>
                </button>
            </div>

            <!-- Contenedor de paginación -->
            <div class="flex items-center gap-8">
                <!-- Botón Anterior -->
                <button type="button"
                wire:click="previousPage"
                class="flex items-center justify-center cursor-pointer w-10 h-10 bg-white hover:bg-gray-200 border-2 border-black rounded-lg shadow-md text-black text-lg font-semibold transition-all duration-200 transform hover:scale-105 {{ $currentPage <= 1 ? 'opacity-50 disabled:cursor-not-allowed' : '' }}"
                {{ $currentPage <= 1 ? 'disabled' : '' }}>
                <span>&lt;&lt;</span>
                </button>

                <!-- Texto de página (centrado) -->
                <div class="flex items-center justify-center text-sm text-black font-semibold">
                Página {{ $currentPage }} de {{ $totalPages }}
                </div>

                <!-- Botón Siguiente -->
                <button type="button"
                wire:click="nextPage"
                class="flex items-center justify-center cursor-pointer w-10 h-10 bg-white hover:bg-gray-200 border-2 border-black rounded-lg shadow-md text-black text-lg font-semibold transition-all duration-200 transform hover:scale-105 {{ $currentPage >= $totalPages ? 'opacity-50 disabled:cursor-not-allowed' : '' }}"
                {{ $currentPage >= $totalPages ? 'disabled' : '' }}>
                <span>&gt;&gt;</span>
                </button>
            </div>
        </div>

    </div>
  </div>

  <!-- Modal para Confirmación de Eliminación -->
  @if($showDeleteModal)
  <div class="fixed inset-0 pl-60 bg-opacity-50 flex items-start justify-center z-50 pt-4">
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
      <h3 class="text-lg font-semibold mb-4">Confirmar Eliminación</h3>
      @if($eliminacionmode === 'unico')
      <p class="mb-6">¿Estás seguro de eliminar este usuario?</p>
      <div class="flex justify-end space-x-4">
        <button wire:click="cancelarEliminacion"
          class="px-4 py-2 cursor-pointer bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition-colors">
          Cancelar
        </button>
        <button wire:click="eliminarUsuario"
          class="px-4 py-2 cursor-pointer bg-red-400 text-white rounded hover:bg-red-600 transition-colors">
          Eliminar
        </button>
      </div>
      @else
      <p class="mb-6">¿Estás seguro de eliminar estos usuarios?</p>
      <div class="flex justify-end space-x-4">
        <button wire:click="canceleliminarshowmodal"
          class="px-4 py-2 cursor-pointer bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition-colors">
          Cancelar
        </button>
        <button wire:click="eliminarUsuariosSeleccionados"
          class="px-4 py-2 cursor-pointer bg-red-400 text-white rounded hover:bg-red-600 transition-colors">
          Eliminar
        </button>
      </div>
      @endif
    </div>
  </div>
  @endif

  <!-- Modal de mensaje eliminacion correcta-->
  @if($showNotification)
  <div
    x-data="{
                    visible: true,
                    timeout: null,
                    startTimer() {
                        this.timeout = setTimeout(() => {
                            this.visible = false;
                            $wire.cerrarNotificacion();
                        }, 1000); // 1 segundos
                    },
                    resetTimer() {
                        clearTimeout(this.timeout);
                        this.startTimer();
                    }
                }"
    x-init="startTimer()"
    x-show="visible"
    x-transition
    class="fixed inset-0 pl-60 bg-opacity-50 flex items-start justify-center z-50 pt-4"
    @click.self="$wire.cerrarNotificacion()">
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full mx-4" @mouseenter="resetTimer" @click.stop>
      <div class="flex items-center justify-center mb-4">
        <div class="bg-green-100 p-3 rounded-full">
          <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
      </div>
      <h3 class="text-lg font-semibold text-center text-gray-800 mb-2">¡Éxito!</h3>
      <p class="text-center text-gray-600">{{ $notificationMessage }}</p>
    </div>
  </div>
  @endif

  <!-- FIN -->

</div>
