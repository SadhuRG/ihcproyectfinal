<div>
    <h1 class="pt-5"></h1>
    <x-section-title title="GESTIÓN DE PEDIDOS" />

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
                        <input wire:model.live.debounce.300ms="search" type="text" id="table-search"
                            class="bg-white dark:bg-gray-600 border shadow-md border-gray-300 dark:border-gray-500 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-1.5 placeholder-gray-500 dark:placeholder-gray-400"
                            placeholder="Buscar por ID, cliente, email...">
                    </div>

                    <!-- Filtros -->
                    <div class="flex items-center gap-2 mb-5">
                        <!-- Filtro de Estado -->
                        <select wire:model.live="statusFilter" class="bg-white dark:bg-gray-600 border shadow-md border-gray-300 dark:border-gray-500 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-1.5">
                            <option value="">Todos los estados</option>
                            <option value="0">Pendiente</option>
                            <option value="1">Completado</option>
                        </select>

                        <!-- Filtro de Fecha -->
                        <select wire:model.live="dateFilter" class="bg-white dark:bg-gray-600 border shadow-md border-gray-300 dark:border-gray-500 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-1.5">
                            <option value="">Todas las fechas</option>
                            <option value="today">Hoy</option>
                            <option value="week">Última semana</option>
                            <option value="month">Último mes</option>
                            <option value="year">Último año</option>
                        </select>

                        <!-- Filtro de Usuario -->
                        <select wire:model.live="userFilter" class="bg-white dark:bg-gray-600 border shadow-md border-gray-300 dark:border-gray-500 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-1.5">
                            <option value="">Todos los usuarios</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if($pedidos->count() > 0)
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
                                        Fecha
                                        <div class="flex flex-col ml-3">
                                            <button wire:click="order('created_at')" class="w-3 h-3 cursor-pointer {{ $sort === 'created_at' && $direction === 'asc' ? 'opacity-100' : 'opacity-40' }}">
                                                <svg viewBox="0 0 10 10" class="w-3 h-3 fill-current text-gray-700 dark:text-gray-300">
                                                    <path d="M5 0L10 5H0z"/>
                                                </svg>
                                            </button>
                                            <button wire:click="order('created_at')" class="w-3 h-3 cursor-pointer {{ $sort === 'created_at' && $direction === 'desc' ? 'opacity-100' : 'opacity-40' }}">
                                                <svg viewBox="0 0 10 10" class="w-3 h-3 fill-current rotate-180 text-gray-700 dark:text-gray-300">
                                                    <path d="M5 0L10 5H0z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3">Cliente</th>
                                <th scope="col" class="px-6 py-3">Total</th>
                                <th scope="col" class="px-6 py-3">Estado</th>
                                <th scope="col" class="px-6 py-3">Pago</th>
                                <th scope="col" class="px-6 py-3">Envío</th>
                                <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $pedido)
                            <tr class="bg-white dark:bg-gray-700 border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4">
                                    <div class="flex items-center relative">
                                        <input id="checkbox-table-search-{{ $pedido->id }}" type="checkbox"
                                            wire:model.live="selectedPedidos" value="{{ $pedido->id }}"
                                            class="w-5 h-5 border-2 border-gray-500 dark:border-gray-400 rounded-md bg-white dark:bg-gray-700 checked:bg-blue-600 checked:border-gray-700 dark:checked:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-200 shadow-sm hover:scale-105 cursor-pointer" />
                                    </div>
                                </td>

                                <th scope="row" class="px-6 py-4 font-medium text-gray-400 dark:text-gray-500 whitespace-nowrap">
                                    {{ $pedido->id }}
                                </th>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y') }}</span>
                                        <span class="text-xs text-gray-400 dark:text-gray-500">{{ \Carbon\Carbon::parse($pedido->created_at)->format('H:i') }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-900 dark:text-white">{{ $pedido->user->name }} {{ $pedido->user->apellido }}</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $pedido->user->email }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="font-semibold text-green-600 dark:text-green-400">
                                        S/ {{ number_format($pedido->total, 2) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <select wire:change="cambiarEstado({{ $pedido->id }}, $event.target.value)"
                                            class="px-2 py-1 text-xs font-semibold rounded-full border-0 cursor-pointer
                                            {{ $pedido->estado == 1 ? 'bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200' : 'bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200' }}">
                                        <option value="0" {{ $pedido->estado == 0 ? 'selected' : '' }}>Pendiente</option>
                                        <option value="1" {{ $pedido->estado == 1 ? 'selected' : '' }}>Completado</option>
                                    </select>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 rounded-full text-xs">
                                        {{ $pedido->paymentType->nombre }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-purple-100 dark:bg-purple-800 text-purple-800 dark:text-purple-200 rounded-full text-xs">
                                        {{ $pedido->shipmentType->nombre }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center w-32">
                                    <div class="flex items-center justify-center space-x-3">
                                        <button wire:click="verDetalle({{ $pedido->id }})"
                                            class="p-2 bg-indigo-500 hover:bg-indigo-600 dark:bg-indigo-600 dark:hover:bg-indigo-700 rounded-lg hover:scale-110 transition-transform w-10 h-10 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                        <button wire:click="editarPedido({{ $pedido->id }})"
                                            class="p-2 bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 rounded-lg hover:scale-110 transition-transform w-10 h-10 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button wire:click="confirmarEliminacion({{ $pedido->id }})"
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

                {{-- CONTROLES INFERIORES --}}
                <div class="flex justify-between items-center mt-4">
                    {{-- Botón Eliminar Múltiple --}}
                    <div>
                        <button wire:click="eliminarshowmodal"
                            class="px-4 py-2 flex items-center justify-center font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 border-2 {{ count($selectedPedidos) >= 2 ? 'bg-white dark:bg-gray-700 hover:bg-red-400 dark:hover:bg-red-600 text-black dark:text-white border-black dark:border-gray-500 cursor-pointer' : 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 border-gray-300 dark:border-gray-600 cursor-not-allowed opacity-60' }}"
                            {{ count($selectedPedidos) < 2 ? 'disabled' : '' }}>
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            <span>Eliminar ({{ count($selectedPedidos) }})</span>
                        </button>
                    </div>

                    {{-- Paginación --}}
                    <div>
                        {{ $pedidos->links() }}
                    </div>
                </div>

                @else
                <div class="p-8 text-center text-gray-500 dark:text-gray-400 bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-700 rounded-lg">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-lg font-medium text-red-800 dark:text-red-300">No se encontraron pedidos</p>
                    <p class="text-sm">No hay pedidos que coincidan con los filtros aplicados.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Modal para Editar Pedido -->
    @if($showEditModal)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Editar Pedido</h3>
                <button wire:click="$set('showEditModal', false)" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="guardarPedido" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cliente *</label>
                        <select wire:model="pedidoEditado.user_id" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar cliente...</option>
                            @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apellido }}</option>
                            @endforeach
                        </select>
                        @error('pedidoEditado.user_id') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha *</label>
                        <input type="date" wire:model="pedidoEditado.fecha_orden" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('pedidoEditado.fecha_orden') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Método de Pago *</label>
                        <select wire:model="pedidoEditado.payment_type_id" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar método...</option>
                            @foreach($paymentTypes as $paymentType)
                            <option value="{{ $paymentType->id }}">{{ $paymentType->nombre }}</option>
                            @endforeach
                        </select>
                        @error('pedidoEditado.payment_type_id') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Envío *</label>
                        <select wire:model="pedidoEditado.shipment_type_id" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar tipo...</option>
                            @foreach($shipmentTypes as $shipmentType)
                            <option value="{{ $shipmentType->id }}">{{ $shipmentType->nombre }}</option>
                            @endforeach
                        </select>
                        @error('pedidoEditado.shipment_type_id') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado *</label>
                        <select wire:model="pedidoEditado.estado" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Pendiente</option>
                            <option value="1">Completado</option>
                        </select>
                        @error('pedidoEditado.estado') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Total (S/) *</label>
                        <input type="number" step="0.01" wire:model="pedidoEditado.total" required
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('pedidoEditado.total') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" wire:click="$set('showEditModal', false)"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-700 transition-colors">
                        Actualizar Pedido
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Modal de Detalle del Pedido -->
    @if($showDetailModal && $pedidoDetalle)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detalle del Pedido {{ $pedidoDetalle->id }}</h3>
                <button wire:click="$set('showDetailModal', false)" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información del Cliente -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Información del Cliente</h4>
                    <div class="space-y-2">
                        <p class="text-gray-700 dark:text-gray-300"><span class="font-medium">Nombre:</span> {{ $pedidoDetalle->user->name }} {{ $pedidoDetalle->user->apellido }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><span class="font-medium">Email:</span> {{ $pedidoDetalle->user->email }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><span class="font-medium">Teléfono:</span> {{ $pedidoDetalle->user->telefono ?? 'No especificado' }}</p>
                    </div>
                </div>

                <!-- Información de Envío -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Dirección de Envío</h4>
                    <div class="space-y-2">
                        <p class="text-gray-700 dark:text-gray-300">{{ $pedidoDetalle->address->calle }} {{ $pedidoDetalle->address->numero_piso }}</p>
                        <p class="text-gray-700 dark:text-gray-300">{{ $pedidoDetalle->address->distrito }}, {{ $pedidoDetalle->address->provincia }}</p>
                        <p class="text-gray-700 dark:text-gray-300">{{ $pedidoDetalle->address->departamento }}</p>
                        @if($pedidoDetalle->address->referencia)
                            <p class="text-gray-700 dark:text-gray-300"><span class="font-medium">Referencia:</span> {{ $pedidoDetalle->address->referencia }}</p>
                        @endif
                    </div>
                </div>

                <!-- Información del Pedido -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Información del Pedido</h4>
                    <div class="space-y-2">
                        <p class="text-gray-700 dark:text-gray-300"><span class="font-medium">Fecha:</span> {{ \Carbon\Carbon::parse($pedidoDetalle->created_at)->format('d/m/Y H:i') }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><span class="font-medium">Estado:</span>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $pedidoDetalle->estado == 1 ? 'bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200' : 'bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200' }}">
                                {{ $pedidoDetalle->estado == 1 ? 'Completado' : 'Pendiente' }}
                            </span>
                        </p>
                        <p class="text-gray-700 dark:text-gray-300"><span class="font-medium">Método de Pago:</span> {{ $pedidoDetalle->paymentType->nombre }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><span class="font-medium">Tipo de Envío:</span> {{ $pedidoDetalle->shipmentType->nombre }}</p>
                    </div>
                </div>

                <!-- Resumen de Costos -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Resumen de Costos</h4>
                    <div class="space-y-2">
                        <p class="text-gray-700 dark:text-gray-300"><span class="font-medium">Total:</span> <span class="text-lg font-bold text-green-600 dark:text-green-400">S/ {{ number_format($pedidoDetalle->total, 2) }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Productos del Pedido -->
            <div class="mt-6">
                <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Productos del Pedido</h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-600">
                            <tr>
                                <th class="px-6 py-3">Producto</th>
                                <th class="px-6 py-3">Editorial</th>
                                <th class="px-6 py-3">Cantidad</th>
                                <th class="px-6 py-3">Precio Unit.</th>
                                <th class="px-6 py-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidoDetalle->editions as $edition)
                            <tr class="bg-white dark:bg-gray-700 border-b dark:border-gray-600">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded object-cover" src="{{ $edition->url_portada }}" alt="Portada">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $edition->book->titulo }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $edition->numero_edicion }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $edition->editorial->nombre }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $edition->pivot->cantidad }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">S/ {{ number_format($edition->precio, 2) }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">S/ {{ number_format($edition->precio * $edition->pivot->cantidad, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal para Confirmación de Eliminación -->
    @if($showDeleteModal)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Confirmar Eliminación</h3>
            @if($eliminacionmode === 'unico')
            <p class="mb-6 text-gray-700 dark:text-gray-300">¿Seguro que quieres eliminar este pedido?<br>Esta acción no se puede deshacer.</p>
            @else
            <p class="mb-6 text-gray-700 dark:text-gray-300">¿Seguro que quieres eliminar los <b>{{ count($selectedPedidos) }}</b> pedidos seleccionados?<br>Esta acción no se puede deshacer.</p>
            @endif
            <div class="flex justify-center space-x-4">
                <button wire:click="cancelarEliminacion" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">Cancelar</button>
                <button wire:click="{{ $eliminacionmode === 'unico' ? 'eliminarPedido' : 'eliminarPedidosSeleccionados' }}" class="px-4 py-2 bg-red-500 dark:bg-red-600 text-white rounded hover:bg-red-600 dark:hover:bg-red-700 transition-colors">Eliminar</button>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de Notificación -->
    @if($showNotification)
    <div x-data="{ visible: true }" x-init="setTimeout(() => { visible = false; $wire.cerrarNotificacion() }, 3000)" x-show="visible"
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-2"
         class="fixed top-4 right-4 z-50 max-w-md w-full mx-4">
        <div class="p-4 rounded-lg shadow-xl text-white
            {{ $notificationType === 'success' ? 'bg-green-500 dark:bg-green-600' : 'bg-red-500 dark:bg-red-600' }}">
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
