<div>
    <x-section-title title="GESTIÓN DE PROMOCIONES" />

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
                            placeholder="Buscar por nombre o libro...">
                    </div>

                    <!-- Botón Crear Promoción -->
                    <button wire:click="$set('showCreateModal', true)"
                        class="px-4 py-3 mb-4 flex items-center justify-center bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="text-xs lg:text-sm">Nueva Promoción</span>
                    </button>
                </div>

                @if($promociones->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all-search" type="checkbox" wire:model.live="selectAll"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <button wire:click="order('id')" class="flex items-center">
                                        ID
                                        <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                        </svg>
                                    </button>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <button wire:click="order('nombre')" class="flex items-center">
                                        Nombre
                                        <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                        </svg>
                                    </button>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <button wire:click="order('cantidad')" class="flex items-center">
                                        Descuento
                                        <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                        </svg>
                                    </button>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Libro Aplicado
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($promociones as $promocion)
                            <tr class="bg-white dark:bg-gray-700 border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4">
                                    <div class="flex items-center relative">
                                        <input id="checkbox-table-search-{{ $promocion->id }}" type="checkbox"
                                            wire:model.live="selectedPromociones" value="{{ $promocion->id }}"
                                            class="w-5 h-5 border-2 border-gray-500 dark:border-gray-400 rounded-md bg-white dark:bg-gray-700 checked:bg-blue-600 checked:border-gray-700 dark:checked:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-200 shadow-sm hover:scale-105 cursor-pointer" />
                                    </div>
                                </td>

                                <th scope="row" class="px-6 py-4 font-medium text-gray-400 dark:text-gray-500 whitespace-nowrap">
                                    {{ $promocion->id }}
                                </th>

                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $promocion->nombre }}</span>
                                </td>

                                <td class="px-6 py-4 text-gray-900 dark:text-gray-300">
                                    <span class="px-2 py-1 bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-200 rounded-full text-xs font-semibold">
                                        -{{ $promocion->cantidad }}%
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-gray-900 dark:text-gray-300">
                                    @if($promocion->books->count() > 0)
                                        <span class="font-medium">{{ $promocion->books->first()->titulo }}</span>
                                    @else
                                        <span class="text-gray-500 dark:text-gray-400">Sin libro asignado</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <button wire:click="editarPromocion({{ $promocion->id }})"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button wire:click="confirmarEliminacion({{ $promocion->id }})"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                @if($selectedPromociones)
                <div class="flex items-center justify-between pt-4">
                    <div class="flex items-center space-x-2">
                        <button wire:click="eliminarshowmodal"
                            class="px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Eliminar Seleccionadas ({{ count($selectedPromociones) }})
                        </button>
                    </div>
                </div>
                @endif

                <div class="pt-4">
                    {{ $promociones->links() }}
                </div>
                @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No hay promociones</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Comienza creando una nueva promoción.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal para Crear Promoción -->
    @if($showCreateModal)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Crear Nueva Promoción</h3>
                <button wire:click="$set('showCreateModal', false)" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="crearPromocion" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre de la Promoción *</label>
                    <input type="text" wire:model="nuevaPromocion.nombre" required
                        class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ej: Descuento de Verano">
                    @error('nuevaPromocion.nombre') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Porcentaje de Descuento *</label>
                    <div class="relative">
                        <input type="number" min="0" max="100" step="1" wire:model="nuevaPromocion.cantidad" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 pr-8"
                            placeholder="25">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <span class="text-gray-500 dark:text-gray-400 text-sm">%</span>
                        </div>
                    </div>
                    <small class="text-gray-500 dark:text-gray-400">Ingrese un valor entre 0 y 100</small>
                    @error('nuevaPromocion.cantidad') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Libro *</label>
                    <select wire:model="libroSeleccionado" required
                        class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleccionar libro...</option>
                        @foreach($libros as $libro)
                        <option value="{{ $libro->id }}">{{ $libro->titulo }}</option>
                        @endforeach
                    </select>
                    <small class="text-gray-500 dark:text-gray-400">El descuento se aplicará a todas las ediciones de este libro</small>
                    @error('libroSeleccionado') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" wire:click="$set('showCreateModal', false)"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 dark:bg-green-600 text-white rounded hover:bg-green-600 dark:hover:bg-green-700 transition-colors">
                        Crear Promoción
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Modal para Editar Promoción -->
    @if($showEditModal)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Editar Promoción</h3>
                <button wire:click="$set('showEditModal', false)" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="guardarPromocion" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre de la Promoción *</label>
                    <input type="text" wire:model="promocionEditada.nombre" required
                        class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ej: Descuento de Verano">
                    @error('promocionEditada.nombre') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Porcentaje de Descuento *</label>
                    <div class="relative">
                        <input type="number" min="0" max="100" step="1" wire:model="promocionEditada.cantidad" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 pr-8"
                            placeholder="25">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <span class="text-gray-500 dark:text-gray-400 text-sm">%</span>
                        </div>
                    </div>
                    <small class="text-gray-500 dark:text-gray-400">Ingrese un valor entre 0 y 100</small>
                    @error('promocionEditada.cantidad') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Libro *</label>
                    <select wire:model="libroSeleccionado" required
                        class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleccionar libro...</option>
                        @foreach($libros as $libro)
                        <option value="{{ $libro->id }}">{{ $libro->titulo }}</option>
                        @endforeach
                    </select>
                    <small class="text-gray-500 dark:text-gray-400">El descuento se aplicará a todas las ediciones de este libro</small>
                    @error('libroSeleccionado') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" wire:click="$set('showEditModal', false)"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-700 transition-colors">
                        Actualizar Promoción
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
            <p class="mb-6 text-gray-700 dark:text-gray-300">¿Estás seguro de eliminar esta promoción? Esta acción también revertirá los descuentos aplicados a las ediciones del libro.</p>
            <div class="flex justify-end space-x-4">
                <button wire:click="cancelarEliminacion"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                    Cancelar
                </button>
                <button wire:click="eliminarPromocion"
                    class="px-4 py-2 bg-red-500 dark:bg-red-600 text-white rounded hover:bg-red-600 dark:hover:bg-red-700 transition-colors">
                    Eliminar
                </button>
            </div>
            @else
            <p class="mb-6 text-gray-700 dark:text-gray-300">¿Estás seguro de eliminar estas {{ count($selectedPromociones) }} promociones? Esta acción también revertirá los descuentos aplicados a las ediciones de los libros.</p>
            <div class="flex justify-end space-x-4">
                <button wire:click="cancelarEliminacion"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                    Cancelar
                </button>
                <button wire:click="eliminarPromocionesSeleccionadas"
                    class="px-4 py-2 bg-red-500 dark:bg-red-600 text-white rounded hover:bg-red-600 dark:hover:bg-red-700 transition-colors">
                    Eliminar
                </button>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Notificación -->
    @if($showNotification)
    <div class="fixed top-4 right-4 z-50">
        <div class="bg-white dark:bg-gray-800 border-l-4 border-{{ $notificationType === 'success' ? 'green' : 'red' }}-400 p-4 shadow-lg rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    @if($notificationType === 'success')
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    @else
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    @endif
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ $notificationMessage }}</p>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button wire:click="cerrarNotificacion" class="inline-flex rounded-md p-1.5 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <span class="sr-only">Cerrar</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
