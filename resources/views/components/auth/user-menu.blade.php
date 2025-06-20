@auth
    <div class="relative">
        <button id="user-menu-btn" class="px-4 py-2 bg-white text-indigo-600 hover:bg-gray-100 font-medium rounded-full transition-all duration-300 hover:scale-105 shadow-lg">
            <span class="text-sm">Mi Cuenta</span>
        </button>
        <div id="user-menu-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
            <a href="{{ route('user-profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Mi perfil</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Mis pedidos</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Lista de deseos</a>
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