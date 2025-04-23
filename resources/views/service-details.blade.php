@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ $service->name }}</h4>
                    <a href="{{ route('services') }}" class="btn btn-sm btn-outline-secondary">Back to Services</a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if($service->icon)
                                <img src="{{ asset('images/' . $service->icon) }}" 
                                     class="img-fluid rounded" 
                                     alt="{{ $service->name }}"
                                     onerror="this.onerror=null; this.src='{{ asset('images/placeholder.jpg') }}';">
                            @else
                                <div class="bg-light rounded p-5 text-center">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="text-muted mb-3">Service Details</h5>
                                <p class="mb-3">{{ $service->description }}</p>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-primary">{{ $service->category->name ?? 'Uncategorized' }}</span>
                                    <h4 class="text-primary mb-0">${{ number_format($service->price, 2) }}</h4>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        Duration: {{ $service->duration ?? 60 }} minutes
                                    </small>
                                </div>
                            </div>

                            @auth
                                <div class="booking-form">
                                    <h5 class="mb-3">Book This Service</h5>
                                    <form action="{{ route('bookings.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                                        
                                        <div class="mb-3">
                                            <label for="booking_date" class="form-label">Preferred Date</label>
                                            <input type="date" class="form-control" id="booking_date" name="booking_date" 
                                                   min="{{ date('Y-m-d') }}" required>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="booking_time" class="form-label">Preferred Time</label>
                                            <select class="form-select" id="booking_time" name="booking_time" required>
                                                <option value="">Select a time</option>
                                                @for($hour = 9; $hour <= 17; $hour++)
                                                    <option value="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00">
                                                        {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00
                                                    </option>
                                                    <option value="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:30">
                                                        {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:30
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="notes" class="form-label">Additional Notes</label>
                                            <textarea class="form-control" id="notes" name="notes" rows="3" 
                                                      placeholder="Any special requirements or preferences?"></textarea>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary w-100">Book Now</button>
                                    </form>
                                </div>
                            @else
                                <div class="text-center p-4">
                                    <p class="mb-3">Please log in to book this service</p>
                                    <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
                                </div>
                            @endauth
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <h5 class="mb-4">Business Information</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>{{ $service->business->name ?? 'Business Name Not Available' }}</h6>
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-map-marker-alt me-2"></i>
                                                {{ $service->business->address ?? 'Address not available' }}
                                            </p>
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-phone me-2"></i>
                                                {{ $service->business->phone ?? 'Phone not available' }}
                                            </p>
                                            <p class="text-muted">
                                                <i class="fas fa-envelope me-2"></i>
                                                {{ $service->business->email ?? 'Email not available' }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-end">
                                                <a href="#" class="btn btn-outline-primary me-2">
                                                    <i class="fas fa-directions me-1"></i> Get Directions
                                                </a>
                                                <a href="#" class="btn btn-outline-primary">
                                                    <i class="fas fa-phone me-1"></i> Contact
                                                </a>
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
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('booking_date');
    const timeSelect = document.getElementById('booking_time');
    
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    dateInput.min = today;
    
    // Disable past times for today
    if (dateInput.value === today) {
        const currentHour = new Date().getHours();
        Array.from(timeSelect.options).forEach(option => {
            const [hour] = option.value.split(':');
            if (parseInt(hour) <= currentHour) {
                option.disabled = true;
            }
        });
    }
    
    // Update available times when date changes
    dateInput.addEventListener('change', function() {
        const selectedDate = this.value;
        const currentHour = new Date().getHours();
        
        Array.from(timeSelect.options).forEach(option => {
            if (option.value) {
                const [hour] = option.value.split(':');
                if (selectedDate === today && parseInt(hour) <= currentHour) {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            }
        });
    });
});
</script>
@endpush

<style>
    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
    }
    
    .booking-form {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.5rem;
    }
    
    .img-fluid {
        max-height: 400px;
        object-fit: cover;
        width: 100%;
    }
</style>
@endsection