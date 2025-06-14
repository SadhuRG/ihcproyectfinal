<x-layouts.app>
    <!-- ... (código anterior sin cambios) ... -->

    <div class="min-h-screen flex flex-col">
    <div id="main-content" class="transition-all duration-300">
        <div class="min-h-screen flex flex-col bg-[#EBF1FD]">
        <div>
            <!-- SECCIÓN INTERMEDIA -->
            <section class="flex flex-1 h-full">
            <!-- Sección 1/5 - Menú Lateral -->
            <div class="w-1/5 bg-white flex flex-col py-10 space-y-1 fixed top-24 bottom-0 overflow-y-auto">
                <!-- Botón Dashboard -->
                <div class="flex items-center">
                <button class="cursor-pointer border-2 border-solid bg-[#3553A2] text-white h-12 flex-1 flex items-center justify-center space-x-2 nav-button rounded-lg mx-7"
                    onclick="showSection('dashboard')" data-section="dashboard">
                    <h1 class="text-left hidden md:block lg:text-lg w-full ml-[25%]">
                    Dashboard
                    </h1>
                </button>
                </div>

                <!-- Botón Libros -->
                <div class="flex items-center">
                <button class="cursor-pointer border-2 border-solid bg-white hover:bg-[#CF93DD] h-12 flex-1 flex items-center justify-center space-x-2 nav-button rounded-lg mx-7"
                    onclick="showSection('libros')" data-section="libros">
                    <h1 class="text-left text-black hidden md:block lg:text-lg w-full ml-[25%]">
                    Libros
                    </h1>
                </button>
                </div>

                <!-- Botón Inventario -->
                <div class="flex items-center">
                <button class="cursor-pointer border-2 border-solid bg-white hover:bg-[#CF93DD] h-12 flex-1 flex items-center justify-center space-x-2 nav-button rounded-lg mx-7"
                    onclick="showSection('inventario')" data-section="inventario">
                    <h1 class="text-left text-black hidden md:block lg:text-lg w-full ml-[25%]">
                    Inventario
                    </h1>
                </button>
                </div>

                <!-- Botón Pedidos -->
                <div class="flex items-center">
                <button class="cursor-pointer border-2 border-solid bg-white hover:bg-[#CF93DD] h-12 flex-1 flex items-center justify-center space-x-2 nav-button rounded-lg mx-7"
                    onclick="showSection('pedidos')" data-section="pedidos">
                    <h1 class="text-left text-black hidden md:block lg:text-lg w-full ml-[25%]">
                    Pedidos
                    </h1>
                </button>
                </div>

                <!-- Botón Usuarios -->
                <div class="flex items-center">
                <button class="cursor-pointer border-2 border-solid bg-white hover:bg-[#CF93DD] h-12 flex-1 flex items-center justify-center space-x-2 nav-button rounded-lg mx-7"
                    onclick="showSection('usuarios')" data-section="usuarios">
                    <h1 class="text-left text-black hidden md:block lg:text-lg w-full ml-[25%]">
                    Usuarios
                    </h1>
                </button>
                </div>

                <!-- Botón Soporte de Usuario -->
                <div class="flex items-center">
                <button class="cursor-pointer border-2 border-solid bg-white hover:bg-[#CF93DD] h-12 flex-1 flex items-center justify-center space-x-2 nav-button rounded-lg mx-7"
                    onclick="showSection('soporte-usuario')" data-section="soporte-usuario">
                    <h1 class="text-left text-black hidden md:block lg:text-lg w-full ml-[25%]">
                    Soporte de Usuario
                    </h1>
                </button>
                </div>

                <!-- Botón Promociones -->
                <div class="flex items-center">
                <button class="cursor-pointer border-2 border-solid bg-white hover:bg-[#CF93DD] h-12 flex-1 flex items-center justify-center space-x-2 nav-button rounded-lg mx-7"
                    onclick="showSection('promociones')" data-section="promociones">
                    <h1 class="text-left text-black hidden md:block lg:text-lg w-full ml-[25%]">
                    Promociones
                    </h1>
                </button>
                </div>

                <!-- Botón Reportes -->
                <div class="flex items-center">
                <button class="cursor-pointer border-2 border-solid bg-white hover:bg-[#CF93DD] h-12 flex-1 flex items-center justify-center space-x-2 nav-button rounded-lg mx-7"
                    onclick="showSection('reportes')" data-section="reportes">
                    <h1 class="text-left text-black hidden md:block lg:text-lg w-full ml-[25%]">
                    Reportes
                    </h1>
                </button>
                </div>
            </div>

            <!-- Sección 4/5 -->
            <div class="w-4/5 bg-[#EBF1FD] py-5 px-0 flex flex-col ml-[20%]">
                <div class="flex-1">
                <div id="dashboard" class="content-section pt-5">
                    @include('dashboard-info')
                </div>

                <div id="libros" class="content-section hidden">
                    <x-section-title title="libros"/>
                </div>

                <div id="inventario" class="content-section hidden">
                    <x-section-title title="inventario"/>
                </div>

                <div id="pedidos" class="content-section hidden">
                    <x-section-title title="pedidos"/>
                </div>

                <div id="usuarios" class="content-section hidden">
                    @livewire('usuarios-post')
                </div>

                <div id="soporte-usuario" class="content-section hidden">
                    <x-section-title title="soporte-usuario"/>
                </div>

                <div id="promociones" class="content-section hidden">
                    <x-section-title title="promociones"/>
                </div>

                <div id="reportes" class="content-section hidden">
                    <x-section-title title="reportes"/>
                </div>
                </div>
            </div>
            </section>
        </div>

        <!-- SCRIPT PARA MANEJAR EL DASHBARD -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const sections = document.querySelectorAll('.content-section');
                const navButtons = document.querySelectorAll('.nav-button');

                // Función para mostrar sección y actualizar botones
                function showSection(sectionId) {
                    // Oculta todas las secciones
                    sections.forEach(s => s.classList.add('hidden'));

                    // Muestra la sección seleccionada
                    const selected = document.getElementById(sectionId);
                    if (selected) selected.classList.remove('hidden');

                    // Actualiza todos los botones
                    navButtons.forEach(btn => {
                        const btnSection = btn.getAttribute('data-section');
                        const isActive = btnSection === sectionId;

                        // Actualiza colores y texto
                        if (isActive) {
                            btn.classList.remove('bg-white', 'hover:bg-[#CF93DD]');
                            btn.classList.add('bg-[#3553A2]');
                            btn.querySelector('h1').classList.remove('text-black');
                            btn.querySelector('h1').classList.add('text-white');
                        } else {
                            btn.classList.remove('bg-[#3553A2]');
                            btn.classList.add('bg-white', 'hover:bg-[#CF93DD]');
                            btn.querySelector('h1').classList.remove('text-white');
                            btn.querySelector('h1').classList.add('text-black');
                        }
                    });
                }

                // Asigna eventos a los botones
                navButtons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const section = btn.getAttribute('data-section');
                        showSection(section);
                    });
                });

                // Mostrar por defecto la sección dashboard
                showSection('dashboard');
            });
        </script>
        </div>
    </div>
    </div>
</x-layouts.app>
