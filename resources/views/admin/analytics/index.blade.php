@extends('admin.layouts.sidebar')

@section('content')
<div class="p-6">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-6">Analytics Dashboard</h1>

    <div class="mb-6">
        <label for="dateRange" class="block text-gray-700 font-semibold">Select Date Range:</label>
        <input type="text" id="dateRange" class="mt-1 block w-full sm:w-64 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Total Orders</h2>
            <p id="totalOrders" class="text-4xl font-bold mt-2">0</p>
        </div>
        <div class="bg-gradient-to-r from-teal-600 to-emerald-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Total Revenue</h2>
            <p id="totalRevenue" class="text-4xl font-bold mt-2">$0.00</p>
        </div>
        <div class="bg-gradient-to-r from-amber-500 to-yellow-600 text-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold">Average Order Value</h2>
            <p id="averageOrderValue" class="text-4xl font-bold mt-2">$0.00</p>
        </div>
        <div class="bg-gradient-to-r from-purple-500 to-pink-600 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Profit</h2>
            <p id="profit" class="text-4xl font-bold mt-2">$0.00</p>
        </div>
    </div>

    <div class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800">Revenue Comparison</h2>
        <p id="revenueComparison" class="text-xl mt-2">Loading...</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-10">
        <div class="bg-white p-6 rounded-lg shadow flex flex-col">
            <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">Order Status</h2>
            <div class="flex-grow">
                <div class="relative w-full h-0" style="padding-bottom: 56.25%;">
                    <canvas id="statusChart" class="absolute top-0 left-0 w-full h-full"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow flex flex-col">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Daily Orders & Revenue</h2>
            <div class="flex-grow">
                <div class="relative w-full h-0" style="padding-bottom: 56.25%;">
                    <canvas id="dailyChart" class="absolute top-0 left-0 w-full h-full"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-center mt-10">
        <div class="bg-white p-6 rounded-lg shadow w-full lg:w-1/2 flex flex-col">
            <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">Best-Selling Products</h2>
            <div class="flex-grow">
                <div class="relative w-full h-0" style="padding-bottom: 56.25%;">
                    <canvas id="bestSellingChart" class="absolute top-0 left-0 w-full h-full"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow mt-10">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Top Customers</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-indigo-600 to-blue-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-white">Customer</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-white">Total Spent</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-white">Orders</th>
                    </tr>
                </thead>
                <tbody id="topCustomers" class="bg-white divide-y divide-gray-200 overflow-y-auto">
                    <!-- Rows will be populated via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#dateRange", {
            mode: "range",
            dateFormat: "Y-m-d",
            defaultDate: ["{{ \Carbon\Carbon::now()->subMonth()->format('Y-m-d') }}", "{{ \Carbon\Carbon::now()->format('Y-m-d') }}"],
            onClose: function(selectedDates, dateStr, instance) {
                fetchAnalyticsData();
            }
        });

        function fetchAnalyticsData() {
            let dateRange = document.getElementById('dateRange').value;
            let startDate, endDate;
            if (dateRange.includes(' to ')) {
                [startDate, endDate] = dateRange.split(' to ');
            } else if (dateRange.includes(' ')) {
                [startDate, endDate] = dateRange.split(' ');
            } else {
                startDate = endDate = dateRange;
            }

            fetch(`{{ route('analytics.data') }}?startDate=${startDate}&endDate=${endDate}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error:', data.error);
                        return;
                    }

                    document.getElementById('totalOrders').innerText = data.totalOrders;
                    document.getElementById('totalRevenue').innerText = '$' + data.totalRevenue.toFixed(2);
                    document.getElementById('averageOrderValue').innerText = '$' + data.averageOrderValue.toFixed(2);
                    document.getElementById('profit').innerText = '$' + data.profit.toFixed(2);

                    let comparisonText = data.revenueComparison !== null ?
                        (data.revenueComparison >= 0 ?
                            `An increase of ${data.revenueComparison.toFixed(2)}% compared to the previous period.` :
                            `A decrease of ${Math.abs(data.revenueComparison).toFixed(2)}% compared to the previous period.`) :
                        'No previous data for comparison.';
                    document.getElementById('revenueComparison').innerText = comparisonText;

                    updateStatusChart(data.statusCounts);
                    updateDailyChart(data.dailyData);
                    updateBestSellingChart(data.bestSellingProducts);
                    updateTopCustomersTable(data.topCustomers);
                })
                .catch(error => console.error('Error fetching analytics data:', error));
        }

        let statusChart, dailyChart, bestSellingChart;

        function updateStatusChart(statusCounts) {
            let ctx = document.getElementById('statusChart').getContext('2d');
            if (statusChart) statusChart.destroy();
            statusChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(statusCounts),
                    datasets: [{
                        data: Object.values(statusCounts),
                        backgroundColor: ['#34D399', '#FBBF24', '#F87171', '#A78BFA', '#6366F1', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
        }

        function updateDailyChart(dailyData) {
            let ctx = document.getElementById('dailyChart').getContext('2d');
            if (dailyChart) dailyChart.destroy();
            let labels = Object.keys(dailyData);
            let ordersData = labels.map(date => dailyData[date].totalOrders);
            let revenueData = labels.map(date => dailyData[date].totalRevenue);

            dailyChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Orders',
                            data: ordersData,
                            borderColor: '#3B82F6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            yAxisID: 'y'
                        },
                        {
                            label: 'Revenue',
                            data: revenueData,
                            borderColor: '#10B981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            yAxisID: 'y1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Orders'
                            }
                        },
                        y1: {
                            type: 'linear',
                            position: 'right',
                            grid: {
                                drawOnChartArea: false
                            },
                            title: {
                                display: true,
                                text: 'Revenue ($)'
                            }
                        }
                    }
                }
            });
        }

        function updateBestSellingChart(bestSellingProducts) {
            let ctx = document.getElementById('bestSellingChart').getContext('2d');
            if (bestSellingChart) bestSellingChart.destroy();
            let labels = bestSellingProducts.map(item => item.name);
            let data = bestSellingProducts.map(item => item.totalQuantity);

            bestSellingChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Quantity Sold',
                        data: data,
                        backgroundColor: '#6366F1'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
        }

        function updateTopCustomersTable(topCustomers) {
            let tbody = document.getElementById('topCustomers');
            tbody.innerHTML = '';
            topCustomers.forEach(customer => {
                let row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-6 py-4">${customer.customer}</td>
                    <td class="px-6 py-4">$${customer.total_spent.toFixed(2)}</td>
                    <td class="px-6 py-4">${customer.orders}</td>
                `;
                tbody.appendChild(row);
            });
        }

        fetchAnalyticsData();

        // Refresh every 60 seconds
        // setInterval(fetchAnalyticsData, 60000); 
    });
</script>
@endsection