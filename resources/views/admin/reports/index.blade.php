@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<div class="min-h-screen bg-gray-100" x-data="{ sidebarOpen: false }">
    @include('admin.partials.sidebar')

    <div class="lg:pl-64">
        @include('admin.partials.topbar')

        <div class="p-6">
            <div class="space-y-6">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Reports & Analytics</h1>
                        <p class="text-gray-500">Business data summary for your ISP</p>
                    </div>
                    <div class="mt-4 md:mt-0 flex flex-wrap gap-2">
                        <select id="period" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                            <option value="today">Today</option>
                            <option value="week">This Week</option>
                            <option value="month" selected>This Month</option>
                            <option value="year">This Year</option>
                        </select>
                        <select id="exportType" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                            <option value="summary">Summary</option>
                            <option value="revenue">Revenue</option>
                            <option value="customers">Customers</option>
                            <option value="invoices">Invoices</option>
                            <option value="packages">Packages</option>
                            <option value="collectors">Collectors</option>
                        </select>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center">
                                <i class="fas fa-download mr-2"></i>Export
                                <i class="fas fa-chevron-down ml-2 text-xs"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border z-10">
                                <button onclick="exportReport('csv')" class="w-full px-4 py-2 text-left hover:bg-gray-100 rounded-t-lg">
                                    <i class="fas fa-file-csv mr-2 text-green-600"></i>CSV
                                </button>
                                <button onclick="exportReport('json')" class="w-full px-4 py-2 text-left hover:bg-gray-100 rounded-b-lg">
                                    <i class="fas fa-file-code mr-2 text-blue-600"></i>JSON
                                </button>
                            </div>
                        </div>
                        <a href="{{ route('admin.reports.daily') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-calendar-day mr-2"></i>Daily
                        </a>
                        <a href="{{ route('admin.reports.monthly') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                            <i class="fas fa-calendar-alt mr-2"></i>Monthly
                        </a>
                    </div>
                </div>

    <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Revenue</p>
                                <p class="text-2xl font-bold text-green-600"> ₱ {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                                <p class="text-sm {{ ($revenueGrowth ?? 0) >= 0 ? 'text-green-500' : 'text-red-500' }}">
                                    <i class="fas fa-{{ ($revenueGrowth ?? 0) >= 0 ? 'arrow-up' : 'arrow-down' }} mr-1"></i>
                                    {{ abs($revenueGrowth ?? 0) }}% from previous period
                                </p>
                            </div>
                            <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-money-bill-wave text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Active Customers</p>
                                <p class="text-2xl font-bold text-cyan-600">{{ number_format($activeCustomers ?? 0) }}</p>
                                <p class="text-sm {{ ($customerGrowth ?? 0) >= 0 ? 'text-green-500' : 'text-red-500' }}">
                                    <i class="fas fa-{{ ($customerGrowth ?? 0) >= 0 ? 'arrow-up' : 'arrow-down' }} mr-1"></i>
                                    {{ abs($customerGrowth ?? 0) }}% growth
                                </p>
                            </div>
                            <div class="w-14 h-14 bg-cyan-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-users text-cyan-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Paid Invoices</p>
                                <p class="text-2xl font-bold text-blue-600">{{ number_format($paidInvoices ?? 0) }}</p>
                                <p class="text-sm text-gray-500">
                                    of {{ number_format($totalInvoices ?? 0) }} total invoices
                                </p>
                            </div>
                            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-file-invoice-dollar text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Voucher Sales</p>
                                <p class="text-2xl font-bold text-purple-600">{{ number_format($voucherSales ?? 0) }}</p>
                                <p class="text-sm text-gray-500">
                                    ₱ {{ number_format($voucherRevenue ?? 0, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-ticket text-purple-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

    <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Revenue Chart -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Monthly Revenue</h3>
                        <canvas id="revenueChart" height="250"></canvas>
                    </div>

        <!-- Customer Growth Chart -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Customer Growth</h3>
                        <canvas id="customerChart" height="250"></canvas>
                    </div>
                </div>

    <!-- More Charts -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Package Distribution -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Package Distribution</h3>
                        <canvas id="packageChart" height="250"></canvas>
                    </div>

        <!-- Payment Methods -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Payment Methods</h3>
                        <canvas id="paymentChart" height="250"></canvas>
                    </div>

        <!-- Invoice Status -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Invoice Status</h3>
                        <canvas id="invoiceChart" height="250"></canvas>
                    </div>
                </div>

    <!-- Tables Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Packages -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="p-6 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-800">Best Selling Packages</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Package</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customers</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Revenue</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($topPackages ?? [] as $package)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="font-medium text-gray-800">{{ $package->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $package->speed }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">{{ $package->customers_count }}</td>
                                        <td class="px-6 py-4 text-green-600 font-medium"> ₱ {{ number_format($package->revenue, 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">No data available</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

        <!-- Top Collectors -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="p-6 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-800">Top Collectors</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bills</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($topCollectors ?? [] as $collector)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                    <i class="fas fa-user text-blue-600 text-sm"></i>
                                                </div>
                                                <div class="font-medium text-gray-800">{{ $collector->name }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">{{ $collector->collections_count }}</td>
                                        <td class="px-6 py-4 text-green-600 font-medium"> ₱ {{ number_format($collector->total_collected, 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">No data available</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

    <!-- Agent Performance -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800">Agent Performance</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Agent</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vouchers Sold</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Revenue</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commission</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Balance</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($agentPerformance ?? [] as $agent)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-store text-emerald-600 text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-800">{{ $agent->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $agent->phone }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $agent->vouchers_sold }}</td>
                                    <td class="px-6 py-4 text-gray-600"> ₱ {{ number_format($agent->revenue, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-purple-600"> ₱ {{ number_format($agent->commission, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-green-600 font-medium">₱  {{ number_format($agent->balance, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($revenueLabels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) !!},
        datasets: [{
            label: 'Revenue',
            data: {!! json_encode($revenueData ?? [0, 0, 0, 0, 0, 0]) !!},
            borderColor: '#0891b2',
            backgroundColor: 'rgba(8, 145, 178, 0.1)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return '₱ ' + value.toLocaleString('en-US');
                    }
                }
            }
        }
    }
});

// Customer Growth Chart
const customerCtx = document.getElementById('customerChart').getContext('2d');
new Chart(customerCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($customerLabels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) !!},
        datasets: [{
            label: 'New Customers',
            data: {!! json_encode($customerData ?? [0, 0, 0, 0, 0, 0]) !!},
            backgroundColor: '#06b6d4'
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } }
    }
});

// Package Distribution Chart
const packageCtx = document.getElementById('packageChart').getContext('2d');
new Chart(packageCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($packageLabels ?? ['Package A', 'Package B', 'Package C']) !!},
        datasets: [{
            data: {!! json_encode($packageData ?? [30, 40, 30]) !!},
            backgroundColor: ['#0891b2', '#06b6d4', '#22d3ee', '#67e8f9', '#a5f3fc']
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } }
    }
});

// Payment Methods Chart
const paymentCtx = document.getElementById('paymentChart').getContext('2d');
new Chart(paymentCtx, {
    type: 'pie',
    data: {
        labels: {!! json_encode($paymentLabels ?? ['Cash', 'Transfer', 'QRph']) !!},
        datasets: [{
            data: {!! json_encode($paymentData ?? [40, 35, 25]) !!},
            backgroundColor: ['#10b981', '#3b82f6', '#8b5cf6']
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } }
    }
});

// Invoice Status Chart
const invoiceCtx = document.getElementById('invoiceChart').getContext('2d');
new Chart(invoiceCtx, {
    type: 'doughnut',
    data: {
        labels: ['Paid', 'Unpaid', 'Overdue'],
        datasets: [{
            data: {!! json_encode($invoiceStatusData ?? [60, 25, 15]) !!},
            backgroundColor: ['#10b981', '#f59e0b', '#ef4444']
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } }
    }
});

function exportReport(format = 'csv') {
    const period = document.getElementById('period').value;
    const type = document.getElementById('exportType').value;
    window.location.href = `/admin/reports/export?period=${period}&type=${type}&format=${format}`;
}
</script>
            </div>
        </div>
    </div>
</div>
@endsection
