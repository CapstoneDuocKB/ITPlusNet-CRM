<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <!-- Título del Dashboard -->
                <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Resumen de Soportes</h1>

                <!-- Contenedor de los Gráficos -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    
                    <!-- Gráfico de Pastel -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4 text-center">Soportes por Sucursal</h2>
                        <div class="flex justify-center">
                            <canvas id="soportesPieChart" class="w-48 h-48"></canvas>
                        </div>
                    </div>

                    <!-- Gráfico de Barras Apiladas -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4 text-center">Soportes Urgentes vs No Urgentes</h2>
                        <div class="flex justify-center">
                            <canvas id="soportesBarChart" class="w-full h-64"></canvas>
                        </div>
                    </div>

                </div>

                <!-- Segunda Fila: Gráfico de Línea -->
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4 text-center">Evolución de Soportes por Mes</h2>
                    <div class="flex justify-center">
                        <canvas id="soportesLineChart" class="w-full h-64"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Incluir Chart.js desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Datos Ficticios -->
    <script>
        // Datos Ficticios para Pruebas
        const testChartData = {
            pie: {
                labels: ['Sucursal A', 'Sucursal B', 'Sucursal C', 'Sucursal D'],
                data: [10, 20, 30, 40],
            },
            bar: {
                labels: ['Sucursal A', 'Sucursal B', 'Sucursal C', 'Sucursal D'],
                datasets: [
                    {
                        label: 'Urgente',
                        data: [5, 10, 15, 20],
                        backgroundColor: '#FF6384',
                    },
                    {
                        label: 'No Urgente',
                        data: [5, 10, 15, 20],
                        backgroundColor: '#36A2EB',
                    },
                ],
            },
            line: {
                labels: ['Ene 2024', 'Feb 2024', 'Mar 2024', 'Abr 2024', 'May 2024', 'Jun 2024', 'Jul 2024', 'Ago 2024', 'Sep 2024', 'Oct 2024', 'Nov 2024', 'Dic 2024'],
                datasets: [
                    {
                        label: 'Soportes Creados',
                        data: [12, 19, 3, 5, 2, 3, 7, 11, 9, 6, 4, 8],
                        fill: false,
                        borderColor: '#4BC0C0',
                        backgroundColor: '#4BC0C0',
                        tension: 0.1
                    },
                ],
            },
        };
    </script>

    <!-- Lógica de los Gráficos y Variable de Control -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // **Definir la variable para usar datos ficticios**
            // Cambia esta variable a 'true' para usar datos ficticios o 'false' para usar datos reales.
            const useTestData = true; 

            // **Datos Reales provenientes del controlador**
            const realChartData = {
                pie: {
                    labels: @json($chartData['labels']),
                    data: @json($chartData['data']),
                },
                bar: {
                    labels: @json($barChartData['labels']),
                    datasets: @json($barChartData['datasets']),
                },
                line: {
                    labels: @json($lineChartData['labels']),
                    datasets: @json($lineChartData['datasets']),
                },
            };

            // **Datos Ficticios ya definidos en testChartData**
            const testData = testChartData;

            // **Seleccionar los datos actuales según la bandera**
            const currentData = useTestData ? testData : realChartData;

            // **Inicializar los Gráficos con los Datos Seleccionados**

            // Gráfico de Pastel
            const ctxPie = document.getElementById('soportesPieChart').getContext('2d');
            const soportesPieChart = new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: currentData.pie.labels,
                    datasets: [{
                        data: currentData.pie.data,
                        backgroundColor: [
                            '#FF6384',
                            '#36A2EB',
                            '#FFCE56',
                            '#4BC0C0',
                            '#9966FF',
                            '#FF9F40',
                            '#C9CBCF',
                            '#8E44AD',
                            '#2ECC71',
                            '#E74C3C'
                        ],
                        borderColor: '#ffffff',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 20,
                                padding: 15,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        title: {
                            display: false,
                            text: 'Cantidad de Soportes por Sucursal'
                        }
                    }
                }
            });

            // Gráfico de Barras Apiladas
            const ctxBar = document.getElementById('soportesBarChart').getContext('2d');
            const soportesBarChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: currentData.bar.labels,
                    datasets: currentData.bar.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: true,
                            title: {
                                display: true,
                                text: 'Sucursal'
                            }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Cantidad de Soportes'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                boxWidth: 20,
                                padding: 10,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        title: {
                            display: false,
                            text: 'Soportes Urgentes vs No Urgentes por Sucursal'
                        }
                    }
                }
            });

            // Gráfico de Línea
            const ctxLine = document.getElementById('soportesLineChart').getContext('2d');
            const soportesLineChart = new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: currentData.line.labels,
                    datasets: currentData.line.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Mes'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Cantidad de Soportes'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                boxWidth: 20,
                                padding: 10,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        title: {
                            display: false,
                            text: 'Evolución de Soportes por Mes'
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
