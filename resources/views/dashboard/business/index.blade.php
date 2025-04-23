@extends('layouts.dashboard')

@section('title', 'Business Dashboard')

@section('sidebar-menu')
<li><a href="{{ route('business.dashboard') }}" class="active"><i class="fas fa-home me-2"></i>Dashboard</a></li>
<li><a href="{{ route('business.services') }}"><i class="fas fa-list me-2"></i>My Services</a></li>
<li><a href="{{ route('business.bookings') }}"><i class="fas fa-calendar-check me-2"></i>Bookings</a></li>
<li><a href="{{ route('business.profile') }}"><i class="fas fa-store me-2"></i>Business Profile</a></li>
@endsection

@section('header', 'Business Dashboard')

@section('content')
@if(!auth()->user()->business)
    <div class="alert alert-warning">
        <h4 class="alert-heading">Complete Your Business Profile</h4>
        <p>Please complete your business profile to start using the dashboard.</p>
        <hr>
        <a href="{{ route('business.profile') }}" class="btn btn-primary">Complete Profile</a>
    </div>
@else
    <!-- Business Overview Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    <div class="business-logo mb-3 mb-md-0">
                        <img src="{{ asset('images/logo.png') }}" alt="Business Logo" class="img-fluid rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                    </div>
                </div>
                <div class="col-md-7">
                    <h2 class="h3 mb-1">{{ auth()->user()->business->name }}</h2>
                    <p class="text-muted mb-2">{{ auth()->user()->business->category }}</p>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-success me-2">Verified</span>
                        <div class="rating text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="text-muted ms-1">(4.5)</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('business.profile') }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-1"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="h5 mb-0">Active Listings</h3>
                        <div class="icon-sm bg-primary bg-opacity-10 rounded-circle">
                            <i class="fas fa-list text-primary"></i>
                        </div>
                    </div>
                    <h4 class="display-6 mb-0">{{ $servicesCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="h5 mb-0">Bookings</h3>
                        <div class="icon-sm bg-success bg-opacity-10 rounded-circle">
                            <i class="fas fa-calendar-check text-success"></i>
                        </div>
                    </div>
                    <h4 class="display-6 mb-0">{{ $bookingsCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="h5 mb-0">Page Views</h3>
                        <div class="icon-sm bg-info bg-opacity-10 rounded-circle">
                            <i class="fas fa-eye text-info"></i>
                        </div>
                    </div>
                    <h4 class="display-6 mb-0">{{ $pageViews ?? 243 }}</h4>
                    <p class="text-muted small mb-0">
                        <i class="fas fa-arrow-up text-success me-1"></i>
                        <span>18% this month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="h5 mb-0">Reviews</h3>
                        <div class="icon-sm bg-warning bg-opacity-10 rounded-circle">
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                    <h4 class="display-6 mb-0">{{ $reviewCount ?? 28 }}</h4>
                    <p class="text-muted small mb-0">
                        <i class="fas fa-arrow-up text-success me-1"></i>
                        <span>2 new reviews</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Listing Card -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="h5 mb-0">Add New Service or Product</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('business.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category_id" required>
                            <option value="">Select a category</option>
                            <option value="1">Healthy Eating Programs</option>
                            <option value="2">Fitness & Wellness</option>
                            <option value="3">Sustainable Living</option>
                            <option value="4">Mental Health</option>
                            <option value="5">Eco-Friendly Products</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Add Listing
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Manage Listings Section -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="h5 mb-0">Your Services</h3>
            <a href="{{ route('business.services') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data - would be replaced with actual listings -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="listing-img me-2">
                                        <img src="{{ asset('images/yoga.jpg') }}" alt="Yoga" class="rounded" width="40">
                                    </div>
                                    <div>Yoga Classes</div>
                                </div>
                            </td>
                            <td>Fitness & Wellness</td>
                            <td>$25.00</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-outline-primary">Edit</a>
                                    <a href="#" class="btn btn-outline-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="listing-img me-2">
                                        <img src="{{ asset('images/meal.jpg') }}" alt="Meal Plan" class="rounded" width="40">
                                    </div>
                                    <div>Healthy Meal Plan</div>
                                </div>
                            </td>
                            <td>Healthy Eating Programs</td>
                            <td>$150.00</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-outline-primary">Edit</a>
                                    <a href="#" class="btn btn-outline-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="h5 mb-0">Recent Bookings</h3>
            <a href="{{ route('business.bookings') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
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
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-outline-success">Confirm</a>
                                    <a href="#" class="btn btn-outline-danger">Cancel</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Sarah Johnson</td>
                            <td>Nutrition Consultation</td>
                            <td>May 18, 2023</td>
                            <td><span class="badge bg-success">Confirmed</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-outline-primary">Details</a>
                                    <a href="#" class="btn btn-outline-danger">Cancel</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

@push('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: all 0.3s ease;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1rem 1.25rem;
    }

    .card-body {
        padding: 1.25rem;
    }

    .icon-sm {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .icon-sm:hover {
        transform: scale(1.1);
    }

    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
        border-radius: 50px;
    }

    .btn-group-sm .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.25rem;
        transition: all 0.3s ease;
    }

    .btn-group-sm .btn:hover {
        transform: translateY(-1px);
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        padding: 1rem;
    }

    .table td {
        vertical-align: middle;
        padding: 1rem;
        border-bottom: 1px solid #dee2e6;
    }

    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }

    .listing-img img {
        object-fit: cover;
        border-radius: 0.25rem;
        transition: all 0.3s ease;
    }

    .listing-img img:hover {
        transform: scale(1.05);
    }

    .form-control, .form-select {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .input-group-text {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        color: #6c757d;
    }

    .btn {
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #4CAF50;
        border-color: #4CAF50;
    }

    .btn-primary:hover {
        background-color: #388e3c;
        border-color: #388e3c;
        transform: translateY(-2px);
    }

    .btn-outline-primary {
        color: #4CAF50;
        border-color: #4CAF50;
    }

    .btn-outline-primary:hover {
        background-color: #4CAF50;
        border-color: #4CAF50;
        color: white;
        transform: translateY(-2px);
    }

    .btn-outline-success {
        color: #28a745;
        border-color: #28a745;
    }

    .btn-outline-success:hover {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
        transform: translateY(-2px);
    }

    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
        transform: translateY(-2px);
    }

    .alert {
        border: none;
        border-radius: 0.5rem;
        padding: 1rem 1.25rem;
    }

    .alert-warning {
        background-color: #fff3cd;
        color: #856404;
    }

    .alert-heading {
        color: #856404;
        font-weight: 600;
    }

    .rating {
        color: #ffc107;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .display-6 {
        font-size: 2.5rem;
        font-weight: 300;
        line-height: 1.2;
    }

    .h5 {
        font-size: 1.25rem;
        font-weight: 500;
    }

    .h3 {
        font-size: 1.75rem;
        font-weight: 500;
    }

    .me-2 {
        margin-right: 0.5rem !important;
    }

    .mb-3 {
        margin-bottom: 1rem !important;
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    .p-0 {
        padding: 0 !important;
    }

    .text-end {
        text-align: right !important;
    }

    .text-md-end {
        text-align: right !important;
    }

    @media (max-width: 768px) {
        .text-md-end {
            text-align: left !important;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .table th, .table td {
            padding: 0.75rem;
        }
    }
</style>
@endpush
@endsection