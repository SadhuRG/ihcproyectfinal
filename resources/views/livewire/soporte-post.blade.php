<div>
    <x-section-title title="SOPORTE DE USUARIO" />

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
                            placeholder="Buscar por asunto, mensaje, usuario...">
                    </div>

                    <!-- Filtro de Estado -->
                    <div class="flex items-center gap-2">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Estado:</label>
                        <select wire:model.live="statusFilter" class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                            <option value="">Todos</option>
                            <option value="enviado">Enviado</option>
                            <option value="recibido">Recibido</option>
                            <option value="solucionado">Solucionado</option>
                        </select>
                    </div>
                </div>

                @if($tickets->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-600">
                            <tr>
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

                                <th class="px-6 py-3">Usuario</th>
                                <th class="px-6 py-3">Asunto</th>
                                <th class="px-6 py-3">Estado</th>
                                <th class="px-6 py-3">Fecha</th>
                                <th class="px-6 py-3">Respuesta</th>
                                <th class="px-6 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                            <tr class="bg-white dark:bg-gray-700 border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-400 dark:text-gray-500 whitespace-nowrap">
                                    {{ $ticket->id }}
                                </th>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-900 dark:text-white">{{ $ticket->user->name }} {{ $ticket->user->apellido }}</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $ticket->user->email }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $ticket->asunto }}</span>
                                </td>

                                <td class="px-6 py-4">
                                    @if($ticket->estado === 'enviado')
                                        <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200 rounded-full text-xs font-medium">
                                            Enviado
                                        </span>
                                    @elseif($ticket->estado === 'recibido')
                                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 rounded-full text-xs font-medium">
                                            Recibido
                                        </span>
                                    @else
                                        <span class="px-2 py-1 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 rounded-full text-xs font-medium">
                                            Solucionado
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-gray-900 dark:text-gray-300">
                                    {{ $ticket->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($ticket->mensaje_admin)
                                        <span class="text-green-600 dark:text-green-400 text-sm">✓ Respondido</span>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500 text-sm">Sin respuesta</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center w-32">
                                    <div class="flex items-center justify-center space-x-3">
                                        <button wire:click="responderTicket({{ $ticket->id }})"
                                            class="p-2 bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 rounded-lg hover:scale-110 transition-transform w-10 h-10 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
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
                        No se encontraron tickets de soporte que coincidan con la búsqueda
                    </h1>
                </div>
                @endif
            </div>

            <!-- CONTROLES DE PAGINACIÓN -->
            <div class="flex justify-between mt-3 gap-8 items-center">
                <!-- Paginación -->
                <div class="flex items-center space-x-4">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL RESPONDER TICKET -->
    @if($showResponseModal && $ticketSeleccionado)
    <div class="fixed inset-0 bg-black/50 flex items-start justify-center z-50 pt-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Responder Ticket #{{ $ticketSeleccionado['id'] }}</h3>
                <button wire:click="cerrarModal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Información del ticket -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h4 class="font-medium text-gray-900 dark:text-white mb-2">Información del Usuario</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <strong>Nombre:</strong> {{ $ticketSeleccionado['user']['name'] }} {{ $ticketSeleccionado['user']['apellido'] }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <strong>Email:</strong> {{ $ticketSeleccionado['user']['email'] }}
                        </p>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900 dark:text-white mb-2">Información del Ticket</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <strong>Asunto:</strong> {{ $ticketSeleccionado['asunto'] }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($ticketSeleccionado['created_at'])->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Mensaje del usuario -->
            <div class="mb-4">
                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Mensaje del Usuario</h4>
                <div class="bg-blue-50 dark:bg-blue-900/30 p-3 rounded-lg border border-blue-200 dark:border-blue-700">
                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ $ticketSeleccionado['mensaje_usuario'] }}</p>
                </div>
            </div>

            <form wire:submit.prevent="guardarRespuesta">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Estado</label>
                        <select wire:model="nuevoEstado" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="enviado">Enviado</option>
                            <option value="recibido">Recibido</option>
                            <option value="solucionado">Solucionado</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Respuesta del Administrador
                            <span class="text-xs text-gray-500">(Máximo 500 palabras)</span>
                        </label>
                        <textarea wire:model="mensajeAdmin" rows="6" 
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            placeholder="Escribe tu respuesta aquí..."></textarea>
                        
                        <!-- Contador de palabras -->
                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                            Palabras: {{ $this->getContadorPalabras() }}/500
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" wire:click="cerrarModal" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">
                        Guardar Respuesta
                    </button>
                </div>
            </form>
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
