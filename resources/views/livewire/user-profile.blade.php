<div class="min-h-screen bg-gradient-to-br from-indigo-50 pt-2 via-white to-purple-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Mi Perfil</h1>
                    <p class="mt-1 text-sm text-gray-600">Gestiona tu información personal y configuración de cuenta</p>
                </div>
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('welcome') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                        ← Volver al inicio
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
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Navegación Rápida</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <!-- Mi Cuenta -->
                <a href="{{ route('profile.dashboard') }}"
                class="flex flex-col items-center p-4 rounded-lg border-2 transition-colors duration-200
                {{ request()->routeIs('profile.dashboard') ? 'bg-indigo-50 border-indigo-200 text-indigo-900' : 'bg-gray-50 border-gray-200 text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-8 h-8 mb-2 {{ request()->routeIs('profile.dashboard') ? 'text-indigo-600' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-sm font-medium">Mi Cuenta</span>
                </a>

                <!-- Mis Datos -->
                <a href="{{ route('profile.datos') }}"
                class="flex flex-col items-center p-4 rounded-lg border-2 transition-colors duration-200
                {{ request()->routeIs('profile.datos') ? 'bg-indigo-50 border-indigo-200 text-indigo-900' : 'bg-gray-50 border-gray-200 text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-8 h-8 mb-2 {{ request()->routeIs('profile.datos') ? 'text-indigo-600' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span class="text-sm font-medium">Mis Datos</span>
                </a>

                <!-- Mis Pedidos -->
                <a href="{{ route('profile.pedidos') }}"
                class="flex flex-col items-center p-4 rounded-lg border-2 transition-colors duration-200
                {{ request()->routeIs('profile.pedidos') ? 'bg-indigo-50 border-indigo-200 text-indigo-900' : 'bg-gray-50 border-gray-200 text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-8 h-8 mb-2 {{ request()->routeIs('profile.pedidos') ? 'text-indigo-600' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="text-sm font-medium">Mis Pedidos</span>
                </a>

                <!-- Mis Direcciones -->
                <a href="{{ route('profile.direcciones') }}"
                class="flex flex-col items-center p-4 rounded-lg border-2 transition-colors duration-200
                {{ request()->routeIs('profile.direcciones') ? 'bg-indigo-50 border-indigo-200 text-indigo-900' : 'bg-gray-50 border-gray-200 text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-8 h-8 mb-2 {{ request()->routeIs('profile.direcciones') ? 'text-indigo-600' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-sm font-medium">Mis Direcciones</span>
                </a>

                <!-- Mi Lista de Deseos -->
                <a href="{{ route('profile.deseos') }}"
                class="flex flex-col items-center p-4 rounded-lg border-2 transition-colors duration-200
                {{ request()->routeIs('profile.deseos') ? 'bg-indigo-50 border-indigo-200 text-indigo-900' : 'bg-gray-50 border-gray-200 text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-8 h-8 mb-2 {{ request()->routeIs('profile.deseos') ? 'text-indigo-600' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span class="text-sm font-medium">Lista de Deseos</span>
                </a>
            </div>
        </div>
    </div>



    <!-- Contenido Principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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

        <div class="grid grid-cols-1">
            <div class="space-y-6">
                <!-- Información Personal -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Información Personal</h2>
                            <p class="text-sm text-gray-500 mt-1">Actualiza tu información personal. El email no se puede modificar por seguridad.</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>

                    <form wire:submit="updateProfile" class="space-y-6">
                        <!-- Foto de Perfil -->
                        <div class="flex items-center space-x-6">
                            <div class="relative">
                                @if($currentPhoto || $photo)
                                    <label for="photo" class="cursor-pointer block">
                                        <img src="{{ $photo ? $photo->temporaryUrl() : $currentPhoto }}" alt="Foto de perfil" class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg hover:opacity-80 transition-opacity duration-200">
                                    </label>
                                @else
                                    <label for="photo" class="cursor-pointer block">
                                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:opacity-80 transition-opacity duration-200">
                                            {{ substr($name ?: 'U', 0, 1) }}{{ substr($apellido ?: 'U', 0, 1) }}
                                        </div>
                                    </label>
                                @endif

                                <!-- Botón de eliminar (solo cuando hay foto) -->
                                @if($currentPhoto || $photo)
                                    <div class="absolute -bottom-1 -right-1">
                                        <button wire:click="removePhoto" type="button" class="bg-white p-1 rounded-full shadow-lg transition-colors duration-200 hover:bg-gray-50" title="Restaurar foto por defecto">
                                            <svg class="w-6 h-6 text-red-500 hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                @endif

                                <input wire:model="photo" type="file" id="photo" class="hidden" accept="image/*">
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">{{ $name }} {{ $apellido }}</h3>
                                <p class="text-sm text-gray-600">{{ $email }}</p>
                                @if($telefono)
                                    <p class="text-sm text-gray-600">{{ $telefono }}</p>
                                @endif
                            </div>
                        </div>

                        @if($photo)
                            <div class="p-3 bg-blue-50 rounded-lg">
                                <p class="text-sm text-blue-700">Nueva foto seleccionada: {{ $photo->getClientOriginalName() }}</p>
                            </div>
                        @endif

                        <!-- Campos del formulario -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nombre -->
                            <div class="col-span-1">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                                <input wire:model="name" type="text" id="name" value="{{ $name }}" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Apellido -->
                            <div class="col-span-1">
                                <label for="apellido" class="block text-sm font-medium text-gray-700 mb-2">Apellido</label>
                                <input wire:model="apellido" type="text" id="apellido" value="{{ $apellido }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                                @error('apellido') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email (Bloqueado) -->
                            <div class="col-span-full md:col-span-1">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Correo Electrónico *
                                    <span class="text-xs text-gray-500">(No se puede modificar)</span>
                                </label>
                                <div class="relative">
                                    <input type="email" id="email" value="{{ $email }}" disabled
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed transition-colors duration-200">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Para cambiar tu email, contacta al administrador</p>
                            </div>

                            <!-- Teléfono -->
                            <div class="col-span-1">
                                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                                <input wire:model="telefono" type="tel" id="telefono" value="{{ $telefono }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                                @error('telefono') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Fecha de Nacimiento -->
                            <div class="col-span-full">
                                <label for="fecha_n" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Nacimiento</label>
                                <div class="max-w-xs">
                                    <input wire:model="fecha_n" type="date" id="fecha_n" value="{{ $fecha_n }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                                    @error('fecha_n') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Botón de actualizar -->
                        <div class="flex justify-end pt-4 space-x-4">
                            <a href="{{ route('profile.dashboard') }}"
                            class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg transition-colors duration-200 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span>Cancelar</span>
                            </a>
                            <button type="submit"
                                class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 disabled:bg-gray-400 text-white font-medium rounded-lg transition-colors duration-200 flex items-center space-x-2"
                                wire:loading.attr="disabled" wire:target="updateProfile">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" wire:loading.remove wire:target="updateProfile">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24" wire:loading wire:target="updateProfile">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span wire:loading.remove wire:target="updateProfile">Actualizar Perfil</span>
                                <span wire:loading wire:target="updateProfile">Actualizando...</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Cambio de Contraseña -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Cambiar Contraseña</h2>
                        <button wire:click="togglePasswordFields"
                            class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">
                            {{ $showPasswordFields ? 'Cancelar' : 'Cambiar Contraseña' }}
                        </button>
                    </div>

                    @if($showPasswordFields)
                        <form wire:submit="updatePassword" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Contraseña Actual -->
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña Actual *</label>
                                    <input wire:model="current_password" type="password" id="current_password" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                                    @error('current_password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Nueva Contraseña -->
                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">Nueva Contraseña *</label>
                                    <input wire:model="new_password" type="password" id="new_password" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                                    @error('new_password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Confirmar Nueva Contraseña -->
                                <div class="md:col-span-2">
                                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">Confirmar Nueva Contraseña *</label>
                                    <input wire:model="confirm_password" type="password" id="confirm_password" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors duration-200">
                                    @error('confirm_password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Botón de actualizar contraseña -->
                            <div class="flex justify-end pt-4 space-x-4">
                                <a href="{{ route('profile.dashboard') }}"
                                class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg transition-colors duration-200 flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    <span>Cancelar</span>
                                </a>

                                <button type="submit"
                                    class="px-6 py-3 bg-green-600 hover:bg-green-700 disabled:bg-gray-400 text-white font-medium rounded-lg transition-colors duration-200 flex items-center space-x-2"
                                    wire:loading.attr="disabled" wire:target="updatePassword">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" wire:loading.remove wire:target="updatePassword">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24" wire:loading wire:target="updatePassword">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span wire:loading.remove wire:target="updatePassword">Actualizar Contraseña</span>
                                    <span wire:loading wire:target="updatePassword">Actualizando...</span>
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <p class="text-gray-600">Haz clic en "Cambiar Contraseña" para actualizar tu contraseña de acceso.</p>
                        </div>
                    @endif
                </div>
            </div>


            </div>
        </div>
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
