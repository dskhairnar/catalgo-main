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
            <a href="{{ route('business.dashboard') }}" class="nav-item active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('business.services') }}" class="nav-item">
                <i class="fas fa-leaf"></i>
                <span>My Services</span>
            </a>
            <a href="{{ route('business.bookings') }}" class="nav-item">
                <i class="fas fa-calendar-check"></i>
                <span>Bookings</span>
            </a>
            <a href="{{ route('business.profile') }}" class="nav-item">
                <i class="fas fa-building"></i>
                <span>Business Profile</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="nav-item logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="dashboard-header">
            <div class="header-content">
                <h1>Business Dashboard</h1>
                <div class="business-info">
                    <h2>{{ Auth::user()->name }}'s Business</h2>
                    <div class="verification-badge">
                        <i class="fas fa-check-circle"></i>
                        <span>Verified</span>
                    </div>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <span>4.5</span>
                    </div>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('business.profile') }}" class="edit-profile-btn">
                    <i class="fas fa-edit"></i>
                    Edit Profile
                </a>
            </div>
        </header>

        <!-- Stats Overview -->
        <div class="stats-overview">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-list"></i>
                </div>
                <div class="stat-content">
                    <h3>Active Listings</h3>
                    <p class="stat-value">0</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-content">
                    <h3>Bookings</h3>
                    <p class="stat-value">0</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stat-content">
                    <h3>Page Views</h3>
                    <p class="stat-value">243</p>
                    <p class="stat-change positive">18% this month</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-content">
                    <h3>Reviews</h3>
                    <p class="stat-value">28</p>
                    <p class="stat-change positive">2 new reviews</p>
                </div>
            </div>
        </div>

        <!-- Add New Service Form -->
        <div class="add-service-section">
            <h2>Add New Service or Product</h2>
            <form action="{{ route('business.services.store') }}" method="POST" enctype="multipart/form-data" class="add-service-form">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" class="form-control" required>
                        <option value="">Select a category</option>
                        <option value="fitness">Fitness & Wellness</option>
                        <option value="nutrition">Healthy Eating Programs</option>
                        <option value="yoga">Yoga Classes</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <div class="price-input">
                        <span class="currency">$</span>
                        <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn-primary">Add Listing</button>
            </form>
        </div>

        <!-- Your Services Section -->
        <div class="services-section">
            <div class="section-header">
                <h2>Your Services</h2>
                <a href="{{ route('business.services') }}" class="view-all">View All</a>
            </div>
            <div class="services-table">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Yoga</td>
                            <td>Fitness & Wellness</td>
                            <td>$25.00</td>
                            <td><span class="status-badge active">Active</span></td>
                            <td class="actions">
                                <a href="#" class="action-btn edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="action-btn delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Meal Plan</td>
                            <td>Healthy Eating Programs</td>
                            <td>$150.00</td>
                            <td><span class="status-badge active">Active</span></td>
                            <td class="actions">
                                <a href="#" class="action-btn edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="action-btn delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Bookings Section -->
        <div class="bookings-section">
            <div class="section-header">
                <h2>Recent Bookings</h2>
                <a href="{{ route('business.bookings') }}" class="view-all">View All</a>
            </div>
            <div class="bookings-table">
                <table>
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Smith</td>
                            <td>Yoga Classes</td>
                            <td>May 15, 2023</td>
                            <td><span class="status-badge pending">Pending</span></td>
                            <td class="actions">
                                <a href="#" class="action-btn confirm"><i class="fas fa-check"></i></a>
                                <a href="#" class="action-btn cancel"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Sarah Johnson</td>
                            <td>Nutrition Consultation</td>
                            <td>May 18, 2023</td>
                            <td><span class="status-badge confirmed">Confirmed</span></td>
                            <td class="actions">
                                <a href="#" class="action-btn details"><i class="fas fa-info-circle"></i></a>
                                <a href="#" class="action-btn cancel"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
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

    .logout-form {
        margin-top: auto;
    }

    .logout-btn {
        color: #e74c3c;
    }

    .logout-btn:hover {
        background-color: #fde8e8;
        color: #c0392b;
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

    .business-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .business-info h2 {
        font-size: 1.2rem;
        color: #2d3436;
        margin: 0;
    }

    .verification-badge {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #4CAF50;
        font-weight: 500;
    }

    .rating {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #f39c12;
        font-weight: 500;
    }

    .edit-profile-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background-color: #4CAF50;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .edit-profile-btn:hover {
        background-color: #388e3c;
        transform: translateY(-2px);
    }

    /* Stats Overview */
    .stats-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        background-color: #e8f5e9;
        color: #4CAF50;
    }

    .stat-content h3 {
        font-size: 0.9rem;
        color: #636e72;
        margin: 0 0 0.25rem 0;
        font-weight: 500;
    }

    .stat-value {
        font-size: 1.5rem;
        color: #2d3436;
        margin: 0;
        font-weight: 600;
    }

    .stat-change {
        font-size: 0.8rem;
        margin: 0.25rem 0 0 0;
    }

    .stat-change.positive {
        color: #4CAF50;
    }

    .stat-change.negative {
        color: #e74c3c;
    }

    /* Add Service Form */
    .add-service-section {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }

    .add-service-section h2 {
        font-size: 1.25rem;
        color: #2d3436;
        margin: 0 0 1.5rem 0;
    }

    .add-service-form {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #2d3436;
        font-weight: 500;
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

    .price-input {
        position: relative;
    }

    .currency {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #636e72;
    }

    .price-input .form-control {
        padding-left: 2rem;
    }

    .btn-primary {
        background-color: #4CAF50;
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        grid-column: span 2;
    }

    .btn-primary:hover {
        background-color: #388e3c;
        transform: translateY(-2px);
    }

    /* Services and Bookings Tables */
    .services-section, .bookings-section {
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        border-bottom: 1px solid #e9ecef;
    }

    .section-header h2 {
        font-size: 1.25rem;
        color: #2d3436;
        margin: 0;
        font-weight: 600;
    }

    .view-all {
        color: #4CAF50;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .view-all:hover {
        color: #388e3c;
    }

    .services-table, .bookings-table {
        padding: 1.5rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        text-align: left;
        padding: 1rem;
        color: #636e72;
        font-weight: 500;
        border-bottom: 1px solid #e9ecef;
    }

    td {
        padding: 1rem;
        color: #2d3436;
        border-bottom: 1px solid #e9ecef;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .status-badge.active {
        background-color: #e8f5e9;
        color: #4CAF50;
    }

    .status-badge.pending {
        background-color: #fff3e0;
        color: #f57c00;
    }

    .status-badge.confirmed {
        background-color: #e3f2fd;
        color: #1976d2;
    }

    .actions {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .action-btn.edit {
        background-color: #4CAF50;
    }

    .action-btn.delete {
        background-color: #e74c3c;
    }

    .action-btn.confirm {
        background-color: #4CAF50;
    }

    .action-btn.cancel {
        background-color: #e74c3c;
    }

    .action-btn.details {
        background-color: #1976d2;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .add-service-form {
            grid-template-columns: 1fr;
        }

        .btn-primary {
            grid-column: span 1;
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

        .business-info {
            flex-direction: column;
            align-items: flex-start;
        }

        .stats-overview {
            grid-template-columns: 1fr;
        }

        .services-table, .bookings-table {
            overflow-x: auto;
        }
    }
</style>
@endpush
@endsection