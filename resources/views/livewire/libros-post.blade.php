<div>
    <h1 class="pt-5"></h1>

    <x-section-title title="LIBROS" />

    <div class="mx-10">
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <div class="bg-primary-25 p-4 rounded-lg">
                <div class="flex items-center gap-4">
                    <div class="relative mt-1 mb-5 flex-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-3.5 h-3.5 text-gray-500 :text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model.live="search" type="text" id="table-search" class="bg-white border shadow-md border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-1.5 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500" placeholder="Buscar por título, ISBN o descripción...">
                    </div>
                </div>

                @if(is_array($datos) && count($datos) > 0)
                <table class="w-full text-sm text-left text-gray-500 :text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center relative">
                                    <input id="checkbox-all-search" type="checkbox" wire:model.live="selectAll" class="peer appearance-none w-5 h-5 border-[2.5px] border-gray-500 rounded-md bg-white checked:bg-blue-600 checked:border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 shadow-md hover:shadow-lg hover:scale-110 cursor-pointer" />
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
                                        <img src="{{ asset('icons/triangle.svg') }}" wire:click="order('id')" class="w-3 h-3 cursor-pointer {{ $sort === 'id' && $direction === 'asc' ? 'opacity-100' : 'opacity-40' }}" alt="Ascendente">
                                        <img src="{{ asset('icons/triangle-inverted.svg') }}" wire:click="order('id')" class="w-3 h-3 cursor-pointer {{ $sort === 'id' && $direction === 'desc' ? 'opacity-100' : 'opacity-40' }}" alt="Descendente">
                                    </div>
                                </div>
                            </th>
                            <th class="pl-6">
                                <div class="flex items-center">
                                    Título
                                    <div class="flex flex-col ml-3">
                                        <img src="{{ asset('icons/triangle.svg') }}" wire:click="order('titulo')" class="w-3 h-3 cursor-pointer {{ $sort === 'titulo' && $direction === 'asc' ? 'opacity-100' : 'opacity-40' }}" alt="Ascendente">
                                        <img src="{{ asset('icons/triangle-inverted.svg') }}" wire:click="order('titulo')" class="w-3 h-3 cursor-pointer {{ $sort === 'titulo' && $direction === 'desc' ? 'opacity-100' : 'opacity-40' }}" alt="Descendente">
                                    </div>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">ISBN</th>
                            <th scope="col" class="px-6 py-3">Descripción</th>
                            <th scope="col" class="px-6 py-3">Categorías</th>
                            <th scope="col" class="px-6 py-3">Autores</th>
                            <th scope="col" class="px-6 py-3">Ediciones</th>
                            <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datos as $libro)
                        <tr class="bg-white border-b :bg-gray-800 :border-gray-700 hover:bg-gray-50 :hover:bg-gray-600">
                            <td class="w-4 p-4">
                                <div class="flex items-center relative">
                                    <input id="checkbox-table-search-{{ $libro['id'] }}" type="checkbox" wire:model.live="selectedLibros" value="{{ $libro['id'] }}" class="peer appearance-none w-5 h-5 border-2 border-gray-500 rounded-md bg-white checked:bg-blue-600 checked:border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-200 shadow-sm hover:scale-105 cursor-pointer" />
                                    <span class="pointer-events-none absolute left-[1px] top-[1px] w-5 h-5 flex items-center justify-center hidden peer-checked:flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 13l4 4L19 7" />
                                        </svg>
                                    </span>
                                    <label for="checkbox-table-search-{{ $libro['id'] }}" class="sr-only">Seleccionar registro</label>
                                </div>
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-400 :text-white whitespace-nowrap">
                                {{ $libro['id'] }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $libro['titulo'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $libro['ISBN'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $libro['descripcion'] }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($libro['categorías'] as $categoria)
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">{{ $categoria }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($libro['autores'] as $autor)
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">{{ $autor }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($libro['ediciones'] as $edicion)
                                        <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">{{ $edicion }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center w-32">
                                <div class="flex items-center justify-center space-x-3">
                                    <button wire:click="editarLibro({{ $libro['id'] }})" class="text-blue-600 hover:text-blue-900">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button wire:click="confirmarEliminacion({{ $libro['id'] }})" class="text-red-600 hover:text-red-900">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Controles de Paginación -->
                <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                    <div class="flex justify-between flex-1 sm:hidden">
                        <button wire:click="previousPage" {{ $currentPage <= 1 ? 'disabled' : '' }}
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 {{ $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Anterior
                        </button>
                        <button wire:click="nextPage" {{ $currentPage >= $totalPages ? 'disabled' : '' }}
                            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 {{ $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Siguiente
                        </button>
                    </div>
                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Mostrando
                                <span class="font-medium">{{ ($currentPage - 1) * $perPage + 1 }}</span>
                                a
                                <span class="font-medium">{{ min($currentPage * $perPage, $total) }}</span>
                                de
                                <span class="font-medium">{{ $total }}</span>
                                resultados
                            </p>
                        </div>
                        <div>
                            <!-- Paginación manual con enlaces -->
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <button wire:click="previousPage" {{ $currentPage <= 1 ? 'disabled' : '' }}
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 {{ $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}">
                                    Anterior
                                </button>
                                @for ($i = 1; $i <= $totalPages; $i++)
                                    <button wire:click="$set('currentPage', {{ $i }})" @if($currentPage == $i) disabled @endif
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium {{ $currentPage == $i ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:bg-gray-50' }}">
                                        {{ $i }}
                                    </button>
                                @endfor
                                <button wire:click="nextPage" {{ $currentPage >= $totalPages ? 'disabled' : '' }}
                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 {{ $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' }}">
                                    Siguiente
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    @if($mostrarModal)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 animate-fade-in">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 transform transition-all duration-300 animate-slide-up">
            <div class="relative bg-gradient-to-r from-blue-600 to-purple-600 rounded-t-2xl p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Editar Libro</h2>
                            <p class="text-blue-100 text-sm">Actualiza la información del libro</p>
                        </div>
                    </div>
                    <button wire:click="cancelarEdicion" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center text-white transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span>Título</span>
                        </label>
                        <input type="text" wire:model.defer="libroEditado.titulo" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                            <span>ISBN</span>
                        </label>
                        <input type="text" wire:model.defer="libroEditado.ISBN" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white">
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-sm font-medium text-gray-700 flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Descripción</span>
                        </label>
                        <textarea wire:model.defer="libroEditado.descripcion" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white" rows="3"></textarea>
                    </div>

                    <div class="md:col-span-2 space-y-4">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Categorías</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($libroEditado['categorías'] ?? [] as $categoria)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        {{ $categoria }}
                                        <button type="button" wire:click="quitarCategoria('{{ $categoria }}')" class="flex-shrink-0 ml-1 h-4 w-4 rounded-full inline-flex items-center justify-center text-blue-800 hover:bg-blue-200 hover:text-blue-900 focus:outline-none">
                                            <span class="sr-only">Eliminar categoría</span>
                                            <svg class="h-3 w-3" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </span>
                                @endforeach
                            </div>
                            <div class="flex gap-2">
                                <input type="text" wire:model.defer="nuevaCategoria" placeholder="Nueva categoría" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <button type="button" wire:click="agregarCategoria" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Agregar
                                </button>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Autores</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($libroEditado['autores'] ?? [] as $autor)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        {{ $autor }}
                                        <button type="button" wire:click="quitarAutor('{{ $autor }}')" class="flex-shrink-0 ml-1 h-4 w-4 rounded-full inline-flex items-center justify-center text-green-800 hover:bg-green-200 hover:text-green-900 focus:outline-none">
                                            <span class="sr-only">Eliminar autor</span>
                                            <svg class="h-3 w-3" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </span>
                                @endforeach
                            </div>
                            <div class="flex gap-2">
                                <input type="text" wire:model.defer="nuevoAutor" placeholder="Nuevo autor" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <button type="button" wire:click="agregarAutor" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    Agregar
                                </button>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Ediciones</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($libroEditado['ediciones'] ?? [] as $edicion)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        {{ $edicion }}
                                        <button type="button" wire:click="quitarEdicion('{{ $edicion }}')" class="flex-shrink-0 ml-1 h-4 w-4 rounded-full inline-flex items-center justify-center text-purple-800 hover:bg-purple-200 hover:text-purple-900 focus:outline-none">
                                            <span class="sr-only">Eliminar edición</span>
                                            <svg class="h-3 w-3" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </span>
                                @endforeach
                            </div>
                            <div class="flex gap-2">
                                <input type="text" wire:model.defer="nuevaEdicion" placeholder="Nueva edición" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <button type="button" wire:click="agregarEdicion" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button wire:click="cancelarEdicion" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancelar
                    </button>
                    <button wire:click="guardarLibro" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Guardar Cambios
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($showDeleteModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-sm mx-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100 mx-auto">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>

            <div class="mt-4 text-center">
                <h3 class="text-lg font-medium text-gray-900">
                    @if($eliminacionmode === 'multiple')
                        ¿Estás seguro de eliminar los libros seleccionados?
                    @else
                        ¿Estás seguro de eliminar este libro?
                    @endif
                </h3>
                <p class="mt-2 text-sm text-gray-500">
                    Esta acción no se puede deshacer.
                </p>
            </div>

            <div class="mt-6 flex justify-center space-x-3">
                @if($eliminacionmode === 'multiple')
                    <button wire:click="canceleliminarshowmodal" class="px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancelar
                    </button>
                    <button wire:click="eliminarLibrosSeleccionados" class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Eliminar Seleccionados
                    </button>
                @else
                    <button wire:click="cancelarEliminacion" class="px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancelar
                    </button>
                    <button wire:click="eliminarLibro" class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Eliminar
                    </button>
                @endif
            </div>
        </div>
    </div>
    @endif

    @if($showNotification)
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in-up">
        <div class="flex items-center space-x-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>{{ $notificationMessage }}</span>
            <button wire:click="cerrarNotificacion" class="ml-4 text-green-100 hover:text-white focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    @endif
</div>
