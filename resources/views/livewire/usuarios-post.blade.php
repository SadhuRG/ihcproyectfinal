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
                @if($editando === $usuario['id'])
                <input type="text"
                  wire:model="usuarioEditado.nombre"
                  class="w-full border-gray-300 rounded-md shadow-sm">
                @else
                {{ $usuario['nombre'] }}
                @endif
              </td>
              <td class="px-6 py-4">
                @if($editando === $usuario['id'])
                <input type="text"
                  wire:model="usuarioEditado.apellido"
                  class="w-full border-gray-300 rounded-md shadow-sm">
                @else
                {{ $usuario['apellido'] }}
                @endif
              </td>
              <td class="px-6 py-4">
                @if($editando === $usuario['id'])
                <input type="email"
                  wire:model="usuarioEditado.email"
                  class="w-full border-gray-300 rounded-md shadow-sm">
                @else
                {{ $usuario['email'] }}
                @endif
              </td>
              <td class="px-6 py-4">
                @if($editando === $usuario['id'])
                <select wire:model="usuarioEditado.rol"
                  class="w-full border-gray-300 rounded-md shadow-sm">
                  <option value="administrador">Administrador</option>
                  <option value="usuario">Usuario</option>
                </select>
                @else
                <span class="px-2 py-1 rounded-full text-sm {{ $usuario['rol'] === 'administrador' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                  {{ $usuario['rol'] }}
                </span>
                @endif
              </td>
              <td class="px-6 py-4">
                @if($editando === $usuario['id'])
                <input type="date"
                  wire:model="usuarioEditado.fecha_registro"
                  class="w-full border-gray-300 rounded-md shadow-sm">
                @else
                {{ $usuario['fecha_registro'] }}
                @endif
              </td>
              <td class="px-6 py-4">
                @if($editando === $usuario['id'])
                <input type="date"
                  wire:model="usuarioEditado.fecha_nacimiento"
                  class="w-full border-gray-300 rounded-md shadow-sm">
                @else
                {{ $usuario['fecha_nacimiento'] }}
                @endif
              </td>
              <td class="px-6 py-4">
                @if($editando === $usuario['id'])
                <input type="text"
                  wire:model="usuarioEditado.telefono"
                  maxlength="9"
                  class="w-full border-gray-300 rounded-md shadow-sm">
                @else
                {{ $usuario['telefono'] }}
                @endif
              </td>
              <td class="px-6 py-4">
                @if($editando === $usuario['id'])
                <input type="text"
                  wire:model="usuarioEditado.direccion"
                  class="w-full border-gray-300 rounded-md shadow-sm">
                @else
                {{ $usuario['direccion'] }}
                @endif
              </td>

              <td class="px-6 py-4 text-center w-32">
                <div class="flex items-center justify-center space-x-3">
                  @if($editando === $usuario['id'])
                  <button wire:click="guardarUsuario"
                    class="p-2 cursor-pointer bg-green-500 rounded-lg hover:scale-110 transition-transform w-10 h-10 flex items-center justify-center">
                    <img src="{{asset('/imagenes/icons/save.svg')}}" alt="Guardar" class="w-5 h-5">
                  </button>
                  <button disabled
                    class="p-2 cursor-pointer bg-red-500 opacity-50 disabled:cursor-not-allowed rounded-lg w-10 h-10 flex items-center justify-center">
                    <img src="{{asset('/imagenes/icons/borrar.svg')}}" alt="Eliminar" class="w-5 h-5">
                  </button>
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

      <!-- BOTONES DE PAGINACION -->
      <div class="flex justify-between mt-3 gap-8">
        <!-- TEXTO AGREGADO-->

          <div class="flex items-center gap-4 ml-4 mt-3">
            <button id="deleteMultiple"
              wire:click="eliminarshowmodal"
              @if(count($selectedUsuarios) < 2) disabled @endif
              class="cursor-pointer px-4 py-3 mb-4 flex items-center justify-center bg-white hover:bg-red-400 text-accent-300 font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 border-accent-300 border-2 border-black">
              <img src="{{asset('/imagenes/icons/supertrash.svg')}}" alt="Trash Icon" class="w-6 h-6 mr-2">
              <span class="text-center text-black text-xs lg:text-sm">Borrar</span>
            </button>
          </div>

        <!-- Botón Anterior -->
        <button type="button"
          wire:click="previousPage"
          class="flex items-center cursor-pointer px-6 border border-black text-black hover:bg-gray-100 {{ $currentPage <= 1 ? 'opacity-50 disabled:cursor-not-allowed' : '' }}"
          {{ $currentPage <= 1 ? 'disabled' : '' }}>
          <span class="mr-2">&lt;&lt;</span>
          Anterior
        </button>

        <div class="text-sm text-black mt-6">
          Página {{ $currentPage }} de {{ $totalPages }}
        </div>

        <!-- Botón Siguiente -->
        <button type="button"
          wire:click="nextPage"
          class="flex items-center cursor-pointer px-6 py-2 border border-black text-black hover:bg-gray-100 {{ $currentPage >= $totalPages ? 'opacity-50 disabled:cursor-not-allowed' : '' }}"
          {{ $currentPage >= $totalPages ? 'disabled' : '' }}>
          <span class="ml-2">&gt;&gt;</span>
          Siguiente
        </button>
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
