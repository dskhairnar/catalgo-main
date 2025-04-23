@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('My Services') }}</span>
                    <div>
                        <a href="{{ route('business.dashboard') }}" class="btn btn-sm btn-outline-secondary me-2">Back to Dashboard</a>
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">Add New Service</a>
                    </div>
                </div>

                <div class="card-body">
                    <h2 class="mb-4">Manage Your Services</h2>
                    
                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">All Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Active</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inactive</a>
                        </li>
                    </ul>
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Service Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example service entries - replace with actual data -->
                                <tr>
                                    <td>Eco-friendly Consultation</td>
                                    <td>Sustainability</td>
                                    <td>$75.00</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>Mar 15, 2024</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">Deactivate</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Organic Meal Planning</td>
                                    <td>Nutrition</td>
                                    <td>$50.00</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>Mar 10, 2024</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">Deactivate</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Wellness Workshop</td>
                                    <td>Health & Wellness</td>
                                    <td>$120.00</td>
                                    <td><span class="badge bg-secondary">Inactive</span></td>
                                    <td>Feb 28, 2024</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-outline-success">Activate</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Show this when no services are found -->
                    <div class="text-center py-5" style="display: none;">
                        <i class="fas fa-store fa-3x text-muted mb-3"></i>
                        <h4>No services found</h4>
                        <p class="text-muted">You haven't added any services yet.</p>
                        <a href="#" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addServiceModal">Add Your First Service</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addServiceForm" action="{{ route('business.services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="service_name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="service_name" name="service_name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Select a category</option>
                            <option value="Eco-Friendly">Eco-Friendly</option>
                            <option value="Sustainable">Sustainable</option>
                            <option value="Health & Wellness">Health & Wellness</option>
                            <option value="Organic">Organic</option>
                            <option value="Fitness">Fitness</option>
                            <option value="Nutrition">Nutrition</option>
                        </select>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="duration" class="form-label">Duration (minutes)</label>
                                <input type="number" class="form-control" id="duration" name="duration" min="15" step="15">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="service_image" class="form-label">Service Image</label>
                        <select class="form-select" id="service_image" name="image">
                            <option value="">Select an image</option>
                            <option value="yoga.png">Yoga</option>
                            <option value="meal.png">Healthy Meal</option>
                            <option value="gardening.png">Gardening</option>
                            <option value="forest.png">Forest</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active (available for booking)
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="addServiceForm" class="btn btn-primary">Add Service</button>
            </div>
        </div>
    </div>
</div>

<style>
    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
    }
    
    .table th {
        font-weight: 600;
        color: #495057;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .btn-group .btn {
        margin-right: 2px;
    }
</style>
@endsection