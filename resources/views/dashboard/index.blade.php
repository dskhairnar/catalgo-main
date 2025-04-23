@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="{{ asset('/public/images/forest.png') }}" alt="Healthy Habitat Network" class="logo">
            <h1>Healthy Habitat Network</h1>
        </div>
        
        <nav class="sidebar-nav">
            <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('about') }}" class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                <i class="fas fa-info-circle"></i>
                <span>About</span>
            </a>
            <a href="{{ route('services') }}" class="nav-item {{ request()->routeIs('services') ? 'active' : '' }}">
                <i class="fas fa-th"></i>
                <span>Services</span>
            </a>
            <a href="{{ route('contact') }}" class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i>
                <span>Contact</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="dashboard-header">
            <h1>Welcome, {{ Auth::user()->name }}!</h1>
            <div class="user-profile">
                <span class="user-initial">{{ substr(Auth::user()->name, 0, 1) }}.</span>
                <span class="user-name">{{ Auth::user()->name }}</span>
            </div>
        </header>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- My Bookings Card -->
            <div class="dashboard-card">
                <div class="card-icon booking-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h2>My Bookings</h2>
                <p>View and manage your service bookings</p>
                <a href="{{ route('bookings') }}" class="card-link">View Bookings</a>
            </div>

            <!-- Explore Services Card -->
            <div class="dashboard-card">
                <div class="card-icon service-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h2>Explore Services</h2>
                <p>Discover eco-friendly and sustainable services</p>
                <a href="{{ route('services') }}" class="card-link">Browse Services</a>
            </div>

            <!-- My Profile Card -->
            <div class="dashboard-card">
                <div class="card-icon profile-icon">
                    <i class="fas fa-user"></i>
                </div>
                <h2>My Profile</h2>
                <p>Update your personal information</p>
                <a href="{{ route('profile') }}" class="card-link">Edit Profile</a>
            </div>

            <!-- Recent Activity Card -->
            <div class="dashboard-card">
                <div class="card-icon activity-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h2>Recent Activity</h2>
                <p>No recent activity to display</p>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .dashboard-container {
        display: flex;
        min-height: 100vh;
        background-color: #fafafa;
    }

    /* Sidebar Styles */
    .sidebar {
        width: 280px;
        background-color: #ffffff;
        padding: 2rem;
        box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    }

    .logo-container {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .logo {
        width: 40px;
        height: 40px;
    }

    .logo-container h1 {
        font-size: 1.2rem;
        color: #2d3436;
        margin: 0;
    }

    .sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem 1rem;
        color: #636e72;
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .nav-item:hover, .nav-item.active {
        background-color: #f1f2f6;
        color: #2d3436;
    }

    /* Main Content Styles */
    .main-content {
        flex: 1;
        padding: 2rem;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .dashboard-header h1 {
        font-size: 2rem;
        color: #2d3436;
        margin: 0;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-initial {
        width: 40px;
        height: 40px;
        background-color: #2d3436;
        color: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    /* Dashboard Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .dashboard-card {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }

    .card-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }

    .booking-icon {
        background-color: #e3f2fd;
        color: #1976d2;
    }

    .service-icon {
        background-color: #e8f5e9;
        color: #388e3c;
    }

    .profile-icon {
        background-color: #fff3e0;
        color: #f57c00;
    }

    .activity-icon {
        background-color: #f3e5f5;
        color: #8e24aa;
    }

    .dashboard-card h2 {
        font-size: 1.25rem;
        color: #2d3436;
        margin: 0 0 0.5rem 0;
    }

    .dashboard-card p {
        color: #636e72;
        margin: 0 0 1.5rem 0;
    }

    .card-link {
        color: #2d3436;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-link:hover {
        color: #1976d2;
    }

    .card-link::after {
        content: '→';
        transition: transform 0.3s ease;
    }

    .card-link:hover::after {
        transform: translateX(5px);
    }
</style>
@endpush
@endsection 