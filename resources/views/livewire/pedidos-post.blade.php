{{--
    VISTA DE GESTIÓN DE PEDIDOS
    ---------------------------
    - Interfaz moderna para gestión completa de pedidos
    - Filtros avanzados por estado, fecha, usuario, etc.
    - Vista detallada de pedidos
    - Gestión de estados en tiempo real
--}}
<div>
    <h1 class="pt-5"></h1>
    <x-section-title title="GESTIÓN DE PEDIDOS" />

    <div class="mx-10">
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <div class="bg-primary-25 p-4 rounded-lg">
                
                {{-- BARRA DE BÚSQUEDA Y FILTROS --}}
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <div class="flex flex-wrap items-center gap-4 flex-1">
                        {{-- Búsqueda --}}
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input wire:model.live.debounce.300ms="search" type="text"
                                class="bg-white border shadow-md border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 pl-10 p-2"
                                placeholder="Buscar por ID, cliente...">
                        </div>

                        {{-- Filtro de Estado --}}
                        <select wire:model.live="statusFilter" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
                            <option value="">Todos los estados</option>
                            <option value="0">Pendiente</option>
                            <option value="1">Completado</option>
                        </select>

                        {{-- Filtro de Fecha --}}
                        <select wire:model.live="dateFilter" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
                            <option value="">Todas las fechas</option>
                            <option value="today">Hoy</option>
                            <option value="week">Última semana</option>
                            <option value="month">Último mes</option>
                            <option value="year">Último año</option>
                        </select>

                        {{-- Filtro de Usuario --}}
                        <select wire:model.live="userFilter" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
                            <option value="">Todos los usuarios</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apellido }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Botón de Nuevo Pedido --}}
                    <div class="flex items-center gap-2">
                        <button wire:click="$set('showCreateModal', true)"
                            class="px-4 py-2 flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            <span>Nuevo Pedido</span>
                        </button>
                    </div>
                </div>

                {{-- TABLA DE PEDIDOS --}}
                @if($pedidos->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="p-4">
                                    <input type="checkbox" wire:model.live="selectAll" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                </th>
                                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('id')">
                                    ID @if($sort === 'id')<span>{{ $direction === 'asc' ? '▲' : '▼' }}</span>@endif
                                </th>
                                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('created_at')">
                                    Fecha @if($sort === 'created_at')<span>{{ $direction === 'asc' ? '▲' : '▼' }}</span>@endif
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
                            <tr class="bg-white border-b hover:bg-gray-50" wire:key="{{ $pedido->id }}">
                                <td class="w-4 p-4">
                                    <input type="checkbox" wire:model.live="selectedPedidos" value="{{ $pedido->id }}" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">#{{ $pedido->id }}</td>
                                <td class="px-6 py-4 text-gray-500">
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
                                <td class="px-6 py-4 font-semibold text-gray-900">${{ number_format($pedido->total, 2) }}</td>
                                <td class="px-6 py-4">
                                    <select wire:change="cambiarEstado({{ $pedido->id }}, $event.target.value)" 
                                            class="px-2 py-1 text-xs font-semibold rounded-full border-0
                                            {{ $pedido->estado == 1 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        <option value="0" {{ $pedido->estado == 0 ? 'selected' : '' }}>Pendiente</option>
                                        <option value="1" {{ $pedido->estado == 1 ? 'selected' : '' }}>Completado</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-600">{{ $pedido->paymentType->nombre }}</td>
                                <td class="px-6 py-4 text-xs text-gray-600">{{ $pedido->shipmentType->nombre }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button wire:click="verDetalle({{ $pedido->id }})" 
                                                class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-transform hover:scale-110" 
                                                title="Ver detalle">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                        <button wire:click="editarPedido({{ $pedido->id }})" 
                                                class="p-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-transform hover:scale-110" 
                                                title="Editar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button wire:click="confirmarEliminacion({{ $pedido->id }})" 
                                                class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-transform hover:scale-110" 
                                                title="Eliminar">
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

                {{-- CONTROLES INFERIORES --}}
                <div class="flex justify-between items-center mt-4">
                    {{-- Botón Eliminar Múltiple --}}
                    <div>
                        <button wire:click="eliminarshowmodal"
                            class="px-4 py-2 flex items-center justify-center font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 border-2 {{ count($selectedPedidos) >= 2 ? 'bg-red-500 hover:bg-red-600 text-white border-red-500 cursor-pointer' : 'bg-gray-300 text-gray-500 border-gray-300 cursor-not-allowed opacity-60' }}"
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
                <div class="p-8 text-center text-gray-500 bg-gray-50 rounded-lg">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-lg font-medium">No se encontraron pedidos</p>
                    <p class="text-sm">No hay pedidos que coincidan con los filtros aplicados.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ================================================================== --}}
    {{-- ======================= MODALES ======================= --}}
    {{-- ================================================================== --}}

    {{-- MODAL DE DETALLE DEL PEDIDO --}}
    @if($showDetailModal && $pedidoDetalle)
    <div class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto" @click.away="$set('showDetailModal', false)">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Detalle del Pedido #{{ $pedidoDetalle->id }}</h3>
                <button wire:click="$set('showDetailModal', false)" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Información del Cliente --}}
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-3">Información del Cliente</h4>
                    <div class="space-y-2">
                        <p><span class="font-medium">Nombre:</span> {{ $pedidoDetalle->user->name }} {{ $pedidoDetalle->user->apellido }}</p>
                        <p><span class="font-medium">Email:</span> {{ $pedidoDetalle->user->email }}</p>
                        <p><span class="font-medium">Teléfono:</span> {{ $pedidoDetalle->user->telefono ?? 'No especificado' }}</p>
                    </div>
                </div>

                {{-- Información de Envío --}}
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

                {{-- Información del Pedido --}}
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

                {{-- Resumen de Costos --}}
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-3">Resumen de Costos</h4>
                    <div class="space-y-2">
                        <p><span class="font-medium">Total:</span> <span class="text-lg font-bold text-green-600">${{ number_format($pedidoDetalle->total, 2) }}</span></p>
                    </div>
                </div>
            </div>

            {{-- Productos del Pedido --}}
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
                                <td class="px-6 py-4 text-sm text-gray-900">${{ number_format($edition->precio, 2) }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">${{ number_format($edition->precio * $edition->pivot->cantidad, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- MODAL PARA EDITAR PEDIDO --}}
    @if($showEditModal)
    <div class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto" @click.away="$set('showEditModal', false)">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Editar Pedido</h3>
                <button wire:click="$set('showEditModal', false)" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <form wire:submit.prevent="guardarPedido" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Cliente *</label>
                        <select wire:model.defer="pedidoEditado.user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Seleccionar cliente</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apellido }}</option>
                            @endforeach
                        </select>
                        @error('pedidoEditado.user_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fecha de Orden *</label>
                        <input type="date" wire:model.defer="pedidoEditado.fecha_orden" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('pedidoEditado.fecha_orden') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Método de Pago *</label>
                        <select wire:model.defer="pedidoEditado.payment_type_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Seleccionar método</option>
                            @foreach($paymentTypes as $paymentType)
                                <option value="{{ $paymentType->id }}">{{ $paymentType->nombre }}</option>
                            @endforeach
                        </select>
                        @error('pedidoEditado.payment_type_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipo de Envío *</label>
                        <select wire:model.defer="pedidoEditado.shipment_type_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Seleccionar tipo</option>
                            @foreach($shipmentTypes as $shipmentType)
                                <option value="{{ $shipmentType->id }}">{{ $shipmentType->nombre }}</option>
                            @endforeach
                        </select>
                        @error('pedidoEditado.shipment_type_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Estado *</label>
                        <select wire:model.defer="pedidoEditado.estado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="0">Pendiente</option>
                            <option value="1">Completado</option>
                        </select>
                        @error('pedidoEditado.estado') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Total *</label>
                        <input type="number" step="0.01" wire:model.defer="pedidoEditado.total" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('pedidoEditado.total') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" wire:click="$set('showEditModal', false)" class="px-4 py-2 bg-gray-300 rounded-md">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Actualizar Pedido</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- MODAL DE CONFIRMACIÓN DE ELIMINACIÓN --}}
    @if($showDeleteModal)
    <div class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full" @click.away="$set('showDeleteModal', false)">
            <h3 class="text-lg font-semibold mb-4 text-center">Confirmar Eliminación</h3>
            @if($eliminacionmode === 'unico')
            <p class="mb-6 text-center">¿Seguro que quieres eliminar este pedido?<br>Esta acción no se puede deshacer.</p>
            @else
            <p class="mb-6 text-center">¿Seguro que quieres eliminar los <b>{{ count($selectedPedidos) }}</b> pedidos seleccionados?<br>Esta acción no se puede deshacer.</p>
            @endif
            <div class="flex justify-center space-x-4">
                <button wire:click="cancelarEliminacion" class="px-4 py-2 bg-gray-300 rounded-md">Cancelar</button>
                <button wire:click="{{ $eliminacionmode === 'unico' ? 'eliminarPedido' : 'eliminarPedidosSeleccionados' }}" class="px-4 py-2 bg-red-500 text-white rounded-md">Eliminar</button>
            </div>
        </div>
    </div>
    @endif

    {{-- NOTIFICACIÓN --}}
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
