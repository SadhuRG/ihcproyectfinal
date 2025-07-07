<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <!-- Botón para abrir modal de soporte -->
    <button wire:click="abrirModal" 
        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        Contactar Soporte
    </button>

    <!-- Mostrar ticket activo si existe -->
    @if($ticketActivo)
    <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-700 rounded-lg">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                    Ticket de Soporte Activo
                </h3>
                <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                    <p><strong>Asunto:</strong> {{ $ticketActivo->asunto }}</p>
                    <p><strong>Estado:</strong> 
                        @if($ticketActivo->estado === 'enviado')
                            <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200 rounded-full text-xs font-medium">
                                Enviado
                            </span>
                        @elseif($ticketActivo->estado === 'recibido')
                            <span class="px-2 py-1 bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 rounded-full text-xs font-medium">
                                Recibido
                            </span>
                        @else
                            <span class="px-2 py-1 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 rounded-full text-xs font-medium">
                                Solucionado
                            </span>
                        @endif
                    </p>
                    <p><strong>Fecha:</strong> {{ $ticketActivo->created_at->format('d/m/Y H:i') }}</p>
                    
                    @if($ticketActivo->mensaje_admin)
                    <div class="mt-3 p-3 bg-white dark:bg-gray-800 rounded border">
                        <p class="text-sm font-medium text-gray-900 dark:text-white mb-2">Respuesta del Administrador:</p>
                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $ticketActivo->mensaje_admin }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- MODAL CREAR TICKET -->
    @if($showCreateModal)
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Header del Modal -->
            <div class="flex justify-between items-center p-6 border-b border-gray-200 dark:border-gray-700">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Contactar Soporte</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Envía tu consulta y te responderemos pronto</p>
                </div>
                <button wire:click="cerrarModal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Formulario -->
            <form wire:submit.prevent="enviarTicket" class="p-6">
                <div class="space-y-6">
                    <!-- Campo Asunto -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Asunto *
                        </label>
                        <input type="text" wire:model="asunto" 
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Describe brevemente tu problema o consulta">
                        @error('asunto') 
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Campo Mensaje -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Mensaje *
                            <span class="text-xs text-gray-500 font-normal">(Máximo 500 palabras)</span>
                        </label>
                        <textarea wire:model="mensaje" rows="6" 
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                            placeholder="Describe detalladamente tu problema o consulta..."></textarea>
                        
                        <!-- Contador de palabras -->
                        <div class="mt-2 flex justify-between items-center text-xs">
                            <span class="text-gray-500 dark:text-gray-400">
                                Palabras: {{ $this->getContadorPalabras() }}/500
                            </span>
                            <span class="text-blue-600 dark:text-blue-400 font-medium">
                                {{ $this->getContadorPalabras() > 450 ? 'Casi al límite' : 'Espacio disponible' }}
                            </span>
                        </div>
                        @error('mensaje') 
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" wire:click="cerrarModal" 
                        class="px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all font-medium">
                        Cancelar
                    </button>
                    <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-medium transition-all transform hover:scale-105 shadow-lg">
                        Enviar Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- MODAL ESTADO DEL TICKET -->
    @if($showTicketStatus && $ticketActivo)
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-2xl w-full">
            <!-- Header del Modal -->
            <div class="flex justify-between items-center p-6 border-b border-gray-200 dark:border-gray-700">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Estado de tu Ticket</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Información sobre tu consulta de soporte</p>
                </div>
                <button wire:click="cerrarTicketStatus" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Contenido del Estado -->
            <div class="p-6">
                <div class="space-y-6">
                    <!-- Información del Ticket -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-gray-900 dark:text-white">Ticket #{{ $ticketActivo->id }}</h4>
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($this->getEstadoColor() === 'yellow') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                @elseif($this->getEstadoColor() === 'blue') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                @elseif($this->getEstadoColor() === 'green') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 @endif">
                                {{ $this->getEstadoTexto() }}
                            </span>
                        </div>
                        
                        <div class="space-y-3">
                            <div>
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Asunto:</span>
                                <p class="text-gray-900 dark:text-white">{{ $ticketActivo->asunto }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Fecha de envío:</span>
                                <p class="text-gray-900 dark:text-white">{{ $ticketActivo->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tu Mensaje -->
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Tu Mensaje
                        </h4>
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 p-4 rounded-xl border-2 border-blue-200 dark:border-blue-700">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $ticketActivo->mensaje_usuario }}</p>
                        </div>
                    </div>

                    <!-- Respuesta del Administrador (si existe) -->
                    @if($ticketActivo->mensaje_admin)
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Respuesta del Administrador
                        </h4>
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 p-4 rounded-xl border-2 border-green-200 dark:border-green-700">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $ticketActivo->mensaje_admin }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Información Adicional -->
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-xl border border-yellow-200 dark:border-yellow-700">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h5 class="font-medium text-yellow-800 dark:text-yellow-200 mb-1">Información Importante</h5>
                                <p class="text-sm text-yellow-700 dark:text-yellow-300">
                                    @if($ticketActivo->estado === 'solucionado')
                                        Tu ticket ha sido solucionado. Si necesitas más ayuda, puedes crear un nuevo ticket.
                                    @else
                                        Tu ticket está siendo procesado. No puedes crear otro ticket hasta que este sea solucionado.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botón de Cerrar -->
                <div class="flex justify-end mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button wire:click="cerrarTicketStatus" 
                        class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-xl font-medium transition-all">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- NOTIFICACIÓN -->
    @if($showNotification)
    <div class="fixed top-4 right-4 z-50">
        <div class="bg-white dark:bg-gray-800 border-l-4 {{ $notificationType === 'success' ? 'border-green-500' : ($notificationType === 'error' ? 'border-red-500' : 'border-yellow-500') }} p-4 rounded-lg shadow-lg max-w-sm">
            <div class="flex items-start">
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
                <div class="ml-3 flex-1">
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
