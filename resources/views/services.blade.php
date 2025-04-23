@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Our Services') }}</div>

                <div class="card-body">
                    <h2 class="mb-4">Explore Healthy Habitat Services</h2>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search services...">
                                <button class="btn btn-outline-secondary" type="button">Search</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-md-end">
                                <select class="form-select w-auto">
                                    <option selected>All Categories</option>
                                    <option>Eco-Friendly</option>
                                    <option>Sustainable</option>
                                    <option>Health & Wellness</option>
                                    <option>Organic</option>
                                    <option>Fitness</option>
                                    <option>Nutrition</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        @forelse($services as $service)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="{{ asset('images/services/' . Str::slug($service->name) . '.jpg') }}" 
                                     class="card-img-top" 
                                     alt="{{ $service->name }}" 
                                     onerror="this.src='data:image/svg+xml;charset=UTF-8,%3Csvg width=\'300\' height=\'200\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Crect width=\'300\' height=\'200\' fill=\'%23cccccc\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' font-size=\'18\' text-anchor=\'middle\' alignment-baseline=\'middle\' font-family=\'Arial, sans-serif\' fill=\'%23666666\'%3E{{ $service->name }}%3C/text%3E%3C/svg%3E'">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $service->name }}</h5>
                                    <p class="card-text">{{ $service->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-success">{{ $service->category }}</span>
                                        <span class="text-primary fw-bold">${{ number_format($service->price, 2) }}</span>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <a href="#" class="btn btn-primary w-100">View Details</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center">
                            <p>No services found.</p>
                        </div>
                        @endforelse
                    </div>
                    
                    <div class="mt-4">
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    
    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
    }
    
    .card {
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
</style>
@endsection
