<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!--START HEAD
        En un nuevo archivo para poder compartir la misma información
    -->
<head>
        @include('partials.head')
</head>

<!-- FOTTER -->
<div class="bg-black w-full md:w-full md:h-50 -mt-10 md:-mt-20 z-20 relative" style="background-image: url('/icons/footer.svg'); background-size: cover; background-position: center;">

    <div class="relative z-40 text-sm mt-2 pt-6 pb-4 ml-5 md:mt-20 md:ml-20 md:text-2xl text-white">@ 2024 All Rigths Reserved</div>

</div>
<!-- FIN FOOTER -->

{{ $slot }}

</html>
