@extends('layouts.dashboard')

@section('title', 'User Dashboard')

@section('sidebar-menu')
    <li><a href="{{ route('dashboard') }}" class="active"><i class="fas fa-home me-2"></i>Dashboard</a></li>
    <li><a href="{{ route('user.profile') }}"><i class="fas fa-user me-2"></i>My Profile</a></li>
    <li><a href="{{ route('user.bookings') }}"><i class="fas fa-calendar-check me-2"></i>My Bookings</a></li>
    <li><a href="{{ route('user.saved') }}"><i class="fas fa-heart me-2"></i>Saved Items</a></li>
    <li><a href="{{ route('services.browse') }}"><i class="fas fa-leaf me-2"></i>Browse Services</a></li>
@endsection

@section('header', 'Welcome to Your Wellness Hub')

@section('content')
    <!-- User Profile Card -->
    <div class="card mb-4">
        <div class="card-body d-flex align-items-center">
            <div class="user-avatar me-4">
                <i class="fas fa-user-circle fa-5x text-secondary"></i>
            </div>
            <div class="user-info">
                <h2 class="h3 mb-1">{{ auth()->user()->name }}</h2>
                <p class="text-muted mb-1">{{ auth()->user()->email }}</p>
                <p class="mb-0"><strong>Preferences:</strong> Healthy Eating, Fitness</p>
            </div>
        </div>
    </div>

    <!-- Search and Browse Services -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="h5 mb-0">Find Health & Wellness Services</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('services.search') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Search for services or products...">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
                <div class="mt-3">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('services.category', 'healthy-eating') }}" class="badge bg-success bg-opacity-75 p-2 text-decoration-none">Healthy Eating Programs</a>
                        <a href="{{ route('services.category', 'fitness') }}" class="badge bg-info bg-opacity-75 p-2 text-decoration-none">Fitness & Wellness</a>
                        <a href="{{ route('services.category', 'sustainable') }}" class="badge bg-warning bg-opacity-75 p-2 text-decoration-none">Sustainable Living</a>
                        <a href="{{ route('services.category', 'mental-health') }}" class="badge bg-danger bg-opacity-75 p-2 text-decoration-none">Mental Health</a>
                        <a href="{{ route('services.category', 'eco-friendly') }}" class="badge bg-primary bg-opacity-75 p-2 text-decoration-none">Eco-Friendly Products</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Quick Access Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="icon-circle bg-primary bg-opacity-10 mx-auto mb-3">
                        <i class="fas fa-calendar-check text-primary fa-2x"></i>
                    </div>
                    <h3 class="h5">My Bookings</h3>
                    <p class="text-muted">View and manage your service appointments</p>
                    <a href="{{ route('user.bookings') }}" class="btn btn-sm btn-outline-primary">View Bookings</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="icon-circle bg-success bg-opacity-10 mx-auto mb-3">
                        <i class="fas fa-leaf text-success fa-2x"></i>
                    </div>
                    <h3 class="h5">Explore Services</h3>
                    <p class="text-muted">Discover eco-friendly and sustainable services</p>
                    <a href="{{ route('services.browse') }}" class="btn btn-sm btn-outline-success">Browse All</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="icon-circle bg-info bg-opacity-10 mx-auto mb-3">
                        <i class="fas fa-user text-info fa-2x"></i>
                    </div>
                    <h3 class="h5">My Profile</h3>
                    <p class="text-muted">Update your personal information and preferences</p>
                    <a href="{{ route('user.profile') }}" class="btn btn-sm btn-outline-info">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommended Services -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="h5 mb-0">Recommended For You</h3>
            <a href="{{ route('services.browse') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="row g-0">
                <!-- Service cards would be populated from the database -->
                <div class="col-md-4 p-3 border-end">
                    <div class="service-card">
                        <img src="{{ asset('images/yoga.jpg') }}" alt="Yoga Class" class="img-fluid rounded mb-2">
                        <h4 class="h6">Morning Yoga Sessions</h4>
                        <p class="small text-muted mb-1">By Wellness Studio</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-success">$15/session</span>
                            <a href="#" class="btn btn-sm btn-outline-primary">Details</a>
                        </div>
                    </div>
                </div>
                <!-- More service cards would go here -->
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="h5 mb-0">Recent Activity</h3>
            <button class="btn btn-sm btn-link text-decoration-none">View All</button>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <div>
                        <i class="fas fa-calendar-check text-success me-2"></i>
                        <span>Booked a Nutrition Consultation</span>
                    </div>
                    <span class="text-muted small">2 days ago</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <div>
                        <i class="fas fa-heart text-danger me-2"></i>
                        <span>Saved Eco-Friendly Home Products</span>
                    </div>
                    <span class="text-muted small">5 days ago</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <div>
                        <i class="fas fa-star text-warning me-2"></i>
                        <span>Reviewed Yoga Studio</span>
                    </div>
                    <span class="text-muted small">1 week ago</span>
                </li>
            </ul>
        </div>
    </div>

    <style>
        .icon-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .service-card {
            transition: transform 0.2s;
        }
        .service-card:hover {
            transform: translateY(-5px);
        }
    </style>
@endsection