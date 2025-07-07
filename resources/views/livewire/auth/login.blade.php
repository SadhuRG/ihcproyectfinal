<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;
    public bool $showPassword = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        // Redirigir según el rol del usuario
        $user = Auth::user();
        if ($user->hasAnyRole(['superadministrador', 'administrador', 'colaborador'])) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        } else {
        $this->redirectIntended(default: route('welcome', absolute: false), navigate: true);
        }
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
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
        <p class="text-white/80 text-sm">Bienvenido de vuelta</p>
    </div>

    <!-- Formulario Principal -->
    <div class="glassmorphism backdrop-blur-lg bg-white/10 rounded-3xl p-6 shadow-2xl border border-white/20">
        <div class="text-center mb-6">
            <h2 class="text-xl font-bold text-white mb-2">Iniciar Sesión</h2>
            <p class="text-white/70 text-sm">Ingresa a tu cuenta</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center mb-4 text-green-300" :status="session('status')" />

        <form wire:submit="login" class="space-y-5">
            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-white/90 mb-2">
                    Correo Electrónico
                </label>
                <input
                    type="email"
                    id="email"
                    wire:model="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="correo@ejemplo.com"
                    class="w-full px-4 py-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 placeholder-white/50 text-white focus:ring-2 focus:ring-purple-400 focus:border-transparent focus:outline-none transition-all duration-200"
                />
                @error('email') <span class="text-pink-300 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-white/90 mb-2">
                    Contraseña
                </label>
                <div class="relative">
                    <input
                        type="{{ $showPassword ? 'text' : 'password' }}"
                        id="password"
                        wire:model.blur="password"
                        wire:key="password-{{ $showPassword ? 'text' : 'password' }}"
                        required
                        autocomplete="current-password"
                        placeholder="Tu contraseña"
                        class="w-full px-4 py-3 pr-12 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 placeholder-white/50 text-white focus:ring-2 focus:ring-purple-400 focus:border-transparent focus:outline-none transition-all duration-200"
                    />
                    <button
                        type="button"
                        wire:click="$toggle('showPassword')"
                        class="absolute inset-y-0 right-3 flex items-center text-white/60 hover:text-white focus:outline-none transition-colors duration-200"
                        title="{{ $showPassword ? 'Ocultar contraseña' : 'Mostrar contraseña' }}"
                    >
                        @if ($showPassword)
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        @else
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                            </svg>
                        @endif
                    </button>
                </div>
                @error('password') <span class="text-pink-300 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Opciones adicionales -->
            <div class="flex items-center justify-between text-sm">
                <!-- Remember Me -->
                <div class="flex items-center space-x-2">
                    <input
                        type="checkbox"
                        id="remember"
                        wire:model="remember"
                        class="w-4 h-4 rounded text-purple-500 bg-white/10 border-white/20 focus:ring-purple-400 focus:ring-2"
                    />
                    <label for="remember" class="text-white/80">
                        Recordarme
                    </label>
                </div>

                <!-- Forgot Password Link -->
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-white/80 hover:text-white transition-colors duration-200">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]"
                >
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1"></path>
                        </svg>
                        Iniciar Sesión
                    </span>
                </button>
            </div>
        </form>

        <!-- Link a Register -->
        @if (Route::has('register'))
            <div class="text-center mt-4 pt-4 border-t border-white/20">
                <p class="text-white/70 text-sm">
                    ¿No tienes una cuenta?
                    <a href="{{ route('register') }}" class="text-white font-semibold hover:text-purple-200 transition-colors duration-200 ml-1" wire:navigate>
                        Regístrate
                    </a>
                </p>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <div class="text-center">
        <p class="text-white/60 text-xs">
            Librería Pulsar © 2025 - Todos los derechos reservados
        </p>
    </div>
</div>
