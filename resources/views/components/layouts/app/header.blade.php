<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body>

    <!-- HEADER -->
    <div class="w-full p-3 bg-blue-500 shadow-lg flex items-center fixed top-0 z-50">

         <div class="w-1/4 flex items-center justify-center 2xl:pr-20">
            <a href="{{ url('/') }}">
                <img src="/imagenes/LOGO.jpg" alt="LibreriaPulsar - Logo" class="min-w-[100px] w-16 h-auto cursor-pointer">
            </a>
        </div>

        <!-- Menú Grande -->
        <div class="w-3/4 flex items-center justify-end pr-10 md:pr-20 ml-[5%] relative">
            <a href="{{ route('register') }}" class="ml-1 mr-2 px-5 py-3 flex items-center justify-center bg-black text-accent-300 font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 border-accent-300 border-2 lg:ml-2">
                <h1 class="flex items-center justify-center text-center text-xs text-accent-300 lg:text-xl lg:text-center">Crear Cuenta</h1>
            </a>
            <a href="{{ route('login') }}" class="ml-1 mr-2 px-5 py-3 flex items-center justify-center bg-black hover:bg-primary-300 font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 border-accent-300 hover:border-primary-300 border-2 lg:ml-2">
                <h1 class="flex items-center justify-center text-center text-xs text-white lg:text-xl lg:text-center">Iniciar Sesión</h1>
            </a>
        </div>

    </div>

    <!-- FIN HEADER -->

    {{ $slot }}

</body>

</html>
