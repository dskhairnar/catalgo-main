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
                <div class="user-avatar">
                    <span class="user-initial">{{ substr($user->name, 0, 1) }}</span>
                </div>
                <div class="user-info">
                    <span class="user-name">{{ $user->name }}</span>
                    <span class="user-email">{{ $user->email }}</span>
                </div>
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
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
                <div class="card-header">
                    <h2><i class="fas fa-user-circle me-2"></i>Personal Information</h2>
                </div>
                <form action="{{ route('profile.update') }}" method="POST" class="profile-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-user me-2"></i>Full Name
                        </label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="phone">
                            <i class="fas fa-phone me-2"></i>Phone Number
                        </label>
                        <input type="tel" id="phone" name="phone" value="{{ $user->phone }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="address">
                            <i class="fas fa-map-marker-alt me-2"></i>Address
                        </label>
                        <textarea id="address" name="address" class="form-control" rows="3">{{ $user->address }}</textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <div class="profile-card">
                <div class="card-header">
                    <h2><i class="fas fa-lock me-2"></i>Change Password</h2>
                </div>
                <form action="{{ route('profile.password.update') }}" method="POST" class="profile-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="current_password">
                            <i class="fas fa-key me-2"></i>Current Password
                        </label>
                        <input type="password" id="current_password" name="current_password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">
                            <i class="fas fa-lock me-2"></i>New Password
                        </label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">
                            <i class="fas fa-lock me-2"></i>Confirm New Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-key me-2"></i>Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    /* Dashboard Container */
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
    }

    .logo {
        width: 80px;
        height: auto;
        margin-bottom: 1rem;
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
        padding: 1rem;
        color: #2d3436;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .nav-item i {
        width: 24px;
        margin-right: 1rem;
    }

    .nav-item:hover {
        background-color: #f1f3f5;
    }

    .nav-item.active {
        background-color: #4CAF50;
        color: white;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        margin-left: 280px;
        padding: 2rem;
    }

    /* Header Styles */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e9ecef;
    }

    .dashboard-header h1 {
        font-size: 1.8rem;
        color: #2d3436;
        margin: 0;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 1rem;
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
        color: #6c757d;
    }

    /* Profile Content */
    .profile-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .profile-card {
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .card-header {
        background-color: #f8f9fa;
        padding: 1.5rem;
        border-bottom: 1px solid #e9ecef;
    }

    .card-header h2 {
        font-size: 1.25rem;
        color: #2d3436;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .card-header h2 i {
        color: #4CAF50;
    }

    .profile-form {
        padding: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        color: #2d3436;
        font-weight: 500;
    }

    .form-group label i {
        color: #4CAF50;
        width: 20px;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        color: #2d3436;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
    }

    .form-actions {
        margin-top: 2rem;
        display: flex;
        justify-content: flex-end;
    }

    .btn-save {
        background-color: #4CAF50;
        color: #ffffff;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-save:hover {
        background-color: #3d8b40;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Alert Styles */
    .alert {
        padding: 1rem;
        margin-bottom: 2rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
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

    .alert i {
        font-size: 1.2rem;
        margin-right: 0.5rem;
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

    /* Responsive Design */
    @media (max-width: 1024px) {
        .profile-content {
            grid-template-columns: 1fr;
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
    }
</style>
@endpush
@endsection 