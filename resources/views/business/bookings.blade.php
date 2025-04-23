@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Business Bookings') }}</span>
                    <a href="{{ route('business.dashboard') }}" class="btn btn-sm btn-outline-secondary">Back to Dashboard</a>
                </div>

                <div class="card-body">
                    <h2>Manage Bookings</h2>
                    
                    <div class="mb-4">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary active">All</button>
                            <button type="button" class="btn btn-outline-primary">Pending</button>
                            <button type="button" class="btn btn-outline-primary">Confirmed</button>
                            <button type="button" class="btn btn-outline-primary">Completed</button>
                            <button type="button" class="btn btn-outline-primary">Cancelled</button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example booking entries - replace with actual data -->
                                <tr>
                                    <td>Eco-friendly Consultation</td>
                                    <td>John Smith</td>
                                    <td>April 15, 2024</td>
                                    <td>10:00 AM</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary">View</button>
                                            <button type="button" class="btn btn-sm btn-outline-success">Confirm</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger">Cancel</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sustainable Product Demo</td>
                                    <td>Jane Doe</td>
                                    <td>April 18, 2024</td>
                                    <td>2:30 PM</td>
                                    <td><span class="badge bg-success">Confirmed</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary">View</button>
                                            <button type="button" class="btn btn-sm btn-outline-info">Complete</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger">Cancel</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Wellness Workshop</td>
                                    <td>Robert Johnson</td>
                                    <td>April 10, 2024</td>
                                    <td>1:00 PM</td>
                                    <td><span class="badge bg-secondary">Completed</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary">View</button>
                                            <button type="button" class="btn btn-sm btn-outline-success">Reschedule</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Show this when no bookings are found -->
                    <div class="text-center py-5" style="display: none;">
                        <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
                        <h4>No bookings found</h4>
                        <p class="text-muted">You don't have any bookings matching the selected filter.</p>
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
    
    .btn-group .btn {
        margin-right: 2px;
    }
</style>
@endsection