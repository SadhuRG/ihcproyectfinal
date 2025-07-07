@auth
    <div class="relative">
        <button id="user-menu-btn" class="px-4 py-2 bg-white text-indigo-600 hover:bg-gray-100 font-medium rounded-full transition-all duration-300 hover:scale-105 shadow-lg">
        <span class="text-sm">Hola {{ auth()->user()->name }}</span>
        </button>
        <div id="user-menu-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
            <a href="{{ route('profile.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Mi perfil</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Mis pedidos</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Lista de deseos</a>
            <button onclick="abrirModalSoporte(); document.getElementById('user-menu-dropdown').classList.add('hidden');" 
                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Contactar Soporte
                </div>
            </button>
            @if(auth()->user()->hasAnyRole(['superadministrador', 'administrador', 'colaborador']))
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Dashboard</a>
            @endif
            <a href="{{ route('logout') }}" 
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Cerrar Sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <script>
        document.getElementById('user-menu-btn').addEventListener('click', function() {
            const dropdown = document.getElementById('user-menu-dropdown');
            dropdown.classList.toggle('hidden');
        });

        // Cierra el menú si se hace clic fuera de él
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('user-menu-dropdown');
            const button = document.getElementById('user-menu-btn');
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });


    </script>
@endauth