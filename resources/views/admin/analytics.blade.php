@extends('layouts.admin')

@section('title', 'Analytics Dashboard')

@section('content')
@push('styles')
	
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .stat-card {
        background: rgba(30, 41, 59, 0.7);
        border: 1px solid rgba(129, 140, 153, 0.3);
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        background: rgba(0, 247, 255, 0.1);
        border-color: #00f7ff;
        transform: translateY(-5px);
    }
    
    .chart-container {
        position: relative;
        height: 300px;
    }
</style>
@endpush

<div class="container mx-auto px-4 py-8">
    <!-- Page Title -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Analytics Dashboard</h2>
        <p class="text-gray-400">Business insights and performance metrics</p>
    </div>
    
    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card p-6 rounded-xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-gray-400">Total Revenue</h3>
                <i class="fas fa-dollar-sign text-2xl text-neon"></i>
            </div>
            <p class="text-3xl font-bold text-white mb-2">৳{{ number_format($analytics['total_revenue']) }}</p>
            <p class="text-green-500 flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> {{ $analytics['revenue_growth'] }}% from last month
            </p>
        </div>
        
        <div class="stat-card p-6 rounded-xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-gray-400">Total Orders</h3>
                <i class="fas fa-shopping-cart text-2xl text-neon"></i>
            </div>
            <p class="text-3xl font-bold text-white mb-2">{{ number_format($analytics['total_orders']) }}</p>
            <p class="text-green-500 flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> {{ $analytics['orders_growth'] }}% from last month
            </p>
        </div>
        
        <div class="stat-card p-6 rounded-xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-gray-400">Total Users</h3>
                <i class="fas fa-users text-2xl text-neon"></i>
            </div>
            <p class="text-3xl font-bold text-white mb-2">{{ number_format($analytics['total_users']) }}</p>
            <p class="text-green-500 flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> {{ $analytics['users_growth'] }}% from last month
            </p>
        </div>
        
        <div class="stat-card p-6 rounded-xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-gray-400">Conversion Rate</h3>
                <i class="fas fa-percentage text-2xl text-neon"></i>
            </div>
            <p class="text-3xl font-bold text-white mb-2">{{ $analytics['conversion_rate'] }}%</p>
            <p class="text-red-500 flex items-center">
                <i class="fas fa-arrow-down mr-1"></i> 0.3% from last month
            </p>
        </div>
    </div>
    
    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Revenue Chart -->
        <div class="admin-card neon-border p-6">
            <h3 class="text-xl font-bold text-white mb-6">Monthly Revenue</h3>
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
        
        <!-- Orders Chart -->
        <div class="admin-card neon-border p-6">
            <h3 class="text-xl font-bold text-white mb-6">Orders by Category</h3>
            <div class="chart-container">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>
    </div>
</div>
@push('scripts')
	
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: @json($analytics['revenue_chart']['labels']),
            datasets: [{
                label: 'Revenue ($)',
                data: @json($analytics['revenue_chart']['data']),
                borderColor: '#00f7ff',
                backgroundColor: 'rgba(0, 247, 255, 0.1)',
                borderWidth: 3,
                pointBackgroundColor: '#00f7ff',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(129, 140, 153, 0.2)' },
                    ticks: { color: '#94a3b8' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8' }
                }
            }
        }
    });
    
    // Orders Chart
    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ordersCtx, {
        type: 'doughnut',
        data: {
            labels: @json($analytics['orders_chart']['labels']),
            datasets: [{
                data: @json($analytics['orders_chart']['data']),
                backgroundColor: ['#00f7ff', '#8b5cf6', '#3b82f6', '#10b981', '#f59e0b', '#ef4444'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: { color: '#94a3b8', padding: 20 }
                }
            },
            cutout: '65%'
        }
    });
});
</script>
@endpush
@endsection
