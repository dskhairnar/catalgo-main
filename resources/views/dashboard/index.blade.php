@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Healthy Habitat Network" class="logo">
            <h1>Healthy Habitat Network</h1>
        </div>
        
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
            <a href="{{ route('bookings') }}" class="nav-item {{ request()->routeIs('bookings') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>My Bookings</span>
            </a>
            <a href="{{ route('services') }}" class="nav-item {{ request()->routeIs('services') ? 'active' : '' }}">
                <i class="fas fa-leaf"></i>
                <span>Services</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="dashboard-header">
            <div class="header-content">
                <h1>Welcome back, {{ Auth::user()->name }}! 👋</h1>
                <p class="welcome-message">Here's what's happening with your account today.</p>
            </div>
            <div class="user-profile">
                <div class="user-avatar">
                    <span class="user-initial">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-email">{{ Auth::user()->email }}</span>
                </div>
            </div>
        </header>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- My Bookings Card -->
            <div class="dashboard-card">
                <div class="card-icon booking-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="card-content">
                    <h2>My Bookings</h2>
                    <p>View and manage your service bookings</p>
                    <a href="{{ route('bookings') }}" class="card-link">
                        View Bookings
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Explore Services Card -->
            <div class="dashboard-card">
                <div class="card-icon service-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="card-content">
                    <h2>Explore Services</h2>
                    <p>Discover eco-friendly and sustainable services</p>
                    <a href="{{ route('services') }}" class="card-link">
                        Browse Services
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- My Profile Card -->
            <div class="dashboard-card">
                <div class="card-icon profile-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="card-content">
                    <h2>My Profile</h2>
                    <p>Update your personal information</p>
                    <a href="{{ route('profile') }}" class="card-link">
                        Edit Profile
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Recent Activity Card -->
            <div class="dashboard-card">
                <div class="card-icon activity-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card-content">
                    <h2>Recent Activity</h2>
                    <p>No recent activity to display</p>
                    <div class="activity-placeholder">
                        <i class="fas fa-history"></i>
                        <span>Your activity will appear here</span>
                    </div>
                </div>
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
        background-color: #f8f9fa;
    }

    /* Sidebar Styles */
    .sidebar {
        width: 280px;
        background-color: #ffffff;
        padding: 2rem;
        box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        position: fixed;
        height: 100vh;
        overflow-y: auto;
    }

    .logo-container {
        text-align: center;
        margin-bottom: 2rem;
        padding: 1rem;
        border-radius: 12px;
        background-color: #f8f9fa;
    }

    .logo {
        width: 80px;
        height: auto;
        margin-bottom: 1rem;
        transition: transform 0.3s ease;
    }

    .logo:hover {
        transform: scale(1.05);
    }

    .logo-container h1 {
        font-size: 1.2rem;
        color: #2d3436;
        margin: 0;
        font-weight: 600;
    }

    .sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .nav-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        color: #636e72;
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .nav-item i {
        width: 24px;
        margin-right: 1rem;
        font-size: 1.1rem;
    }

    .nav-item:hover {
        background-color: #f1f3f5;
        color: #2d3436;
        transform: translateX(5px);
    }

    .nav-item.active {
        background-color: #4CAF50;
        color: white;
    }

    /* Main Content Styles */
    .main-content {
        flex: 1;
        margin-left: 280px;
        padding: 2rem;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .header-content h1 {
        font-size: 1.8rem;
        color: #2d3436;
        margin: 0 0 0.5rem 0;
    }

    .welcome-message {
        color: #636e72;
        margin: 0;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.5rem 1rem;
        background-color: #f8f9fa;
        border-radius: 12px;
    }

    .user-avatar {
        width: 48px;
        height: 48px;
        background-color: #4CAF50;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .user-initial {
        color: white;
        font-size: 1.5rem;
        font-weight: 500;
    }

    .user-info {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 500;
        color: #2d3436;
    }

    .user-email {
        font-size: 0.9rem;
        color: #636e72;
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
        transition: all 0.3s ease;
        display: flex;
        gap: 1.5rem;
        align-items: flex-start;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }

    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
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

    .card-content {
        flex: 1;
    }

    .dashboard-card h2 {
        font-size: 1.25rem;
        color: #2d3436;
        margin: 0 0 0.5rem 0;
        font-weight: 600;
    }

    .dashboard-card p {
        color: #636e72;
        margin: 0 0 1.5rem 0;
        line-height: 1.5;
    }

    .card-link {
        color: #4CAF50;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .card-link:hover {
        color: #388e3c;
        gap: 0.75rem;
    }

    .activity-placeholder {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #636e72;
        font-size: 0.9rem;
    }

    .activity-placeholder i {
        font-size: 1.2rem;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .main-content {
            margin-left: 0;
        }

        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .user-profile {
            width: 100%;
            justify-content: center;
        }

        .dashboard-card {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .card-icon {
            margin-bottom: 1rem;
        }
    }
</style>
@endpush
@endsection 