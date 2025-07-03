<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $apellido = '';
    public string $email = '';
    public string $telefono = '';
    public string $fecha_n = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $showPassword = false;
    public bool $showPasswordConfirmation = false;

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['nullable', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'telefono' => ['nullable', 'numeric', 'digits_between:9,15'],
            'fecha_n' => ['nullable', 'date', 'before_or_equal:today', 'after:1900-01-01'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $userData = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];

        // Solo agregar campos opcionales si tienen valor
        if (!empty($this->apellido)) {
            $userData['apellido'] = $this->apellido;
        }
        if (!empty($this->telefono)) {
            $userData['telefono'] = $this->telefono;
        }
        if (!empty($this->fecha_n)) {
            $userData['fecha_n'] = $this->fecha_n;
        }

        $user = User::create($userData);

        event(new Registered($user));

        Auth::login($user);

        $this->redirectIntended(route('welcome', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <style>
        .glassmorphism {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        /* Aplicar gradiente al body a través del layout */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }
    </style>

    <!-- Header con logo -->
    <div class="text-center">
        <h1 class="text-2xl font-bold text-white mb-1">Librería Pulsar</h1>
        <p class="text-white/80 text-sm">Crea tu cuenta y descubre nuevos mundos</p>
    </div>

    <!-- Formulario Principal -->
    <div class="glassmorphism backdrop-blur-lg bg-white/10 rounded-3xl p-6 shadow-2xl border border-white/20">
        <div class="text-center mb-5">
            <h2 class="text-xl font-bold text-white mb-2">Crear Cuenta</h2>
            <p class="text-white/70 text-sm">Ingresa tus datos para registrarte</p>
        </div>

        <form wire:submit="register" class="space-y-4">
            <!-- Nombre y Apellido (fila) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-white/90 mb-1">
                        Nombre *
                    </label>
                    <input
                        type="text"
                        id="name"
                        wire:model="name"
                        required
                        autofocus
                        autocomplete="given-name"
                        placeholder="Tu nombre"
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 placeholder-white/50 text-white focus:ring-2 focus:ring-purple-400 focus:border-transparent focus:outline-none transition-all duration-200"
                    />
                    @error('name') <span class="text-pink-300 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="apellido" class="block text-sm font-medium text-white/90 mb-1">
                        Apellido
                    </label>
                    <input
                        type="text"
                        id="apellido"
                        wire:model="apellido"
                        autocomplete="family-name"
                        placeholder="Tu apellido"
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 placeholder-white/50 text-white focus:ring-2 focus:ring-purple-400 focus:border-transparent focus:outline-none transition-all duration-200"
                    />
                    @error('apellido') <span class="text-pink-300 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-white/90 mb-1">
                    Correo Electrónico *
                </label>
                <input
                    type="email"
                    id="email"
                    wire:model="email"
                    required
                    autocomplete="email"
                    placeholder="correo@ejemplo.com"
                    class="w-full px-4 py-2.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 placeholder-white/50 text-white focus:ring-2 focus:ring-purple-400 focus:border-transparent focus:outline-none transition-all duration-200"
                />
                @error('email') <span class="text-pink-300 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Teléfono y Fecha de Nacimiento (fila) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="telefono" class="block text-sm font-medium text-white/90 mb-1">
                        Teléfono
                    </label>
                    <input
                        type="tel"
                        id="telefono"
                        wire:model="telefono"
                        autocomplete="tel"
                        placeholder="987654321"
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 placeholder-white/50 text-white focus:ring-2 focus:ring-purple-400 focus:border-transparent focus:outline-none transition-all duration-200"
                    />
                    @error('telefono') <span class="text-pink-300 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="fecha_n" class="block text-sm font-medium text-white/90 mb-1">
                        Fecha de Nacimiento
                    </label>
                    <input
                        type="date"
                        id="fecha_n"
                        wire:model="fecha_n"
                        autocomplete="bday"
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 placeholder-white/50 text-white focus:ring-2 focus:ring-purple-400 focus:border-transparent focus:outline-none transition-all duration-200"
                    />
                    @error('fecha_n') <span class="text-pink-300 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium text-white/90 mb-1">
                    Contraseña *
                </label>
                <div class="relative">
                    <input
                        type="{{ $showPassword ? 'text' : 'password' }}"
                        id="password"
                        wire:model.blur="password"
                        wire:key="password-{{ $showPassword ? 'text' : 'password' }}"
                        required
                        autocomplete="new-password"
                        placeholder="Tu contraseña"
                        class="w-full px-4 py-2.5 pr-12 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 placeholder-white/50 text-white focus:ring-2 focus:ring-purple-400 focus:border-transparent focus:outline-none transition-all duration-200"
                    />
                    <button
                        type="button"
                        wire:click="$toggle('showPassword')"
                        class="absolute inset-y-0 right-3 flex items-center text-white/60 hover:text-white focus:outline-none transition-colors duration-200"
                        title="{{ $showPassword ? 'Ocultar contraseña' : 'Mostrar contraseña' }}"
                    >
                        @if ($showPassword)
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        @else
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                            </svg>
                        @endif
                    </button>
                </div>
                @error('password') <span class="text-pink-300 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-white/90 mb-1">
                    Confirmar Contraseña *
                </label>
                <div class="relative">
                    <input
                        type="{{ $showPasswordConfirmation ? 'text' : 'password' }}"
                        id="password_confirmation"
                        wire:model.blur="password_confirmation"
                        wire:key="password_confirmation-{{ $showPasswordConfirmation ? 'text' : 'password' }}"
                        required
                        autocomplete="new-password"
                        placeholder="Confirma tu contraseña"
                        class="w-full px-4 py-2.5 pr-12 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 placeholder-white/50 text-white focus:ring-2 focus:ring-purple-400 focus:border-transparent focus:outline-none transition-all duration-200"
                    />
                    <button
                        type="button"
                        wire:click="$toggle('showPasswordConfirmation')"
                        class="absolute inset-y-0 right-3 flex items-center text-white/60 hover:text-white focus:outline-none transition-colors duration-200"
                        title="{{ $showPasswordConfirmation ? 'Ocultar contraseña' : 'Mostrar contraseña' }}"
                    >
                        @if ($showPasswordConfirmation)
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        @else
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                            </svg>
                        @endif
                    </button>
                </div>
                @error('password_confirmation') <span class="text-pink-300 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-3">
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]"
                >
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Crear Cuenta
                    </span>
                </button>
            </div>
        </form>

        <!-- Link a Login -->
        @if (Route::has('login'))
            <div class="text-center mt-4 pt-4 border-t border-white/20">
                <p class="text-white/70 text-sm">
                    ¿Ya tienes una cuenta?
                    <a href="{{ route('login') }}" class="text-white font-semibold hover:text-purple-200 transition-colors duration-200 ml-1" wire:navigate>
                        Inicia Sesión
                    </a>
                </p>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <div class="text-center">
        <p class="text-white/60 text-xs">
            Al registrarte, aceptas nuestros términos y condiciones
        </p>
    </div>
</div>
