@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('My Bookings') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if($bookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Listing</th>
                                    <th>Booking Date</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                <tr>
                                    <td>
                                        @if($booking->listing)
                                        <a href="{{ route('services.show', $booking->listing->id) }}">
                                            {{ $booking->listing->title }}
                                        </a>
                                        @else
                                        <span class="text-muted">Listing not available</span>
                                        @endif
                                    </td>
                                    <td>{{ $booking->booking_date->format('M d, Y h:i A') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $booking->notes ?? 'No notes' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info">
                        You don't have any bookings yet. <a href="{{ route('services') }}">Browse services</a> to make a booking.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection