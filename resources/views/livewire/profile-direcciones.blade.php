<div class="min-h-screen bg-gradient-to-br from-indigo-50 pt-20 via-white to-purple-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">MI PERFIL</h1>
                    <p class="mt-1 text-sm text-gray-600">
                        @if($showForm)
                            {{ $editingAddress ? 'Editar dirección' : 'Nueva dirección' }}
                        @else
                            Mis Direcciones
                        @endif
                    </p>
                </div>
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('profile.dashboard') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                        ← Volver
                    </a>
                    @if(auth()->user()->hasAnyRole(['superadministrador', 'administrador', 'colaborador']))
                        <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                            ← Volver al Dashboard
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Navegación de Secciones -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Mis Direcciones</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <!-- Mi Cuenta -->
                <a href="{{ route('profile.dashboard') }}"
                   class="flex flex-col items-center p-4 bg-gray-50 border-2 border-gray-200 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Mi Cuenta</span>
                </a>

                <!-- Mis Datos -->
                <a href="{{ route('profile.datos') }}"
                   class="flex flex-col items-center p-4 bg-gray-50 border-2 border-gray-200 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Mis Datos</span>
                </a>

                <!-- Mis Pedidos -->
                <a href="{{ route('profile.pedidos') }}"
                   class="flex flex-col items-center p-4 bg-gray-50 border-2 border-gray-200 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Mis Pedidos</span>
                </a>

                <!-- Mis Direcciones - Activo -->
                <a href="{{ route('profile.direcciones') }}"
                   class="flex flex-col items-center p-4 bg-indigo-50 border-2 border-indigo-200 rounded-lg hover:bg-indigo-100 transition-colors duration-200">
                    <svg class="w-8 h-8 text-indigo-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-sm font-medium text-indigo-900">Mis Direcciones</span>
                </a>

                <!-- Mi Lista de Deseos -->
               <a href="{{ route('profile.deseos') }}"
                   class="flex flex-col items-center p-4 bg-gray-50 border-2 border-gray-200 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Lista de Deseos</span>
                </a>
            </div>
        </div>

        <!-- Notificación Global -->
        @if($showNotification)
            <div class="fixed top-20 left-1/2 transform -translate-x-1/2 z-50 mb-6 p-4 rounded-lg shadow-lg {{ $notificationType === 'success' ? 'bg-green-50 border border-green-200 text-green-800' : 'bg-red-50 border border-red-200 text-red-800' }}">
                <div class="flex items-center">
                    @if($notificationType === 'success')
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    @else
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    @endif
                    {{ $notificationMessage }}
                </div>
            </div>
        @endif

        @if(!$showForm)
            <!-- Vista de Lista de Direcciones -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">Mis Direcciones Guardadas</h3>
                    <button wire:click="toggleForm"
                        class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Nueva Dirección</span>
                    </button>
                </div>

                @if($addresses->count() > 0)
                    <!-- Direcciones Existentes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($addresses as $address)
                            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-start justify-between mb-4">
                                    <h4 class="text-lg font-medium text-gray-900">
                                        {{ $address->referencia ?: 'Dirección ' . $loop->iteration }}
                                    </h4>
                                    <div class="flex space-x-2">
                                        <button wire:click="editAddress({{ $address->id }})"
                                            class="text-indigo-600 hover:text-indigo-800 transition-colors duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button wire:click="deleteAddress({{ $address->id }})"
                                            onclick="return confirm('¿Estás seguro de eliminar esta dirección?')"
                                            class="text-red-600 hover:text-red-800 transition-colors duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="space-y-2 text-sm text-gray-600">
                                    <p><strong>Calle:</strong> {{ $address->calle }}</p>
                                    @if($address->numero_piso)
                                        <p><strong>Número/Piso:</strong> {{ $address->numero_piso }}</p>
                                    @endif
                                    @if($address->numero_departamento)
                                        <p><strong>Departamento:</strong> {{ $address->numero_departamento }}</p>
                                    @endif
                                    <p><strong>Distrito:</strong> {{ $address->distrito }}</p>
                                    <p><strong>Provincia:</strong> {{ $address->provincia }}</p>
                                    <p><strong>Departamento:</strong> {{ $address->departamento }}</p>
                                    @if($address->referencia)
                                        <p><strong>Referencia:</strong> {{ $address->referencia }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Estado Vacío -->
                    <div class="text-center py-12">
                        <div class="mx-auto w-24 h-24 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No tienes direcciones guardadas</h3>
                        <p class="text-gray-600 mb-6">Agrega tu primera dirección de envío para facilitar tus compras futuras.</p>
                        <button wire:click="toggleForm"
                            class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Agregar Primera Dirección
                        </button>
                    </div>
                @endif
            </div>
        @else
            <!-- Formulario de Nueva/Editar Dirección -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-semibold text-gray-900">
                        {{ $editingAddress ? 'Editar Dirección' : 'Nueva dirección' }}
                    </h3>
                    <button wire:click="toggleForm"
                        class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form wire:submit="saveAddress" class="space-y-6">
                    <!-- Información Personal -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nombre -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                            <input wire:model="name" type="text" id="name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Apellidos -->
                        <div>
                            <label for="apellido" class="block text-sm font-medium text-gray-700 mb-2">Apellidos</label>
                            <input wire:model="apellido" type="text" id="apellido" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                            @error('apellido') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Número de teléfono -->
                        <div>
                            <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">Número de teléfono</label>
                            <input wire:model="telefono" type="tel" id="telefono" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                            @error('telefono') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Tipo de Documento -->
                        <div>
                            <label for="documento_tipo" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Documento</label>
                            <select wire:model="documento_tipo" id="documento_tipo"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed">
                                <option value="DNI">DNI</option>
                            </select>
                        </div>

                        <!-- N° De Documento -->
                        <div class="md:col-span-2">
                            <label for="numero_documento" class="block text-sm font-medium text-gray-700 mb-2">N° De Documento</label>
                            <div class="max-w-md">
                                <input wire:model="numero_documento" type="text" id="numero_documento" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                                @error('numero_documento') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Separador -->
                    <div class="border-t border-gray-200 my-8"></div>

                    <!-- Información de Dirección -->
                    <div class="space-y-6">
                        <!-- Calle -->
                        <div>
                            <label for="calle" class="block text-sm font-medium text-gray-700 mb-2">Calle</label>
                            <input wire:model="calle" type="text" id="calle" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                            @error('calle') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Número y Piso/Dpto -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="numero_piso" class="block text-sm font-medium text-gray-700 mb-2">Número</label>
                                <input wire:model="numero_piso" type="text" id="numero_piso"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                                @error('numero_piso') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="numero_departamento" class="block text-sm font-medium text-gray-700 mb-2">Piso/Dpto</label>
                                <input wire:model="numero_departamento" type="text" id="numero_departamento"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                                @error('numero_departamento') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Referencia -->
                        <div>
                            <label for="referencia" class="block text-sm font-medium text-gray-700 mb-2">Referencia</label>
                            <textarea wire:model="referencia" id="referencia" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200"
                                placeholder="Ej: Casa blanca con portón negro, al lado de la farmacia..."></textarea>
                            @error('referencia') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Ubicación -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="provincia" class="block text-sm font-medium text-gray-700 mb-2">Provincia</label>
                                <input wire:model="provincia" type="text" id="provincia" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                                @error('provincia') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="distrito" class="block text-sm font-medium text-gray-700 mb-2">Distrito</label>
                                <input wire:model="distrito" type="text" id="distrito" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                                @error('distrito') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="departamento" class="block text-sm font-medium text-gray-700 mb-2">Departamento</label>
                            <div class="max-w-md">
                                <input wire:model="departamento" type="text" id="departamento" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                                @error('departamento') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-center space-x-4 pt-8">
                        <button type="submit"
                            class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 disabled:bg-gray-400 text-white font-medium rounded-lg transition-colors duration-200 flex items-center space-x-2"
                            wire:loading.attr="disabled" wire:target="saveAddress">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" wire:loading.remove wire:target="saveAddress">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24" wire:loading wire:target="saveAddress">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span wire:loading.remove wire:target="saveAddress">Guardar</span>
                            <span wire:loading wire:target="saveAddress">Guardando...</span>
                        </button>

                        <button type="button" wire:click="toggleForm"
                            class="px-8 py-3 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg transition-colors duration-200">
                            Volver
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>

<script>
    // Auto-hide notifications after 5 seconds
    document.addEventListener('livewire:init', () => {
        Livewire.on('notify', (data) => {
            setTimeout(() => {
                @this.set('showNotification', false);
            }, 5000);
        });
    });
</script>
