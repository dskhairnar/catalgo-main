@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    :root {
        --primary: #2B2D42;
        --secondary: #8D99AE;
        --accent: #EF233C;
        --background: #EDF2F4;
        --surface: #FFFFFF;
        --border: #E2E8F0;
        --hover: #F7FAFC;
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .service-header {
        background: var(--surface);
        padding: 3rem 0;
        margin-bottom: 3rem;
        box-shadow: var(--shadow-sm);
    }

    .service-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .service-category {
        background: rgba(239, 35, 60, 0.1);
        color: var(--accent);
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-weight: 500;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .service-icon-container {
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(45deg, rgba(239, 35, 60, 0.1), rgba(239, 35, 60, 0.05));
        border-radius: 1rem;
        margin-bottom: 2rem;
    }

    .service-icon {
        font-size: 4rem;
        color: var(--accent);
    }

    .service-content {
        background: var(--surface);
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: var(--shadow-md);
    }

    .service-price {
        font-size: 2rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 1.5rem;
    }

    .service-description {
        color: var(--secondary);
        line-height: 1.8;
        margin-bottom: 2rem;
    }

    .service-meta {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .service-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--secondary);
    }

    .service-meta-item i {
        color: var(--accent);
    }

    .service-actions {
        display: flex;
        gap: 1rem;
    }

    .service-btn {
        flex: 1;
        padding: 1rem;
        border-radius: 0.5rem;
        font-weight: 500;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .service-btn.primary {
        background: var(--accent);
        color: var(--surface);
    }

    .service-btn.secondary {
        background: var(--background);
        color: var(--primary);
    }

    .service-btn:hover {
        transform: translateY(-2px);
    }

    .service-btn.primary:hover {
        background: #D90429;
    }

    .service-btn.secondary:hover {
        background: var(--border);
    }

    .provider-info {
        background: var(--surface);
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: var(--shadow-md);
        margin-top: 2rem;
    }

    .provider-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .provider-meta {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .provider-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--secondary);
    }

    .provider-meta-item i {
        color: var(--accent);
    }

    .booking-form {
        background: var(--surface);
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: var(--shadow-md);
        margin-top: 2rem;
    }

    .booking-form-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 500;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 1px solid var(--border);
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(239, 35, 60, 0.1);
    }
</style>
@endpush

@section('content')
<div class="service-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="service-title">{{ $service->name }}</h1>
                <span class="service-category">{{ $service->category->name }}</span>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="service-content">
                <div class="service-icon-container">
                    <i class="{{ $service->category->icon }} service-icon"></i>
                </div>
                <div class="service-price">${{ number_format($service->price, 2) }}</div>
                <p class="service-description">{{ $service->description }}</p>
                <div class="service-meta">
                    <div class="service-meta-item">
                        <i class="fas fa-clock"></i>
                        <span>Duration: {{ $service->duration ?? '60' }} min</span>
                    </div>
                    <div class="service-meta-item">
                        <i class="fas fa-star"></i>
                        <span>4.5 (120 reviews)</span>
                    </div>
                </div>
                <div class="service-actions">
                    @auth
                        <button type="button" class="service-btn primary" data-bs-toggle="modal" data-bs-target="#bookingModal">
                            Book Now
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="service-btn primary">Login to Book</a>
                    @endauth
                    <a href="{{ route('services') }}" class="service-btn secondary">View All Services</a>
                </div>
            </div>

            @auth
            <div class="booking-form">
                <h3 class="booking-form-title">Book This Service</h3>
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    
                    <div class="form-group">
                        <label for="booking_date" class="form-label">Preferred Date</label>
                        <input type="date" class="form-control" id="booking_date" name="booking_date" 
                               min="{{ date('Y-m-d') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="booking_time" class="form-label">Preferred Time</label>
                        <select class="form-control" id="booking_time" name="booking_time" required>
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
                    
                    <div class="form-group">
                        <label for="notes" class="form-label">Additional Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" 
                                  placeholder="Any special requirements or preferences?"></textarea>
                    </div>
                    
                    <button type="submit" class="service-btn primary w-100">Confirm Booking</button>
                </form>
            </div>
            @endauth
        </div>
        <div class="col-md-4">
            <div class="provider-info">
                <h3 class="provider-title">Service Provider</h3>
                <div class="provider-meta">
                    <div class="provider-meta-item">
                        <i class="fas fa-building"></i>
                        <span>{{ $service->business->name }}</span>
                    </div>
                </div>
                <div class="provider-meta">
                    <div class="provider-meta-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $service->business->address }}</span>
                    </div>
                </div>
                <div class="provider-meta">
                    <div class="provider-meta-item">
                        <i class="fas fa-phone"></i>
                        <span>{{ $service->business->phone }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('booking_date');
    const timeSelect = document.getElementById('booking_time');
    
    if (dateInput && timeSelect) {
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
    }
});
</script>
@endpush