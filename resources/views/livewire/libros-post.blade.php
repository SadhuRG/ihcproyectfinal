<div>
    <x-section-title title="GESTIÓN DE LIBROS" />

    <div class="mx-10">
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-lg">
            <div class="bg-primary-25 dark:bg-gray-700 p-4 rounded-lg">
                <div class="flex items-center gap-4 mb-4">
                    <!-- Búsqueda -->
                    <div class="relative mt-1 mb-5 flex-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model.live="search" type="text" id="table-search"
                            class="bg-white dark:bg-gray-600 border shadow-md border-gray-300 dark:border-gray-500 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-1.5 placeholder-gray-500 dark:placeholder-gray-400"
                            placeholder="Buscar por título, ISBN, autor, categoría...">
                    </div>

                    <!-- Botón Crear Libro -->
                    <button wire:click="$set('showCreateModal', true)"
                        class="px-4 py-3 mb-4 flex items-center justify-center bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="text-xs lg:text-sm">Nuevo Libro</span>
                    </button>
                </div>

                @if($libros->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-600">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center relative">
                                        <input id="checkbox-all-search" type="checkbox" wire:model.live="selectAll"
                                            class="w-5 h-5 border-2 border-gray-500 dark:border-gray-400 rounded-md bg-white dark:bg-gray-700 checked:bg-blue-600 checked:border-gray-700 dark:checked:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 shadow-md hover:shadow-lg hover:scale-110 cursor-pointer" />
                                    </div>
                                </th>

                                <th>
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

                                <th class="pl-6">
                                    <div class="flex items-center">
                                        Título
                                        <div class="flex flex-col ml-3">
                                            <button wire:click="order('titulo')" class="w-3 h-3 cursor-pointer {{ $sort === 'titulo' && $direction === 'asc' ? 'opacity-100' : 'opacity-40' }}">
                                                <svg viewBox="0 0 10 10" class="w-3 h-3 fill-current text-gray-700 dark:text-gray-300">
                                                    <path d="M5 0L10 5H0z"/>
                                                </svg>
                                            </button>
                                            <button wire:click="order('titulo')" class="w-3 h-3 cursor-pointer {{ $sort === 'titulo' && $direction === 'desc' ? 'opacity-100' : 'opacity-40' }}">
                                                <svg viewBox="0 0 10 10" class="w-3 h-3 fill-current rotate-180 text-gray-700 dark:text-gray-300">
                                                    <path d="M5 0L10 5H0z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3">ISBN</th>
                                <th scope="col" class="px-6 py-3">Autores</th>
                                <th scope="col" class="px-6 py-3">Categorías</th>
                                <th scope="col" class="px-6 py-3">Editorial</th>
                                <th scope="col" class="px-6 py-3">Descripción</th>
                                <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($libros as $libro)
                            <tr class="bg-white dark:bg-gray-700 border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4">
                                    <div class="flex items-center relative">
                                        <input id="checkbox-table-search-{{ $libro->id }}" type="checkbox"
                                            wire:model.live="selectedLibros" value="{{ $libro->id }}"
                                            class="w-5 h-5 border-2 border-gray-500 dark:border-gray-400 rounded-md bg-white dark:bg-gray-700 checked:bg-blue-600 checked:border-gray-700 dark:checked:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-200 shadow-sm hover:scale-105 cursor-pointer" />
                                    </div>
                                </td>

                                <th scope="row" class="px-6 py-4 font-medium text-gray-400 dark:text-gray-500 whitespace-nowrap">
                                    {{ $libro->id }}
                                </th>

                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $libro->titulo }}</span>
                                </td>

                                <td class="px-6 py-4 text-gray-900 dark:text-gray-300">
                                    {{ $libro->ISBN }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($libro->authors as $autor)
                                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 rounded-full text-xs">
                                            {{ $autor->nombre }} {{ $autor->apellido }}
                                        </span>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($libro->categories as $categoria)
                                        <span class="px-2 py-1 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 rounded-full text-xs">
                                            {{ $categoria->nombre }}
                                        </span>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-gray-900 dark:text-gray-300">
                                    {{ $libro->editions->first()->editorial->nombre ?? 'N/A' }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900 dark:text-gray-300">{{ Str::limit($libro->descripcion, 50) }}</span>
                                </td>

                                <td class="px-6 py-4 text-center w-32">
                                    <div class="flex items-center justify-center space-x-3">
                                        <button wire:click="verDetalleLibro({{ $libro->id }})"
                                            class="p-2 bg-indigo-500 hover:bg-indigo-600 dark:bg-indigo-600 dark:hover:bg-indigo-700 rounded-lg hover:scale-110 transition-transform w-10 h-10 flex items-center justify-center"
                                            title="Ver detalles">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                        <button wire:click="editarLibro({{ $libro->id }})"
                                            class="p-2 bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 rounded-lg hover:scale-110 transition-transform w-10 h-10 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button wire:click="confirmarEliminacion({{ $libro->id }})"
                                            class="p-2 bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 rounded-lg hover:scale-110 transition-transform w-10 h-10 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @else
                <div class="rounded-lg text-lg ml-4 text-red-800 dark:text-red-300 bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-700">
                    <h1 class="px-3 py-3">
                        No se encontraron libros que coincidan con la búsqueda
                    </h1>
                </div>
                @endif
            </div>

            <!-- CONTROLES DE PAGINACIÓN -->
            <div class="flex justify-between mt-3 gap-8 items-center">
                <!-- Botón Eliminar Múltiple -->
                <div class="flex items-center gap-4 ml-4 mt-3">
                    <button wire:click="eliminarshowmodal"
                        class="px-4 py-3 mb-4 flex items-center justify-center font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 border-2 {{ count($selectedLibros) >= 2 ? 'bg-white dark:bg-gray-700 hover:bg-red-400 dark:hover:bg-red-600 text-black dark:text-white border-black dark:border-gray-500 cursor-pointer' : 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 border-gray-300 dark:border-gray-600 cursor-not-allowed opacity-50' }}"
                        {{ count($selectedLibros) < 2 ? 'disabled' : '' }}>
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        <span class="text-xs lg:text-sm">Borrar Seleccionados ({{ count($selectedLibros) }})</span>
                    </button>
                </div>

                <!-- Paginación -->
                <div class="flex items-center space-x-4">
                    {{ $libros->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Crear Libro -->
    @if($showCreateModal)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Crear Nuevo Libro</h3>
                <button wire:click="$set('showCreateModal', false)" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="crearLibro" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Título *</label>
                        <input type="text" wire:model="nuevoLibro.titulo" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('nuevoLibro.titulo') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ISBN *</label>
                        <input type="text" wire:model="nuevoLibro.ISBN" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('nuevoLibro.ISBN') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                    <textarea wire:model="nuevoLibro.descripcion" rows="3"
                        class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    @error('nuevoLibro.descripcion') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Autores</label>
                        <select wire:model="autorSeleccionado" multiple size="4"
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @foreach($autores as $autor)
                            <option value="{{ $autor->id }}">{{ $autor->nombre }} {{ $autor->apellido }}</option>
                            @endforeach
                        </select>
                        <small class="text-gray-500 dark:text-gray-400">Mantén Ctrl/Cmd para seleccionar múltiples autores</small>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Categorías</label>
                        <select wire:model="categoriaSeleccionada" multiple size="4"
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        <small class="text-gray-500 dark:text-gray-400">Mantén Ctrl/Cmd para seleccionar múltiples categorías</small>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Editorial *</label>
                        <select wire:model="nuevoLibro.editorial_id" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar...</option>
                            @foreach($editoriales as $editorial)
                            <option value="{{ $editorial->id }}">{{ $editorial->nombre }}</option>
                            @endforeach
                        </select>
                        @error('nuevoLibro.editorial_id') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Edición *</label>
                        <select wire:model="nuevoLibro.numero_edicion" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar edición...</option>
                            @foreach($edicionesDisponibles as $edicion)
                                <option value="{{ $edicion }}">{{ $edicion }}</option>
                            @endforeach
                        </select>
                        @error('nuevoLibro.numero_edicion') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Precio (S/) *</label>
                        <input type="number" step="0.01" wire:model="nuevoLibro.precio" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('nuevoLibro.precio') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stock Inicial *</label>
                        <input type="number" wire:model="nuevoLibro.cantidad" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('nuevoLibro.cantidad') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Umbral de Stock *</label>
                        <input type="number" wire:model="nuevoLibro.umbral" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('nuevoLibro.umbral') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" wire:click="$set('showCreateModal', false)"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 dark:bg-green-600 text-white rounded hover:bg-green-600 dark:hover:bg-green-700 transition-colors">
                        Crear Libro
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Modal para Editar Libro -->
    @if($showEditModal)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Editar Libro</h3>
                <button wire:click="$set('showEditModal', false)" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="guardarLibro" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Título *</label>
                        <input type="text" wire:model="libroEditado.titulo" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('libroEditado.titulo') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ISBN *</label>
                        <input type="text" wire:model="libroEditado.ISBN" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('libroEditado.ISBN') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                    <textarea wire:model="libroEditado.descripcion" rows="3"
                        class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    @error('libroEditado.descripcion') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Autores</label>
                        <select wire:model="autorSeleccionado" multiple size="4"
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @foreach($autores as $autor)
                            <option value="{{ $autor->id }}">{{ $autor->nombre }} {{ $autor->apellido }}</option>
                            @endforeach
                        </select>
                        <small class="text-gray-500 dark:text-gray-400">Mantén Ctrl/Cmd para seleccionar múltiples autores</small>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Categorías</label>
                        <select wire:model="categoriaSeleccionada" multiple size="4"
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        <small class="text-gray-500 dark:text-gray-400">Mantén Ctrl/Cmd para seleccionar múltiples categorías</small>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" wire:click="$set('showEditModal', false)"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-700 transition-colors">
                        Actualizar Libro
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Modal para Confirmación de Eliminación -->
    @if($showDeleteModal)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Confirmar Eliminación</h3>
            @if($eliminacionmode === 'unico')
            <p class="mb-6 text-gray-700 dark:text-gray-300">¿Estás seguro de eliminar este libro? Esta acción también eliminará sus ediciones e inventarios asociados.</p>
            <div class="flex justify-end space-x-4">
                <button wire:click="cancelarEliminacion"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                    Cancelar
                </button>
                <button wire:click="eliminarLibro"
                    class="px-4 py-2 bg-red-500 dark:bg-red-600 text-white rounded hover:bg-red-600 dark:hover:bg-red-700 transition-colors">
                    Eliminar
                </button>
            </div>
            @else
            <p class="mb-6 text-gray-700 dark:text-gray-300">¿Estás seguro de eliminar estos {{ count($selectedLibros) }} libros? Esta acción también eliminará sus ediciones e inventarios asociados.</p>
            <div class="flex justify-end space-x-4">
                <button wire:click="cancelarEliminacion"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                    Cancelar
                </button>
                <button wire:click="eliminarLibrosSeleccionados"
                    class="px-4 py-2 bg-red-500 dark:bg-red-600 text-white rounded hover:bg-red-600 dark:hover:bg-red-700 transition-colors">
                    Eliminar
                </button>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Modal de Notificación Mejorado -->
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
            <h3 class="text-center text-lg font-semibold text-gray-900 dark:text-white mb-2">
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

    <!-- Modal para mostrar imagen ampliada -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-[60] hidden">
        <div class="relative max-w-4xl max-h-[90vh] mx-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-2xl overflow-hidden">
                <div class="flex justify-between items-center p-4 border-b dark:border-gray-700">
                    <h3 id="imageModalTitle" class="text-lg font-semibold text-gray-900 dark:text-white"></h3>
                    <button onclick="closeImageModal()" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4">
                    <img id="modalImage" src="" alt="Portada ampliada" class="w-full h-auto max-h-[70vh] object-contain rounded">
                </div>
            </div>
        </div>
    </div>

    <script>
        function openImageModal(imageSrc, title) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModalTitle').textContent = title;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Cerrar modal al hacer clic fuera de la imagen
        document.getElementById('imageModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Cerrar modal con la tecla Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>

    <!-- Modal de Atención para ISBN Duplicado -->
    @if($showIsbnDuplicateModal)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="flex items-center mb-4">
                <div class="bg-yellow-100 dark:bg-yellow-800/30 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Atención</h3>
            </div>
            
            <p class="mb-6 text-gray-700 dark:text-gray-300">
                El libro que estás intentando registrar ya existe en el sistema con el mismo ISBN. 
                Si deseas agregar una nueva edición de este libro, por favor dirígete a la sección Ediciones y selecciona el libro correspondiente.
            </p>
            
            @if($libroExistente)
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-6">
                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Libro existente:</h4>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    <strong>Título:</strong> {{ $libroExistente->titulo }}<br>
                    <strong>ISBN:</strong> {{ $libroExistente->ISBN }}
                </p>
            </div>
            @endif
            
            <div class="flex justify-end space-x-4">
                <button wire:click="cerrarModalIsbnDuplicado"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                    Aceptar
                </button>
                <button wire:click="irAEdiciones" onclick="showSection('ediciones')"
                    class="px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-700 transition-colors">
                    Ir a Ediciones
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de Advertencia para Título Similar -->
    @if($showTitleSimilarModal)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="flex items-center mb-4">
                <div class="bg-orange-100 dark:bg-orange-800/30 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Aviso</h3>
            </div>
            
            <p class="mb-6 text-gray-700 dark:text-gray-300">
                El título que estás intentando registrar es muy similar a un libro ya existente. 
                Si lo que necesitas es agregar una nueva edición, por favor ve a la sección Ediciones y selecciona el libro correspondiente. 
                Si estás seguro de que se trata de un libro diferente, puedes continuar con el registro.
            </p>
            
            @if($libroSimilar)
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-6">
                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Libro similar encontrado:</h4>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    <strong>Título:</strong> {{ $libroSimilar->titulo }}<br>
                    <strong>ISBN:</strong> {{ $libroSimilar->ISBN }}
                </p>
            </div>
            @endif
            
            <div class="flex justify-end space-x-4">
                <button wire:click="cerrarModalTituloSimilar"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                    Cancelar
                </button>
                <button wire:click="irAEdiciones" onclick="showSection('ediciones')"
                    class="px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-700 transition-colors">
                    Ir a Ediciones
                </button>
                <button wire:click="continuarCreacionLibro"
                    class="px-4 py-2 bg-green-500 dark:bg-green-600 text-white rounded hover:bg-green-600 dark:hover:bg-green-700 transition-colors">
                    Crear Libro
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal para Ver Detalles del Libro -->
    @if($showDetailModal)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center p-6 border-b dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detalles del Libro</h3>
                <button wire:click="$set('showDetailModal', false)" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            @if($libroDetalle)
            <div class="p-6">
                <!-- Información del libro -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Información General</h4>
                        <div class="space-y-2">
                            <div>
                                <span class="font-medium text-gray-700 dark:text-gray-300">Título:</span>
                                <span class="text-gray-900 dark:text-white ml-2">{{ $libroDetalle->titulo }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700 dark:text-gray-300">ISBN:</span>
                                <span class="text-gray-900 dark:text-white ml-2">{{ $libroDetalle->ISBN }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700 dark:text-gray-300">Autores:</span>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach($libroDetalle->authors as $autor)
                                    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 rounded-full text-xs">
                                        {{ $autor->nombre }} {{ $autor->apellido }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700 dark:text-gray-300">Categorías:</span>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach($libroDetalle->categories as $categoria)
                                    <span class="px-2 py-1 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 rounded-full text-xs">
                                        {{ $categoria->nombre }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Descripción</h4>
                        <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">{{ $libroDetalle->descripcion }}</p>
                    </div>
                </div>

                <!-- Tabla de ediciones -->
                <div>
                    <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Ediciones Disponibles</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-600">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Portada</th>
                                    <th scope="col" class="px-6 py-3">Edición</th>
                                    <th scope="col" class="px-6 py-3">Editorial</th>
                                    <th scope="col" class="px-6 py-3">Precio</th>
                                    <th scope="col" class="px-6 py-3">Stock</th>
                                    <th scope="col" class="px-6 py-3">Estado Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($libroDetalle->editions as $edicion)
                                <tr class="bg-white dark:bg-gray-700 border-b dark:border-gray-600">
                                    <td class="px-6 py-4">
                                        <div class="relative group cursor-pointer" onclick="openImageModal('{{ $edicion->url_portada }}', '{{ $edicion->book->titulo }} - {{ $edicion->numero_edicion }}')">
                                            <img src="{{ $edicion->url_portada }}" alt="Portada" class="h-20 w-16 object-cover rounded shadow-lg transition-transform duration-200 group-hover:scale-105">
                                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-800 opacity-0 group-hover:opacity-100 transition-opacity duration-200 drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-purple-100 dark:bg-purple-800 text-purple-800 dark:text-purple-200 rounded-full text-xs font-medium">
                                            {{ $edicion->numero_edicion }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-gray-300">
                                        {{ $edicion->editorial->nombre }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-semibold text-green-600 dark:text-green-400">
                                            S/ {{ number_format($edicion->precio, 2) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-gray-300">
                                        {{ $edicion->inventory->cantidad ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($edicion->inventory)
                                            @if($edicion->inventory->cantidad > $edicion->inventory->umbral)
                                                <span class="px-2 py-1 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 rounded-full text-xs">
                                                    Disponible
                                                </span>
                                            @elseif($edicion->inventory->cantidad > 0)
                                                <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200 rounded-full text-xs">
                                                    Stock Bajo
                                                </span>
                                            @else
                                                <span class="px-2 py-1 bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-200 rounded-full text-xs">
                                                    Agotado
                                                </span>
                                            @endif
                                        @else
                                            <span class="px-2 py-1 bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-full text-xs">
                                                Sin Stock
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <div class="flex justify-end p-6 border-t dark:border-gray-700">
                <button wire:click="$set('showDetailModal', false)"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal para mostrar imagen ampliada -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-[60] hidden">
        <div class="relative max-w-4xl max-h-[90vh] mx-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-2xl overflow-hidden">
                <div class="flex justify-between items-center p-4 border-b dark:border-gray-700">
                    <h3 id="imageModalTitle" class="text-lg font-semibold text-gray-900 dark:text-white"></h3>
                    <button onclick="closeImageModal()" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4">
                    <img id="modalImage" src="" alt="Portada ampliada" class="w-full h-auto max-h-[70vh] object-contain rounded">
                </div>
            </div>
        </div>
    </div>

    <script>
        function openImageModal(imageSrc, title) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModalTitle').textContent = title;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Cerrar modal al hacer clic fuera de la imagen
        document.getElementById('imageModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Cerrar modal con la tecla Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
</div>
