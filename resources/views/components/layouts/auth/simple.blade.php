<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased :bg-linear-to-b :from-neutral-950 :to-neutral-900 {{ auth()->check() ? 'auth-user' : '' }}">
        <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-sm flex-col gap-2">
                <a href="/" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex h-16 w-16 mb-1 items-center justify-center rounded-2xl bg-gradient-to-r from-purple-600 to-blue-600">
                        <img src="/imagenes/LOGO.jpg" alt="Pulsar Logo" class="w-12 h-12 rounded-xl">
                    </span>
                </a>
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
