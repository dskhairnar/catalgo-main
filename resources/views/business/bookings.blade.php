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
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h2>Manage Bookings</h2>
                    
                    <div class="mb-4">
                        <div class="btn-group" role="group">
                            <a href="{{ route('business.bookings') }}" class="btn btn-outline-primary {{ !request('status') ? 'active' : '' }}">All</a>
                            <a href="{{ route('business.bookings', ['status' => 'pending']) }}" class="btn btn-outline-primary {{ request('status') === 'pending' ? 'active' : '' }}">Pending</a>
                            <a href="{{ route('business.bookings', ['status' => 'confirmed']) }}" class="btn btn-outline-primary {{ request('status') === 'confirmed' ? 'active' : '' }}">Confirmed</a>
                            <a href="{{ route('business.bookings', ['status' => 'completed']) }}" class="btn btn-outline-primary {{ request('status') === 'completed' ? 'active' : '' }}">Completed</a>
                            <a href="{{ route('business.bookings', ['status' => 'cancelled']) }}" class="btn btn-outline-primary {{ request('status') === 'cancelled' ? 'active' : '' }}">Cancelled</a>
                        </div>
                    </div>
                    
                    @if($bookings->count() > 0)
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
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->service->name }}</td>
                                            <td>{{ $booking->user->name }}</td>
                                            <td>{{ $booking->booking_time->format('F d, Y') }}</td>
                                            <td>{{ $booking->booking_time->format('h:i A') }}</td>
                                            <td>
                                                <span class="badge bg-{{ 
                                                    $booking->status === 'pending' ? 'warning' : 
                                                    ($booking->status === 'confirmed' ? 'success' : 
                                                    ($booking->status === 'completed' ? 'info' : 'secondary')) 
                                                }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewBookingModal{{ $booking->id }}">
                                                        View
                                                    </button>
                                                    @if($booking->status === 'pending')
                                                        <form action="{{ route('business.bookings.update-status', $booking->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="confirmed">
                                                            <button type="submit" class="btn btn-sm btn-outline-success">Confirm</button>
                                                        </form>
                                                    @endif
                                                    @if($booking->status === 'confirmed')
                                                        <form action="{{ route('business.bookings.update-status', $booking->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="completed">
                                                            <button type="submit" class="btn btn-sm btn-outline-info">Complete</button>
                                                        </form>
                                                    @endif
                                                    @if(in_array($booking->status, ['pending', 'confirmed']))
                                                        <form action="{{ route('business.bookings.update-status', $booking->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="cancelled">
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</button>
                                                        </form>
                                                    @endif
                                                </div>

                                                <!-- Booking Details Modal -->
                                                <div class="modal fade" id="viewBookingModal{{ $booking->id }}" tabindex="-1" aria-labelledby="viewBookingModalLabel{{ $booking->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="viewBookingModalLabel{{ $booking->id }}">Booking Details</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <h6>Service</h6>
                                                                    <p>{{ $booking->service->name }}</p>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <h6>Customer Information</h6>
                                                                    <p>Name: {{ $booking->user->name }}<br>
                                                                    Email: {{ $booking->user->email }}</p>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <h6>Booking Time</h6>
                                                                    <p>{{ $booking->booking_time->format('F d, Y h:i A') }}</p>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <h6>Status</h6>
                                                                    <p>{{ ucfirst($booking->status) }}</p>
                                                                </div>
                                                                @if($booking->notes)
                                                                    <div class="mb-3">
                                                                        <h6>Notes</h6>
                                                                        <p>{{ $booking->notes }}</p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
                            <h4>No bookings found</h4>
                            <p class="text-muted">You don't have any bookings matching the selected filter.</p>
                        </div>
                    @endif
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

    .modal-body h6 {
        color: #495057;
        font-weight: 600;
    }

    .modal-body p {
        color: #6c757d;
    }
</style>
@endsection