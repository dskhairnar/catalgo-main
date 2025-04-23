@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('My Bookings') }}</span>
                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary">Back to Dashboard</a>
                </div>

                <div class="card-body">
                    <h2>Your Bookings</h2>
                    
                    <div class="mb-4">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary active">All</button>
                            <button type="button" class="btn btn-outline-primary">Upcoming</button>
                            <button type="button" class="btn btn-outline-primary">Past</button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Provider</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example booking entries - replace with actual data -->
                                <tr>
                                    <td>Personal Training Session</td>
                                    <td>FitLife Gym</td>
                                    <td>April 15, 2024</td>
                                    <td><span class="badge bg-success">Confirmed</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-outline-danger">Cancel</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Organic Meal Delivery</td>
                                    <td>GreenEats</td>
                                    <td>March 30, 2024</td>
                                    <td><span class="badge bg-secondary">Completed</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-outline-success">Book Again</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Show this when no bookings are found -->
                    <div class="text-center py-5" style="display: none;">
                        <i class="fas fa-calendar fa-3x text-muted mb-3"></i>
                        <h4>No bookings found</h4>
                        <p class="text-muted">You don't have any bookings yet.</p>
                        <a href="#" class="btn btn-primary mt-2">Book a Service</a>
                    </div>
                </div>
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
</style>
@endsection