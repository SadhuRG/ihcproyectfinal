<div>
    <h1 class="pt-5"></h1>
    <x-section-title title="GESTIÓN DE PEDIDOS" />

    <div class="mx-10">
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <div class="bg-primary-25 p-4 rounded-lg">
                <div class="flex items-center gap-4 mb-4">
                    <!-- Búsqueda -->
                    <div class="relative mt-1 mb-5 flex-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-3.5 h-3.5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search" type="text" id="table-search"
                            class="bg-white border shadow-md border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-1.5"
                            placeholder="Buscar por ID, cliente, email...">
                    </div>

                    <!-- Filtros -->
                    <div class="flex items-center gap-2 mb-5">
                        <!-- Filtro de Estado -->
                        <select wire:model.live="statusFilter" class="bg-white border shadow-md border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-1.5">
                            <option value="">Todos los estados</option>
                            <option value="0">Pendiente</option>
                            <option value="1">Completado</option>
                        </select>

                        <!-- Filtro de Fecha -->
                        <select wire:model.live="dateFilter" class="bg-white border shadow-md border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-1.5">
                            <option value="">Todas las fechas</option>
                            <option value="today">Hoy</option>
                            <option value="week">Última semana</option>
                            <option value="month">Último mes</option>
                            <option value="year">Último año</option>
                        </select>

                        <!-- Filtro de Usuario -->
                        <select wire:model.live="userFilter" class="bg-white border shadow-md border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-1.5">
                            <option value="">Todos los usuarios</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apellido }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botón Nuevo Pedido -->
                    <button wire:click="$set('showCreateModal', true)"
                        class="px-4 py-3 mb-4 flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="text-xs lg:text-sm">Nuevo Pedido</span>
                    </button>
                </div>

                @if($pedidos->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center relative">
                                        <input id="checkbox-all-search" type="checkbox" wire:model.live="selectAll"
                                            class="w-5 h-5 border-2 border-gray-500 rounded-md bg-white checked:bg-blue-600 checked:border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 shadow-md hover:shadow-lg hover:scale-110 cursor-pointer" />
                                    </div>
                                </th>

                                <th>
                                    <div class="flex items-center">
                                        ID
                                        <div class="flex flex-col ml-3">
                                            <button wire:click="order('id')" class="w-3 h-3 cursor-pointer {{ $sort === 'id' && $direction === 'asc' ? 'opacity-100' : 'opacity-40' }}">
                                                <svg viewBox="0 0 10 10" class="w-3 h-3 fill-current">
                                                    <path d="M5 0L10 5H0z"/>
                                                </svg>
                                            </button>
                                            <button wire:click="order('id')" class="w-3 h-3 cursor-pointer {{ $sort === 'id' && $direction === 'desc' ? 'opacity-100' : 'opacity-40' }}">
                                                <svg viewBox="0 0 10 10" class="w-3 h-3 fill-current rotate-180">
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
                                                <svg viewBox="0 0 10 10" class="w-3 h-3 fill-current">
                                                    <path d="M5 0L10 5H0z"/>
                                                </svg>
                                            </button>
                                            <button wire:click="order('created_at')" class="w-3 h-3 cursor-pointer {{ $sort === 'created_at' && $direction === 'desc' ? 'opacity-100' : 'opacity-40' }}">
                                                <svg viewBox="0 0 10 10" class="w-3 h-3 fill-current rotate-180">
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
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="w-4 p-4">
                                    <div class="flex items-center relative">
                                        <input id="checkbox-table-search-{{ $pedido->id }}" type="checkbox"
                                            wire:model.live="selectedPedidos" value="{{ $pedido->id }}"
                                            class="w-5 h-5 border-2 border-gray-500 rounded-md bg-white checked:bg-blue-600 checked:border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-200 shadow-sm hover:scale-105 cursor-pointer" />
                                    </div>
                                </td>

                                <th scope="row" class="px-6 py-4 font-medium text-gray-400 whitespace-nowrap">
                                    {{ $pedido->id }}
                                </th>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-medium">{{ \Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y') }}</span>
                                        <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($pedido->created_at)->format('H:i') }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-900">{{ $pedido->user->name }} {{ $pedido->user->apellido }}</span>
                                        <span class="text-xs text-gray-500">{{ $pedido->user->email }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="font-semibold text-green-600">
                                        S/ {{ number_format($pedido->total, 2) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <select wire:change="cambiarEstado({{ $pedido->id }}, $event.target.value)"
                                            class="px-2 py-1 text-xs font-semibold rounded-full border-0 cursor-pointer
                                            {{ $pedido->estado == 1 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        <option value="0" {{ $pedido->estado == 0 ? 'selected' : '' }}>Pendiente</option>
                                        <option value="1" {{ $pedido->estado == 1 ? 'selected' : '' }}>Completado</option>
                                    </select>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                        {{ $pedido->paymentType->nombre }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">
                                        {{ $pedido->shipmentType->nombre }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center w-32">
                                    <div class="flex items-center justify-center space-x-3">
                                        <button wire:click="verDetalle({{ $pedido->id }})"
                                            class="p-2 bg-indigo-500 rounded-lg hover:scale-110 transition-transform w-10 h-10 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                        <button wire:click="editarPedido({{ $pedido->id }})"
                                            class="p-2 bg-blue-500 rounded-lg hover:scale-110 transition-transform w-10 h-10 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button wire:click="confirmarEliminacion({{ $pedido->id }})"
                                            class="p-2 bg-red-500 rounded-lg hover:scale-110 transition-transform w-10 h-10 flex items-center justify-center">
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
                <div class="rounded-lg text-lg ml-4 text-gray-700 bg-red-100 border border-red-300">
                    <h1 class="px-3 py-3 text-red-800">
                        No se encontraron pedidos que coincidan con la búsqueda
                    </h1>
                </div>
                @endif
            </div>

            <!-- CONTROLES DE PAGINACIÓN -->
            <div class="flex justify-between mt-3 gap-8 items-center">
                <!-- Botón Eliminar Múltiple -->
                <div class="flex items-center gap-4 ml-4 mt-3">
                    <button wire:click="eliminarshowmodal"
                        class="px-4 py-3 mb-4 flex items-center justify-center font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 border-2 {{ count($selectedPedidos) >= 2 ? 'bg-white hover:bg-red-400 text-black border-black cursor-pointer' : 'bg-gray-300 text-gray-500 border-gray-300 cursor-not-allowed opacity-50' }}"
                        {{ count($selectedPedidos) < 2 ? 'disabled' : '' }}>
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        <span class="text-xs lg:text-sm">Borrar Seleccionados ({{ count($selectedPedidos) }})</span>
                    </button>
                </div>

                <!-- Paginación -->
                <div class="flex items-center space-x-4">
                    {{ $pedidos->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Crear Pedido -->
    @if($showCreateModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Crear Nuevo Pedido</h3>
                <button wire:click="$set('showCreateModal', false)" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="crearPedido" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cliente *</label>
                        <select wire:model="nuevoPedido.user_id" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar cliente...</option>
                            @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apellido }}</option>
                            @endforeach
                        </select>
                        @error('nuevoPedido.user_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha *</label>
                        <input type="date" wire:model="nuevoPedido.fecha_orden" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('nuevoPedido.fecha_orden') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Método de Pago *</label>
                        <select wire:model="nuevoPedido.payment_type_id" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar método...</option>
                            @foreach($paymentTypes as $paymentType)
                            <option value="{{ $paymentType->id }}">{{ $paymentType->nombre }}</option>
                            @endforeach
                        </select>
                        @error('nuevoPedido.payment_type_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Envío *</label>
                        <select wire:model="nuevoPedido.shipment_type_id" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar tipo...</option>
                            @foreach($shipmentTypes as $shipmentType)
                            <option value="{{ $shipmentType->id }}">{{ $shipmentType->nombre }}</option>
                            @endforeach
                        </select>
                        @error('nuevoPedido.shipment_type_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado *</label>
                        <select wire:model="nuevoPedido.estado" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Pendiente</option>
                            <option value="1">Completado</option>
                        </select>
                        @error('nuevoPedido.estado') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Total (S/) *</label>
                        <input type="number" step="0.01" wire:model="nuevoPedido.total" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('nuevoPedido.total') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" wire:click="$set('showCreateModal', false)"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors">
                        Crear Pedido
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Modal para Editar Pedido -->
    @if($showEditModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Editar Pedido</h3>
                <button wire:click="$set('showEditModal', false)" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="guardarPedido" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cliente *</label>
                        <select wire:model="pedidoEditado.user_id" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar cliente...</option>
                            @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apellido }}</option>
                            @endforeach
                        </select>
                        @error('pedidoEditado.user_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha *</label>
                        <input type="date" wire:model="pedidoEditado.fecha_orden" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('pedidoEditado.fecha_orden') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Método de Pago *</label>
                        <select wire:model="pedidoEditado.payment_type_id" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar método...</option>
                            @foreach($paymentTypes as $paymentType)
                            <option value="{{ $paymentType->id }}">{{ $paymentType->nombre }}</option>
                            @endforeach
                        </select>
                        @error('pedidoEditado.payment_type_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Envío *</label>
                        <select wire:model="pedidoEditado.shipment_type_id" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar tipo...</option>
                            @foreach($shipmentTypes as $shipmentType)
                            <option value="{{ $shipmentType->id }}">{{ $shipmentType->nombre }}</option>
                            @endforeach
                        </select>
                        @error('pedidoEditado.shipment_type_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado *</label>
                        <select wire:model="pedidoEditado.estado" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Pendiente</option>
                            <option value="1">Completado</option>
                        </select>
                        @error('pedidoEditado.estado') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Total (S/) *</label>
                        <input type="number" step="0.01" wire:model="pedidoEditado.total" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('pedidoEditado.total') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" wire:click="$set('showEditModal', false)"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                        Actualizar Pedido
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Modal de Detalle del Pedido -->
    @if($showDetailModal && $pedidoDetalle)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Detalle del Pedido {{ $pedidoDetalle->id }}</h3>
                <button wire:click="$set('showDetailModal', false)" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información del Cliente -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-3">Información del Cliente</h4>
                    <div class="space-y-2">
                        <p><span class="font-medium">Nombre:</span> {{ $pedidoDetalle->user->name }} {{ $pedidoDetalle->user->apellido }}</p>
                        <p><span class="font-medium">Email:</span> {{ $pedidoDetalle->user->email }}</p>
                        <p><span class="font-medium">Teléfono:</span> {{ $pedidoDetalle->user->telefono ?? 'No especificado' }}</p>
                    </div>
                </div>

                <!-- Información de Envío -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-3">Dirección de Envío</h4>
                    <div class="space-y-2">
                        <p>{{ $pedidoDetalle->address->calle }} {{ $pedidoDetalle->address->numero_piso }}</p>
                        <p>{{ $pedidoDetalle->address->distrito }}, {{ $pedidoDetalle->address->provincia }}</p>
                        <p>{{ $pedidoDetalle->address->departamento }}</p>
                        @if($pedidoDetalle->address->referencia)
                            <p><span class="font-medium">Referencia:</span> {{ $pedidoDetalle->address->referencia }}</p>
                        @endif
                    </div>
                </div>

                <!-- Información del Pedido -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-3">Información del Pedido</h4>
                    <div class="space-y-2">
                        <p><span class="font-medium">Fecha:</span> {{ \Carbon\Carbon::parse($pedidoDetalle->created_at)->format('d/m/Y H:i') }}</p>
                        <p><span class="font-medium">Estado:</span>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $pedidoDetalle->estado == 1 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $pedidoDetalle->estado == 1 ? 'Completado' : 'Pendiente' }}
                            </span>
                        </p>
                        <p><span class="font-medium">Método de Pago:</span> {{ $pedidoDetalle->paymentType->nombre }}</p>
                        <p><span class="font-medium">Tipo de Envío:</span> {{ $pedidoDetalle->shipmentType->nombre }}</p>
                    </div>
                </div>

                <!-- Resumen de Costos -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-3">Resumen de Costos</h4>
                    <div class="space-y-2">
                        <p><span class="font-medium">Total:</span> <span class="text-lg font-bold text-green-600">S/ {{ number_format($pedidoDetalle->total, 2) }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Productos del Pedido -->
            <div class="mt-6">
                <h4 class="font-semibold text-gray-800 mb-3">Productos del Pedido</h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded object-cover" src="{{ $edition->url_portada }}" alt="Portada">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $edition->book->titulo }}</div>
                                            <div class="text-sm text-gray-500">{{ $edition->numero_edicion }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $edition->editorial->nombre }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $edition->pivot->cantidad }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">S/ {{ number_format($edition->precio, 2) }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">S/ {{ number_format($edition->precio * $edition->pivot->cantidad, 2) }}</td>
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
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
            <h3 class="text-lg font-semibold mb-4">Confirmar Eliminación</h3>
            @if($eliminacionmode === 'unico')
            <p class="mb-6">¿Estás seguro de eliminar este pedido? Esta acción no se puede deshacer.</p>
            <div class="flex justify-end space-x-4">
                <button wire:click="cancelarEliminacion"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition-colors">
                    Cancelar
                </button>
                <button wire:click="eliminarPedido"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                    Eliminar
                </button>
            </div>
            @else
            <p class="mb-6">¿Estás seguro de eliminar estos {{ count($selectedPedidos) }} pedidos? Esta acción no se puede deshacer.</p>
            <div class="flex justify-end space-x-4">
                <button wire:click="cancelarEliminacion"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition-colors">
                    Cancelar
                </button>
                <button wire:click="eliminarPedidosSeleccionados"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
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
    x-transition
    class="fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center z-50 pt-4"
    @click.self="$wire.cerrarNotificacion()">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full mx-4 border-l-4 {{ $notificationType === 'success' ? 'border-green-500' : ($notificationType === 'error' ? 'border-red-500' : 'border-yellow-500') }}"
             @mouseenter="resetTimer" @click.stop>
            <div class="flex items-center justify-center mb-4">
                @if($notificationType === 'success')
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                @elseif($notificationType === 'error')
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                @else
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                @endif
            </div>
            <h3 class="text-lg font-semibold text-center text-gray-800 mb-2">
                @if($notificationType === 'success')
                    ¡Éxito!
                @elseif($notificationType === 'error')
                    Error
                @else
                    Atención
                @endif
            </h3>
            <p class="text-center text-gray-600">{{ $notificationMessage }}</p>

            <!-- Botón para cerrar manual -->
            <button wire:click="cerrarNotificacion" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    @endif
</div>
