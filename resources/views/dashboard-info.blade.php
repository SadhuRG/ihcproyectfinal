<div>
        <x-section-title title="DASHBOARD" />

        <!-- INFORMACION PARA DASHBOARD-->
        <div class="grid grid-cols-4 gap-6 pl-10 pr-20 ml-1 mr-3">
            <!-- Botón Usuarios -->
            <div class="bg-white px-4 py-4 rounded-md shadow-md bg-transparent text-[#000000] flex items-center flex-1">
            <div>
                <h1 class="ml-3 mb-3 text-xs md:text-sm lg:text-sm text-[#636466]">Ventas del dia</h1>
                <h1 class="ml-3 font-medium text-xs md:text-sm lg:text-lg">40,689</h1>
            </div>
            <div class="bg-[#E5E4FF] p-4 py-4 rounded-lg ml-auto">

            </div>
            </div>

            <!-- Botón Grupos -->
            <div class="bg-white px-4 py-2 rounded-md shadow-md bg-transparent text-black flex items-center flex-1">
            <div>
                <h1 class="ml-3 mb-3 text-xs md:text-sm lg:text-sm text-[#636466]">Total de Libros vendidos</h1>
                <h1 class="ml-3 font-medium text-xs md:text-sm lg:text-lg">500</h1>
            </div>
            <div class="bg-[#FFF3D6] p-4 py-4 rounded-lg ml-auto">
                <img src="{{asset('/imagenes/icons/2.svg')}}" alt="Grupos Icon" class="w-10 h-10">
            </div>
            </div>

            <!-- Botón Certificados -->
            <div class="bg-white px-4 py-2 rounded-md shadow-md bg-transparent text-black flex items-center flex-1">
            <div>
                <h1 class="ml-3 mb-3 text-xs md:text-sm lg:text-sm text-[#636466]">Usuarios</h1>
                <h1 class="ml-3 font-medium text-xs md:text-sm lg:text-lg">2300</h1>
            </div>
            <div class="bg-[#E5E4FF] p-4 py-4 rounded-lg ml-auto">
                <img src="{{asset('/imagenes/icons/3.svg')}}" alt="Certificados Icon" class="w-10 h-10">
            </div>
            </div>

            <!-- Botón Pendientes -->
            <div class="bg-white px-4 py-2 rounded-md shadow-md bg-transparent text-black flex items-center flex-1">
            <div>
                <h1 class="ml-3 mb-3 text-xs md:text-sm lg:text-sm text-[#636466]">Total de libros disponibles</h1>
                <h1 class="ml-3 font-medium text-xs md:text-sm lg:text-lg">1500</h1>
            </div>
            <div class="bg-[#FFDED1] p-4 py-4 rounded-lg ml-auto">
                <img src="{{asset('/imagenes/icons/4.svg')}}" alt="Pendientes Icon" class="w-10 h-10">
            </div>
            </div>
        </div>

        <div class="mx-10 mt-5 grid grid-cols-1 md:grid-cols-2 gap-10 justify-center items-start">
        <!-- PRIMER GRÁFICO: GÉNEROS DE LIBROS -->
        <div class="w-full bg-white rounded-lg shadow-sm p-4 md:p-6">
            <div class="flex justify-between pb-4 mb-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center me-3">
                <img src="{{ asset('icons/libro.jpg') }}" alt="Libro" class="w-8 h-8">
                </div>
                <div>
                <h4 class="leading-none text-1xl font-bold text-gray-900 pb-1">
                    Géneros de libros más vendidos
                </h4>
                </div>
            </div>
            </div>
            <div id="column-chart" class="w-full min-h-[320px]"></div>
        </div>

        <!-- SEGUNDO GRÁFICO: VENTAS MENSUALES 2024 -->
        <div class="w-full bg-white rounded-lg shadow-sm p-4 md:p-6">
            <div class="flex justify-between pb-4 mb-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center me-3">
                <img src="{{ asset('icons/libro.jpg') }}" alt="Ventas" class="w-8 h-8">
                </div>
                <div>
                <h4 class="leading-none text-1xl font-bold text-gray-900 pb-1">
                    Ventas mensuales 2024
                </h4>
                </div>
            </div>
            </div>
            <div id="ventas-mensuales-chart" class="w-full min-h-[320px]"></div>
        </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Verify ApexCharts is loaded
            if (typeof ApexCharts === 'undefined') {
            console.error('ApexCharts no se cargó correctamente. Asegúrate de que la biblioteca esté incluida.');
            return;
            }

            // First Chart: Géneros de libros más vendidos
            const options1 = {
            series: [{
                name: "Ventas",
                data: [231, 122, 63, 421, 122]
            }],
            chart: {
                type: "bar",
                height: 320,
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                horizontal: false,
                columnWidth: "70%",
                endingShape: "rounded"
                }
            },
            colors: ["#1A56DB"],
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: ["Drama", "Comedia", "Aventura", "Romance", "Novela"],
                labels: {
                style: {
                    fontSize: "12px",
                    colors: "#333"
                }
                }
            },
            yaxis: {
                title: {
                text: "Ventas"
                },
                labels: {
                style: {
                    fontSize: "12px",
                    colors: "#333"
                }
                }
            },
            tooltip: {
                y: {
                formatter: function(val) {
                    return val + " libros";
                }
                },
                theme: 'dark', // Ensures a light background
            }
            };

            // Second Chart: Ventas mensuales 2024
            const options2 = {
            series: [{
                name: "Ventas",
                data: [320, 280, 290, 310, 450, 500, 470, 480, 460, 490, 520, 510]
            }],
            chart: {
                type: "bar",
                height: 320,
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                horizontal: false,
                columnWidth: "70%",
                endingShape: "rounded"
                }
            },
            colors: ["#00E396"],
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: [
                "Ene", "Feb", "Mar", "Abr", "May", "Jun",
                "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"
                ],
                labels: {
                style: {
                    fontSize: "12px",
                    colors: "#333"
                }
                }
            },
            yaxis: {
                title: {
                text: "Ventas"
                },
                labels: {
                style: {
                    fontSize: "12px",
                    colors: "#333"
                }
                }
            },
            tooltip: {
                y: {
                formatter: function(val) {
                    return val + " libros";
                }
                },
                theme: 'dark', // Ensures a light background
            }
            };

            // Render charts with validation
            const renderChart = (selector, options) => {
            const element = document.querySelector(selector);
            if (element) {
                try {
                new ApexCharts(element, options).render();
                } catch (error) {
                console.error(`Error al renderizar el gráfico ${selector}:`, error);
                }
            } else {
                console.error(`Elemento no encontrado: ${selector}`);
            }
            };

            renderChart("#column-chart", options1);
            renderChart("#ventas-mensuales-chart", options2);
        });
        </script>

        <!-- FIN GRAFICO DE LINEAS-->
</div>
