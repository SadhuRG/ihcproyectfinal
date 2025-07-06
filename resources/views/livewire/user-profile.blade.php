<?php

use Livewire\Volt\Component;

new class extends Component {
    // El componente ya está definido en app/Livewire/UserProfile.php
}; ?>

<div class="min-h-screen pt-20" style="background: var(--bg-primary);">
    <!-- Header -->
    <div class="card shadow-sm border-b" style="background: var(--card-bg); border-color: var(--text-primary);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold" style="color: var(--text-primary);">Mi Perfil</h1>
                    <p class="mt-1 text-sm" style="color: var(--text-primary);">Gestiona tu información personal y configuración de cuenta</p>
                </div>
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('welcome') }}" class="font-medium text-accent hover:text-indigo-700 dark:hover:text-indigo-400">
                        ← Volver al inicio
                    </a>
                    @if(auth()->user()->hasAnyRole(['superadministrador', 'administrador', 'colaborador']))
                        <a href="{{ route('dashboard') }}" class="font-medium text-accent hover:text-indigo-700 dark:hover:text-indigo-400">
                            ← Volver al Dashboard
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Notificación Global -->
        @if($showNotification)
            <div class="fixed top-20 left-1/2 transform -translate-x-1/2 z-50 mb-6 p-4 rounded-lg shadow-lg {{ $notificationType === 'success' ? 'bg-green-50 dark:bg-green-900/50 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-200' : 'bg-red-50 dark:bg-red-900/50 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-200' }}">
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Columna Izquierda - Información del Perfil -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Información Personal -->
                <div class="card rounded-xl shadow-sm border" style="background: var(--card-bg); border-color: var(--text-primary);">
                    <div class="flex items-center justify-between mb-6 p-6">
                        <h2 class="text-xl font-semibold" style="color: var(--text-primary);">Información Personal</h2>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--text-primary);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>

                    <form wire:submit="updateProfile" class="space-y-6 p-6">
                        <!-- Foto de Perfil -->
                        <div class="flex items-center space-x-6">
                            <div class="relative">
                                @if($currentPhoto || $photo)
                                    <label for="photo" class="cursor-pointer block">
                                        <img src="{{ $photo ? $photo->temporaryUrl() : $currentPhoto }}" alt="Foto de perfil" class="w-20 h-20 rounded-full object-cover border-4 border-white dark:border-gray-800 shadow-lg hover:opacity-80 transition-opacity duration-200">
                                    </label>
                                @else
                                    <label for="photo" class="cursor-pointer block">
                                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 dark:from-indigo-400 dark:to-purple-500 flex items-center justify-center text-white dark:text-gray-200 text-2xl font-bold shadow-lg hover:opacity-80 transition-opacity duration-200">
                                            {{ substr($name, 0, 1) }}{{ substr($apellido, 0, 1) }}
                                        </div>
                                    </label>
                                @endif
                                
                                <!-- Botón de eliminar (solo cuando hay foto) -->
                                @if($currentPhoto || $photo)
                                    <div class="absolute -bottom-1 -right-1">
                                        <button wire:click="removePhoto" type="button" class="bg-white dark:bg-gray-800 p-1 rounded-full shadow-lg transition-colors duration-200 hover:bg-gray-50 dark:hover:bg-gray-700" title="Restaurar foto por defecto">
                                            <svg class="w-6 h-6 text-red-500 dark:text-red-400 hover:text-red-600 dark:hover:text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                                
                                <input wire:model="photo" type="file" id="photo" class="hidden" accept="image/*">
                            </div>
                            <div>
                                <h3 class="text-lg font-medium" style="color: var(--text-primary);">{{ $name }} {{ $apellido }}</h3>
                                <p class="text-sm" style="color: var(--text-primary);">{{ $email }}</p>
                                @if($telefono)
                                    <p class="text-sm" style="color: var(--text-primary);">{{ $telefono }}</p>
                                @endif
                            </div>
                        </div>

                        @if($photo)
                            <div class="p-3 rounded-lg" style="background: var(--card-bg);">
                                <p class="text-sm text-accent">Nueva foto seleccionada: {{ $photo->getClientOriginalName() }}</p>
                            </div>
                        @endif

                        <!-- Campos del formulario -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nombre -->
                            <div>
                                <label for="name" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Nombre *</label>
                                <input wire:model="name" type="text" id="name" required
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-colors duration-200" style="border-color: var(--text-primary); background: var(--card-bg); color: var(--text-primary);">
                                @error('name') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Apellido -->
                            <div>
                                <label for="apellido" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Apellido</label>
                                <input wire:model="apellido" type="text" id="apellido"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-colors duration-200" style="border-color: var(--text-primary); background: var(--card-bg); color: var(--text-primary);">
                                @error('apellido') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Correo Electrónico *</label>
                                <input wire:model="email" type="email" id="email" required
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-colors duration-200" style="border-color: var(--text-primary); background: var(--card-bg); color: var(--text-primary);">
                                @error('email') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Teléfono -->
                            <div>
                                <label for="telefono" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Teléfono</label>
                                <input wire:model="telefono" type="tel" id="telefono"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-colors duration-200" style="border-color: var(--text-primary); background: var(--card-bg); color: var(--text-primary);">
                                @error('telefono') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Fecha de Nacimiento -->
                            <div class="md:col-span-2">
                                <label for="fecha_n" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Fecha de Nacimiento</label>
                                <input wire:model="fecha_n" type="date" id="fecha_n"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-colors duration-200" style="border-color: var(--text-primary); background: var(--card-bg); color: var(--text-primary);">
                                @error('fecha_n') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Botón de actualizar -->
                        <div class="flex justify-end pt-4">
                            <button type="submit" 
                                class="px-6 py-3 btn-primary font-medium rounded-lg transition-colors duration-200 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Actualizar Perfil</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Cambio de Contraseña -->
                <div class="card rounded-xl shadow-sm border" style="background: var(--card-bg); border-color: var(--text-primary);">
                    <div class="flex items-center justify-between mb-6 p-6">
                        <h2 class="text-xl font-semibold" style="color: var(--text-primary);">Cambiar Contraseña</h2>
                        <button wire:click="togglePasswordFields" 
                            class="text-sm font-medium text-accent hover:text-indigo-700 dark:hover:text-indigo-400">
                            {{ $showPasswordFields ? 'Cancelar' : 'Cambiar Contraseña' }}
                        </button>
                    </div>

                    @if($showPasswordFields)
                        <form wire:submit="updatePassword" class="space-y-6 p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Contraseña Actual -->
                                <div>
                                    <label for="current_password" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Contraseña Actual *</label>
                                    <input wire:model="current_password" type="password" id="current_password" required
                                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-colors duration-200" style="border-color: var(--text-primary); background: var(--card-bg); color: var(--text-primary);">
                                    @error('current_password') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Nueva Contraseña -->
                                <div>
                                    <label for="new_password" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Nueva Contraseña *</label>
                                    <input wire:model="new_password" type="password" id="new_password" required
                                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-colors duration-200" style="border-color: var(--text-primary); background: var(--card-bg); color: var(--text-primary);">
                                    @error('new_password') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Confirmar Nueva Contraseña -->
                                <div class="md:col-span-2">
                                    <label for="confirm_password" class="block text-sm font-medium mb-2" style="color: var(--text-primary);">Confirmar Nueva Contraseña *</label>
                                    <input wire:model="confirm_password" type="password" id="confirm_password" required
                                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-colors duration-200" style="border-color: var(--text-primary); background: var(--card-bg); color: var(--text-primary);">
                                    @error('confirm_password') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Botón de actualizar contraseña -->
                            <div class="flex justify-end pt-4">
                                <button type="submit" 
                                    class="px-6 py-3 btn-primary font-medium rounded-lg transition-colors duration-200 flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <span>Actualizar Contraseña</span>
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--text-primary);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <p style="color: var(--text-primary);">Haz clic en "Cambiar Contraseña" para actualizar tu contraseña de acceso.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Columna Derecha - Información Adicional -->
            <div class="space-y-6">
                <!-- Información de la Cuenta -->
                <div class="card rounded-xl shadow-sm border" style="background: var(--card-bg); border-color: var(--text-primary);">
                    <h3 class="text-lg font-semibold mb-4 p-6" style="color: var(--text-primary);">Información de la Cuenta</h3>
                    <div class="space-y-4 p-6">
                        <div class="flex items-center justify-between">
                            <span class="text-sm" style="color: var(--text-primary);">Rol:</span>
                            <span class="text-sm font-medium capitalize" style="color: var(--text-primary);">{{ auth()->user()->roles->first()?->name ?? 'usuario' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm" style="color: var(--text-primary);">Miembro desde:</span>
                            <span class="text-sm font-medium" style="color: var(--text-primary);">{{ auth()->user()->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm" style="color: var(--text-primary);">Email verificado:</span>
                            <span class="text-sm font-medium {{ auth()->user()->email_verified_at ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ auth()->user()->email_verified_at ? 'Sí' : 'No' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Estadísticas Rápidas -->
                <div class="card rounded-xl shadow-sm border" style="background: var(--card-bg); border-color: var(--text-primary);">
                    <h3 class="text-lg font-semibold mb-4 p-6" style="color: var(--text-primary);">Mis Estadísticas</h3>
                    <div class="space-y-4 p-6">
                        <div class="flex items-center justify-between">
                            <span class="text-sm" style="color: var(--text-primary);">Pedidos realizados:</span>
                            <span class="text-sm font-medium" style Vt("color: var(--text-primary);">{{ auth()->user()->orders()->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm" style="color: var(--text-primary);">Libros favoritos:</span>
                            <span class="text-sm font-medium" style="color: var(--text-primary);">{{ auth()->user()->favoriteBooks()->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm" style="color: var(--text-primary);">Comentarios:</span>
                            <span class="text-sm font-medium" style="color: var(--text-primary);">{{ auth()->user()->comments()->count() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Enlaces Rápidos -->
                @if(!auth()->user()->hasAnyRole(['superadministrador', 'administrador', 'colaborador']))
                    <div class="card rounded-xl shadow-sm border" style="background: var(--card-bg); border-color: var(--text-primary);">
                        <h3 class="text-lg font-semibold mb-4 p-6" style="color: var(--text-primary);">Enlaces Rápidos</h3>
                        <div class="space-y-3 p-6">
                            <a href="#" class="flex items-center text-sm text-accent hover:text-indigo-700 dark:hover:text-indigo-400 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--text-primary);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Mis Pedidos
                            </a>
                            <a href="#" class="flex items-center text-sm text-accent hover:text-indigo-700 dark:hover:text-indigo-400 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--text-primary);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                Lista de Deseos
                            </a>
                            <a href="#" class="flex items-center text-sm text-accent hover:text-indigo-700 dark:hover:text-indigo-400 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--text-primary);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Mis Comentarios
                            </a>
                        </div>
                    </div>
                @endif
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