@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Saved Items') }}</span>
                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary">Back to Dashboard</a>
                </div>

                <div class="card-body">
                    <h2>Your Saved Items</h2>
                    
                    <div class="mb-4">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary active">All</button>
                            <button type="button" class="btn btn-outline-primary">Services</button>
                            <button type="button" class="btn btn-outline-primary">Products</button>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Example saved items - replace with actual data -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Nutrition Counseling</h5>
                                    <p class="card-text text-muted">Personalized dietary advice</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="badge bg-info">Service</span>
                                        <div>
                                            <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Yoga and Meditation Classes</h5>
                                    <p class="card-text text-muted">Online wellness sessions</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="badge bg-info">Service</span>
                                        <div>
                                            <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Reusable Face Masks</h5>
                                    <p class="card-text text-muted">Eco-friendly and washable</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="badge bg-success">Product</span>
                                        <div>
                                            <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Reusable Products</h5>
                                    <p class="card-text text-muted">Sustainable alternatives</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="badge bg-success">Product</span>
                                        <div>
                                            <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Show this when no saved items are found -->
                    <div class="text-center py-5" style="display: none;">
                        <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                        <h4>No saved items found</h4>
                        <p class="text-muted">You haven't saved any items yet.</p>
                        <a href="#" class="btn btn-primary mt-2">Browse Services</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
    }
</style>
@endsection