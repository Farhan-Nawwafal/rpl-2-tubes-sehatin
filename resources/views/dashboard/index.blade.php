<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Heylth</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body class="bg-[#fffafa] min-h-screen">
    <x-layout>

        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-white p-4 rounded-lg shadow-sm bg-gradient-to-b from-[#E1F1FE] via-[#FAFCFF] to-[#FFFF]">
                    <h2 class="text-lg text-gray-600 mb-2">💤 Average Sleep Hours</h2>
                    <div class="text-3xl font-bold text-[#007DFC]">
                        {{-- {{ number_format($avgSleepHours, 1) }} --}}
                        1
                    </div>
                    <div class="text-gray-500 mt-1">hours per night</div>
                </div>

                {{-- 2. Average Meals Per Day --}}
                <div class="bg-white p-6 rounded-lg shadow-sm bg-gradient-to-b from-[#E1F1FE] via-[#FAFCFF] to-[#FFFF]">
                    <h1 class="text-xl mb-5 font-bold text-gray-600">
                        🍴 Average Meals Per Day
                    </h1>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                            <h2 class="text-sm font-semibold text-gray-600 mb-2">☀️ Breakfast</h2>
                            <div class="text-2xl font-bold text-[#007DFC]">
                                1
                            </div>
                            <div class="text-xs text-gray-500 mt-1">meals</div>
                        </div>

                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                            <h2 class="text-sm font-semibold text-gray-600 mb-2">🥪 Lunch</h2>
                            <div class="text-2xl font-bold text-[#007DFC]">
                                1
                            </div>
                            <div class="text-xs text-gray-500 mt-1">meals</div>
                        </div>

                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                            <h2 class="text-sm font-semibold text-gray-600 mb-2">🌙 Dinner</h2>
                            <div class="text-2xl font-bold text-[#007DFC]">
                                1
                            </div>
                            <div class="text-xs text-gray-500 mt-1">meals</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm bg-gradient-to-b from-[#E1F1FE] via-[#FAFCFF] to-[#FFFF]">
                    <h2 class="text-lg text-gray-600 mb-2">⌛ Average Screen Time</h2>
                    <div class="text-4xl font-bold text-[#007DFC]">
                        {{-- {{ number_format($avgScreenTime, 1) }} --}}
                        1
                    </div>
                    <div class="text-gray-500 mt-1">hours per day</div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm bg-gradient-to-b from-[#E1F1FE] via-[#FAFCFF] to-[#FFFF]">
                    <h2 class="text-lg text-gray-600 mb-2">Lifestyle Status</h2>
                    {{-- <div class="inline-block px-4 py-2 rounded-lg {{ $lifestyleColor }} text-white text-xl font-bold mt-2"> --}}
                    <div class="inline-block px-4 py-2 rounded-lg text-white text-xl font-bold mt-2">
                        {{-- {{ $lifestyleStatus }} --}}
                        1
                    </div>
                </div>

            </div>

            <div
                class="mt-8 bg-white p-6 rounded-lg shadow-sm bg-gradient-to-b from-[#E1F1FE] via-[#FAFCFF] to-[#FFFF]">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Screen Time Trend</h2>
                <div id="screenTimeChart" class="w-full h-[200px]"></div>
            </div>

        </div>
    </x-layout>

    {{-- <script>
        // Mengambil data dari Controller Laravel yang dikirim via JSON
        const chartData = @json($screenTimeChart);

        // Memisahkan label (tanggal) dan series (durasi)
        const categories = chartData.map(item => item.date);
        const seriesData = chartData.map(item => item.duration);

        var options = {
            series: [{
                name: "Duration (Hours)",
                data: seriesData
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                } // Biar bersih seperti recharts
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth', // 'monotone' di recharts mirip 'smooth' di sini
                width: 3,
                colors: ['#007DFC']
            },
            grid: {
                row: {
                    colors: ['transparent', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: categories,
                labels: {
                    style: {
                        colors: '#9ca3af'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#9ca3af'
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " hours"
                    }
                }
            },
            colors: ['#007DFC']
        };

        var chart = new ApexCharts(document.querySelector("#screenTimeChart"), options);
        chart.render();
    </script> --}}
</body>

</html>
