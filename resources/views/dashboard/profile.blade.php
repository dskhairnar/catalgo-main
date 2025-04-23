@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="{{ asset('images/logo.svg') }}" alt="Healthy Habitat Network" class="logo">
            <h1>Healthy Habitat Network</h1>
        </div>
        
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('profile') }}" class="nav-item active">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
            <a href="{{ route('bookings') }}" class="nav-item">
                <i class="fas fa-calendar-check"></i>
                <span>My Bookings</span>
            </a>
            <a href="{{ route('services') }}" class="nav-item">
                <i class="fas fa-leaf"></i>
                <span>Services</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="dashboard-header">
            <h1>My Profile</h1>
            <div class="user-profile">
                <span class="user-initial">{{ substr($user->name, 0, 1) }}.</span>
                <span class="user-name">{{ $user->name }}</span>
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Profile Content -->
        <div class="profile-content">
            <div class="profile-card">
                <h2>Personal Information</h2>
                <form action="{{ route('profile.update') }}" method="POST" class="profile-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="{{ $user->phone }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" class="form-control" rows="3">{{ $user->address }}</textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">Save Changes</button>
                    </div>
                </form>
            </div>

            <div class="profile-card">
                <h2>Change Password</h2>
                <form action="{{ route('password.update') }}" method="POST" class="profile-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    /* Reuse existing dashboard styles */
    .dashboard-container {
        display: flex;
        min-height: 100vh;
        background-color: #fafafa;
    }

    .sidebar {
        width: 280px;
        background-color: #ffffff;
        padding: 2rem;
        box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    }

    /* Profile specific styles */
    .profile-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .profile-card {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .profile-card h2 {
        font-size: 1.25rem;
        color: #2d3436;
        margin: 0 0 1.5rem 0;
    }

    .profile-form .form-group {
        margin-bottom: 1.5rem;
    }

    .profile-form label {
        display: block;
        margin-bottom: 0.5rem;
        color: #2d3436;
        font-weight: 500;
    }

    .profile-form .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        color: #2d3436;
        transition: all 0.3s ease;
    }

    .profile-form .form-control:focus {
        outline: none;
        border-color: #1976d2;
        box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
    }

    .profile-form .btn-save {
        background-color: #1976d2;
        color: #ffffff;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .profile-form .btn-save:hover {
        background-color: #1565c0;
        transform: translateY(-1px);
    }

    .form-actions {
        margin-top: 2rem;
    }

    @media (max-width: 1024px) {
        .profile-content {
            grid-template-columns: 1fr;
        }
    }

    /* Reuse other existing styles */
    .logo-container, .sidebar-nav, .nav-item, .dashboard-header, .user-profile {
        /* These styles are inherited from the dashboard */
    }

    /* Alert Styles */
    .alert {
        padding: 1rem;
        margin-bottom: 2rem;
        border-radius: 8px;
    }

    .alert-success {
        background-color: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #a5d6a7;
    }

    .alert-danger {
        background-color: #ffebee;
        color: #c62828;
        border: 1px solid #ef9a9a;
    }

    .alert ul {
        margin: 0;
        padding-left: 1.5rem;
    }

    .alert ul li {
        margin-bottom: 0.25rem;
    }

    .alert ul li:last-child {
        margin-bottom: 0;
    }
</style>
@endpush
@endsection 