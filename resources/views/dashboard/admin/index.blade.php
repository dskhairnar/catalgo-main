@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('sidebar-menu')
    <li><a href="{{ route('admin.dashboard') }}" class="active"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
    <li><a href="{{ route('admin.users') }}"><i class="fas fa-users me-2"></i>User Management</a></li>
    <li><a href="{{ route('admin.businesses') }}"><i class="fas fa-store me-2"></i>Business Management</a></li>
    <li><a href="{{ route('admin.listings') }}"><i class="fas fa-list me-2"></i>Listings</a></li>
    <li><a href="{{ route('admin.categories') }}"><i class="fas fa-tags me-2"></i>Categories</a></li>
    <li><a href="{{ route('admin.reports') }}"><i class="fas fa-chart-bar me-2"></i>Reports</a></li>
@endsection

@section('header', 'Admin Dashboard')

@section('content')
    <!-- Stats Overview -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="h5 mb-0">Total Users</h3>
                        <div class="icon-sm bg-primary bg-opacity-10 rounded-circle">
                            <i class="fas fa-users text-primary"></i>
                        </div>
                    </div>
                    <h4 class="display-6 mb-0">{{ $totalUsers ?? 125 }}</h4>
                    <p class="text-muted small mb-0">
                        <i class="fas fa-arrow-up text-success me-1"></i>
                        <span>12% this month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="h5 mb-0">Businesses</h3>
                        <div class="icon-sm bg-success bg-opacity-10 rounded-circle">
                            <i class="fas fa-store text-success"></i>
                        </div>
                    </div>
                    <h4 class="display-6 mb-0">{{ $totalBusinesses ?? 42 }}</h4>
                    <p class="text-muted small mb-0">
                        <i class="fas fa-arrow-up text-success me-1"></i>
                        <span>5 new this week</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="h5 mb-0">Active Listings</h3>
                        <div class="icon-sm bg-info bg-opacity-10 rounded-circle">
                            <i class="fas fa-list text-info"></i>
                        </div>
                    </div>
                    <h4 class="display-6 mb-0">{{ $activeListings ?? 156 }}</h4>
                    <p class="text-muted small mb-0">
                        <i class="fas fa-arrow-up text-success me-1"></i>
                        <span>23 new this month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="h5 mb-0">Categories</h3>
                        <div class="icon-sm bg-warning bg-opacity-10 rounded-circle">
                            <i class="fas fa-tags text-warning"></i>
                        </div>
                    </div>
                    <h4 class="display-6 mb-0">{{ $totalCategories ?? 8 }}</h4>
                    <p class="text-muted small mb-0">
                        <a href="{{ route('admin.categories.create') }}" class="text-decoration-none">
                            <i class="fas fa-plus me-1"></i> Add new
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Approvals -->
    <div class="card mb-4">
        <div class="card-header bg-warning bg-opacity-10">
            <h3 class="h5 mb-0 text-warning">Pending Business Approvals</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Business Name</th>
                            <th>Owner</th>
                            <th>Category</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data - would be replaced with actual pending businesses -->
                        <tr>
                            <td>Green Earth Organics</td>
                            <td>Michael Brown</td>
                            <td>Sustainable Living</td>
                            <td>2 days ago</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-outline-primary">View</a>
                                    <a href="#" class="btn btn-outline-success">Approve</a>
                                    <a href="#" class="btn btn-outline-danger">Reject</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Mindful Wellness Center</td>
                            <td>Jennifer Lee</td>
@endsection