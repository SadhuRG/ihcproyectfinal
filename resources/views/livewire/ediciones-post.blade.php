<div>
    <x-section-title title="GESTIÓN DE EDICIONES" />

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
                            placeholder="Buscar por edición, precio, libro, editorial...">
                    </div>

                    <!-- Botón Crear Edición -->
                    <button wire:click="$set('showCreateModal', true)"
                        class="px-4 py-3 mb-4 flex items-center justify-center bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="text-xs lg:text-sm">Nueva Edición</span>
                    </button>
                </div>

                @if($ediciones->count() > 0)
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
                                        Libro
                                        <div class="flex flex-col ml-3">
                                            <button wire:click="order('book_id')" class="w-3 h-3 cursor-pointer {{ $sort === 'book_id' && $direction === 'asc' ? 'opacity-100' : 'opacity-40' }}">
                                                <svg viewBox="0 0 10 10" class="w-3 h-3 fill-current text-gray-700 dark:text-gray-300">
                                                    <path d="M5 0L10 5H0z"/>
                                                </svg>
                                            </button>
                                            <button wire:click="order('book_id')" class="w-3 h-3 cursor-pointer {{ $sort === 'book_id' && $direction === 'desc' ? 'opacity-100' : 'opacity-40' }}">
                                                <svg viewBox="0 0 10 10" class="w-3 h-3 fill-current rotate-180 text-gray-700 dark:text-gray-300">
                                                    <path d="M5 0L10 5H0z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3">ISBN</th>
                                <th scope="col" class="px-6 py-3">Editorial</th>
                                <th scope="col" class="px-6 py-3">Número Edición</th>
                                <th scope="col" class="px-6 py-3">Precio</th>
                                <th scope="col" class="px-6 py-3">Precio Promocional</th>
                                <th scope="col" class="px-6 py-3">Stock</th>
                                <th scope="col" class="px-6 py-3">Umbral</th>
                                <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ediciones as $edicion)
                            <tr class="bg-white dark:bg-gray-700 border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4">
                                    <div class="flex items-center relative">
                                        <input id="checkbox-table-search-{{ $edicion->id }}" type="checkbox"
                                            wire:model.live="selectedEdiciones" value="{{ $edicion->id }}"
                                            class="w-5 h-5 border-2 border-gray-500 dark:border-gray-400 rounded-md bg-white dark:bg-gray-700 checked:bg-blue-600 checked:border-gray-700 dark:checked:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-200 shadow-sm hover:scale-105 cursor-pointer" />
                                    </div>
                                </td>

                                <th scope="row" class="px-6 py-4 font-medium text-gray-400 dark:text-gray-500 whitespace-nowrap">
                                    {{ $edicion->id }}
                                </th>

                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $edicion->book->titulo }}</span>
                                </td>

                                <td class="px-6 py-4 text-gray-900 dark:text-gray-300">
                                    {{ $edicion->book->ISBN }}
                                </td>

                                <td class="px-6 py-4 text-gray-900 dark:text-gray-300">
                                    {{ $edicion->editorial->nombre }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-purple-100 dark:bg-purple-800 text-purple-800 dark:text-purple-200 rounded-full text-xs font-medium">
                                        {{ $edicion->numero_edicion }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="font-semibold text-green-600 dark:text-green-400">
                                        S/ {{ number_format($edicion->precio, 2) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    @if($edicion->precio_promocional && $edicion->precio_promocional < $edicion->precio)
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-red-600 dark:text-red-400 text-sm">
                                                S/ {{ number_format($edicion->precio_promocional, 2) }}
                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400 line-through">
                                                S/ {{ number_format($edicion->precio, 2) }}
                                            </span>
                                            <span class="text-xs text-green-600 dark:text-green-400 font-medium">
                                                -{{ round((($edicion->precio - $edicion->precio_promocional) / $edicion->precio) * 100, 1) }}%
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500 text-sm">
                                            Sin descuento
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 {{ $edicion->inventory->cantidad > $edicion->inventory->umbral ? 'bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200' : 'bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-200' }} rounded-full text-xs font-medium">
                                        {{ $edicion->inventory->cantidad }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 rounded-full text-xs font-medium">
                                        {{ $edicion->inventory->umbral }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center w-32">
                                    <div class="flex items-center justify-center space-x-3">
                                        <button wire:click="editarEdicion({{ $edicion->id }})"
                                            class="p-2 bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 rounded-lg hover:scale-110 transition-transform w-10 h-10 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button wire:click="confirmarEliminacion({{ $edicion->id }})"
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
                        No se encontraron ediciones que coincidan con la búsqueda
                    </h1>
                </div>
                @endif
            </div>

            <!-- CONTROLES DE PAGINACIÓN -->
            <div class="flex justify-between mt-3 gap-8 items-center">
                <!-- Botón Eliminar Múltiple -->
                <div class="flex items-center gap-4 ml-4 mt-3">
                    <button wire:click="eliminarshowmodal"
                        class="px-4 py-3 mb-4 flex items-center justify-center font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 border-2 {{ count($selectedEdiciones) >= 2 ? 'bg-white dark:bg-gray-700 hover:bg-red-400 dark:hover:bg-red-600 text-black dark:text-white border-black dark:border-gray-500 cursor-pointer' : 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 border-gray-300 dark:border-gray-600 cursor-not-allowed opacity-50' }}"
                        {{ count($selectedEdiciones) < 2 ? 'disabled' : '' }}>
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        <span class="text-xs lg:text-sm">Borrar Seleccionadas ({{ count($selectedEdiciones) }})</span>
                    </button>
                </div>

                <!-- Paginación -->
                <div class="flex items-center space-x-4">
                    {{ $ediciones->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL CREAR EDICIÓN -->
    @if($showCreateModal)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Crear Nueva Edición</h3>
                <button wire:click="$set('showCreateModal', false)" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="crearEdicion">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Libro</label>
                        <select wire:model="nuevaEdicion.book_id" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="">Seleccionar libro</option>
                            @foreach($libros as $libro)
                            <option value="{{ $libro->id }}">{{ $libro->titulo }} ({{ $libro->ISBN }})</option>
                            @endforeach
                        </select>
                        @error('nuevaEdicion.book_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Editorial</label>
                        <select wire:model="nuevaEdicion.editorial_id" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="">Seleccionar editorial</option>
                            @foreach($editoriales as $editorial)
                            <option value="{{ $editorial->id }}">{{ $editorial->nombre }}</option>
                            @endforeach
                        </select>
                        @error('nuevaEdicion.editorial_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Número de Edición</label>
                        <input type="text" wire:model="nuevaEdicion.numero_edicion" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="Ej: 1ra edición">
                        @error('nuevaEdicion.numero_edicion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Precio</label>
                        <input type="number" step="0.01" wire:model="nuevaEdicion.precio" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="0.00">
                        @error('nuevaEdicion.precio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cantidad en Stock</label>
                        <input type="number" wire:model="nuevaEdicion.cantidad" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="0">
                        @error('nuevaEdicion.cantidad') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Umbral Mínimo</label>
                        <input type="number" wire:model="nuevaEdicion.umbral" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="0">
                        @error('nuevaEdicion.umbral') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" wire:click="$set('showCreateModal', false)" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">
                        Crear Edición
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- MODAL EDITAR EDICIÓN -->
    @if($showEditModal)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Editar Edición</h3>
                <button wire:click="$set('showEditModal', false)" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="guardarEdicion">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Libro</label>
                        <select wire:model="edicionEditada.book_id" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="">Seleccionar libro</option>
                            @foreach($libros as $libro)
                            <option value="{{ $libro->id }}">{{ $libro->titulo }} ({{ $libro->ISBN }})</option>
                            @endforeach
                        </select>
                        @error('edicionEditada.book_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Editorial</label>
                        <select wire:model="edicionEditada.editorial_id" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="">Seleccionar editorial</option>
                            @foreach($editoriales as $editorial)
                            <option value="{{ $editorial->id }}">{{ $editorial->nombre }}</option>
                            @endforeach
                        </select>
                        @error('edicionEditada.editorial_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Número de Edición</label>
                        <input type="text" wire:model="edicionEditada.numero_edicion" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="Ej: 1ra edición">
                        @error('edicionEditada.numero_edicion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Precio</label>
                        <input type="number" step="0.01" wire:model="edicionEditada.precio" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="0.00">
                        @error('edicionEditada.precio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cantidad en Stock</label>
                        <input type="number" wire:model="edicionEditada.cantidad" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="0">
                        @error('edicionEditada.cantidad') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Umbral Mínimo</label>
                        <input type="number" wire:model="edicionEditada.umbral" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="0">
                        @error('edicionEditada.umbral') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" wire:click="$set('showEditModal', false)" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- MODAL CONFIRMAR ELIMINACIÓN -->
    @if($showDeleteModal)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        {{ $eliminacionmode === 'unico' ? 'Confirmar Eliminación' : 'Confirmar Eliminación Múltiple' }}
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        {{ $eliminacionmode === 'unico' ? '¿Estás seguro de que quieres eliminar esta edición? Esta acción no se puede deshacer.' : '¿Estás seguro de que quieres eliminar las ediciones seleccionadas? Esta acción no se puede deshacer.' }}
                    </p>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <button wire:click="cancelarEliminacion" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                    Cancelar
                </button>
                <button wire:click="{{ $eliminacionmode === 'unico' ? 'eliminarEdicion' : 'eliminarEdicionesSeleccionadas' }}" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">
                    Eliminar
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- NOTIFICACIÓN -->
    @if($showNotification)
    <div class="fixed top-4 right-4 z-50">
        <div class="bg-white dark:bg-gray-800 border-l-4 {{ $notificationType === 'success' ? 'border-green-500' : ($notificationType === 'error' ? 'border-red-500' : 'border-yellow-500') }} p-4 rounded-lg shadow-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    @if($notificationType === 'success')
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    @elseif($notificationType === 'error')
                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    @else
                    <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    @endif
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $notificationMessage }}</p>
                </div>
                <div class="ml-auto pl-3">
                    <button wire:click="cerrarNotificacion" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div> 