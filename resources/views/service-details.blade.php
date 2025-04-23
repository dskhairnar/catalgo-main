@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ $service->name }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{ asset('images/services/' . Str::slug($service->name) . '.jpg') }}" 
                                 class="img-fluid rounded" 
                                 alt="{{ $service->name }}" 
                                 onerror="this.src='data:image/svg+xml;charset=UTF-8,%3Csvg width=\'600\' height=\'400\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Crect width=\'600\' height=\'400\' fill=\'%23cccccc\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' font-size=\'24\' text-anchor=\'middle\' alignment-baseline=\'middle\' font-family=\'Arial, sans-serif\' fill=\'%23666666\'%3E{{ $service->name }}%3C/text%3E%3C/svg%3E'">
                        </div>
                        <div class="col-md-7">
                            <h2>{{ $service->name }}</h2>
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-success me-2">{{ $service->category }}</span>
                                <span class="text-primary fw-bold fs-4">${{ number_format($service->price, 2) }}</span>
                            </div>
                            <p class="lead">{{ $service->description }}</p>
                            
                            <hr>
                            
                            <h4>Book This Service</h4>
                            <form>
                                <div class="mb-3">
                                    <label for="date" class="form-label">Preferred Date</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                                <div class="mb-3">
                                    <label for="time" class="form-label">Preferred Time</label>
                                    <select class="form-select" id="time" name="time" required>
                                        <option value="">Select a time</option>
                                        <option>Morning (9am - 12pm)</option>
                                        <option>Afternoon (12pm - 5pm)</option>
                                        <option>Evening (5pm - 8pm)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Special Requests</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Book Now</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="row mt-5">
                        <div class="col-12">
                            <h3>Related Services</h3>
                            <hr>
                        </div>
                        <!-- You can add related services here -->
                    </div>
                </div>
            </div>
            
            <div class="mt-3">
                <a href="{{ route('services') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Services
                </a>
            </div>
        </div>
    </div>
</div>
@endsection