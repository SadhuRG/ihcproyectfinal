<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Librería Pulsar' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/font-size.js'])

    @stack('styles')
</head>

<body class="bg-gradient-to-br from-slate-50 to-blue-100 min-h-screen">

    <!-- HEADER -->
    <x-layouts.app.header />

    <!-- CONTENIDO PRINCIPAL -->
    <main class="pt-24">
        {{ $slot }}
    </main>

    <!-- FOOTER -->
    <x-layouts.app.footer />

    @stack('scripts')
</body>
</html>
