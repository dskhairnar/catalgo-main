@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Business Dashboard') }}</div>

                <div class="card-body">
                    <h2>Welcome, {{ Auth::user()->name }}!</h2>
                    <p>You are logged in as a Business Partner.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">My Services</h5>
                                    <p class="card-text">Manage your services and products</p>
                                    <a href="{{ route('business.services') }}" class="btn btn-primary">View Services</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Bookings</h5>
                                    <p class="card-text">View and manage customer bookings</p>
                                    <a href="{{ route('business.bookings') }}" class="btn btn-primary">View Bookings</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Business Profile</h5>
                                    <p class="card-text">Update your business information</p>
                                    <a href="{{ route('business.profile') }}" class="btn btn-primary">View Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Recent Bookings</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Service</th>
                                                    <th>Customer</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="5" class="text-center">No recent bookings</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Quick Stats</h5>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Total Services:</span>
                                        <span class="badge bg-primary">0</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Active Bookings:</span>
                                        <span class="badge bg-success">0</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Completed Bookings:</span>
                                        <span class="badge bg-info">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        margin-bottom: 20px;
    }
    
    .badge {
        font-size: 14px;
        padding: 5px 10px;
    }
</style>
@endsection