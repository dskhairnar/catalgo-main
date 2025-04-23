@extends('layouts.dashboard')

@section('title', 'Analytics')

@section('header', 'Analytics Dashboard')

@section('content')
    <div class="analytics-grid">
        <!-- Monthly Overview -->
        <div class="card">
            <div class="card-header">
                <h3>Monthly Overview</h3>
            </div>
            <div class="card-body">
                <div class="stats-grid">
                    <div class="stat-item">
                        <h4>New Users</h4>
                        <p class="stat-number">{{ $monthlyStats['users'] }}</p>
                    </div>
                    <div class="stat-item">
                        <h4>New Listings</h4>
                        <p class="stat-number">{{ $monthlyStats['listings'] }}</p>
                    </div>
                    <div class="stat-item">
                        <h4>Total Bookings</h4>
                        <p class="stat-number">{{ $monthlyStats['bookings'] }}</p>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- User Distribution -->
        <div class="card">
            <div class="card-header">
                <h3>User Distribution</h3>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="userDistributionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Listing Categories -->
        <div class="card">
            <div class="card-header">
                <h3>Listings by Category</h3>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <style>
        .analytics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-item {
            text-align: center;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #2F4F4F;
            margin-top: 0.5rem;
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
    </style>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Monthly Overview Chart
            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                    datasets: [{
                        label: 'Users',
                        data: @json($weeklyData['users']),
                        borderColor: '#2F4F4F',
                        tension: 0.1
                    }, {
                        label: 'Listings',
                        data: @json($weeklyData['listings']),
                        borderColor: '#4CAF50',
                        tension: 0.1
                    }, {
                        label: 'Bookings',
                        data: @json($weeklyData['bookings']),
                        borderColor: '#FFA500',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // User Distribution Chart
            const userDistCtx = document.getElementById('userDistributionChart').getContext('2d');
            new Chart(userDistCtx, {
                type: 'pie',
                data: {
                    labels: ['Regular Users', 'Business Users', 'Admins'],
                    datasets: [{
                        data: [
                            {{ $userDistribution['regular'] }},
                            {{ $userDistribution['business'] }},
                            {{ $userDistribution['admin'] }}
                        ],
                        backgroundColor: ['#2F4F4F', '#4CAF50', '#FFA500']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Category Chart
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            new Chart(categoryCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($categories->pluck('name')) !!},
                    datasets: [{
                        label: 'Number of Listings',
                        data: {!! json_encode($categories->pluck('count')) !!},
                        backgroundColor: '#4CAF50'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    @endpush
@endsection