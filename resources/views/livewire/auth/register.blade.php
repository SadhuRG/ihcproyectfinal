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
    public string $email = '';
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $this->redirectIntended(route('welcome', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6 max-w-md mx-auto bg-zinc-900 text-white p-8 rounded-2xl shadow-xl border border-zinc-700">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium mb-1">
                {{ __('Name') }}
            </label>
            <input
                type="text"
                id="name"
                wire:model="name"
                required
                autofocus
                autocomplete="name"
                placeholder="{{ __('Full name') }}"
                class="w-full px-4 py-2 rounded-md bg-zinc-800 border border-zinc-600 placeholder-zinc-500 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none"
            />
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium mb-1">
                {{ __('Email address') }}
            </label>
            <input
                type="email"
                id="email"
                wire:model="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
                class="w-full px-4 py-2 rounded-md bg-zinc-800 border border-zinc-600 placeholder-zinc-500 text-white focus:ring-2 focus:ring/blue-500 focus:outline-none"
            />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div class="relative">
            <label for="password" class="block text-sm font-medium mb-1">
                {{ __('Password') }}
            </label>
            <div class="relative">
                <input
                    type="{{ $showPassword ? 'text' : 'password' }}"
                    id="password"
                    wire:model.blur="password"
                    wire:key="password-{{ $showPassword ? 'text' : 'password' }}"
                    required
                    autocomplete="new-password"
                    placeholder="{{ __('Password') }}"
                    class="w-full px-4 py-2 rounded-md bg-zinc-800 border border-zinc-600 placeholder-zinc-500 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none"
                />
                <button
                    type="button"
                    wire:click="$toggle('showPassword')"
                    class="absolute inset-y-0 right-3 flex items-center text-zinc-400 hover:text-white focus:outline-none"
                    title="{{ $showPassword ? __('Hide password') : __('Show password') }}"
                >
                    @if ($showPassword)
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    @else
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        </svg>
                    @endif
                </button>
            </div>
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Confirm Password -->
        <div class="relative">
            <label for="password_confirmation" class="block text-sm font-medium mb-1">
                {{ __('Confirm password') }}
            </label>
            <div class="relative">
                <input
                    type="{{ $showPasswordConfirmation ? 'text' : 'password' }}"
                    id="password_confirmation"
                    wire:model.blur="password_confirmation"
                    wire:key="password_confirmation-{{ $showPasswordConfirmation ? 'text' : 'password' }}"
                    required
                    autocomplete="new-password"
                    placeholder="{{ __('Confirm password') }}"
                    class="w-full px-4 py-2 rounded-md bg-zinc-800 border border-zinc-600 placeholder-zinc-500 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none"
                />
                <button
                    type="button"
                    wire:click="$toggle('showPasswordConfirmation')"
                    class="absolute inset-y-0 right-3 flex items-center text-zinc-400 hover:text-white focus:outline-none"
                    title="{{ $showPasswordConfirmation ? __('Hide password') : __('Show password') }}"
                >
                    @if ($showPasswordConfirmation)
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    @else
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        </svg>
                    @endif
                </button>
            </div>
            @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div>
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200"
            >
                {{ __('Create account') }}
            </button>
        </div>
    </form>

    @if (Route::has('login'))
        <div class="text-center text-sm text-zinc-400 space-x-1 rtl:space-x-reverse">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}" class="text-blue-400 hover:underline" wire:navigate>
                {{ __('Log in') }}
            </a>
        </div>
    @endif
</div>
