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

    .services-header {
        background: var(--surface);
        padding: 3rem 0;
        margin-bottom: 3rem;
        box-shadow: var(--shadow-sm);
    }

    .services-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .services-subtitle {
        color: var(--secondary);
        font-size: 1.2rem;
    }

    .search-section {
        background: var(--surface);
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: var(--shadow-md);
        margin-bottom: 3rem;
    }

    .search-input {
        border: 1px solid var(--border);
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        width: 100%;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(239, 35, 60, 0.1);
    }

    .category-select {
        border: 1px solid var(--border);
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        width: 100%;
        transition: all 0.3s ease;
    }

    .category-select:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(239, 35, 60, 0.1);
    }

    .service-card {
        background: var(--surface);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .service-icon-container {
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(45deg, rgba(239, 35, 60, 0.1), rgba(239, 35, 60, 0.05));
        border-radius: 1rem 1rem 0 0;
    }

    .service-icon {
        font-size: 4rem;
        color: var(--accent);
        transition: transform 0.3s ease;
    }

    .service-card:hover .service-icon {
        transform: scale(1.1);
    }

    .service-content {
        padding: 2rem;
    }

    .service-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .service-description {
        color: var(--secondary);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .service-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .service-category {
        background: rgba(239, 35, 60, 0.1);
        color: var(--accent);
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-weight: 500;
    }

    .service-price {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary);
    }

    .view-details-btn {
        display: block;
        width: 100%;
        padding: 0.75rem;
        background: var(--accent);
        color: var(--surface);
        text-align: center;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .view-details-btn:hover {
        background: #D90429;
        color: var(--surface);
        transform: translateY(-2px);
    }

    .pagination {
        margin-top: 3rem;
    }

    .pagination .page-item.active .page-link {
        background-color: var(--accent);
        border-color: var(--accent);
    }

    .pagination .page-link {
        color: var(--primary);
    }

    .pagination .page-link:hover {
        color: var(--accent);
    }
</style>
@endpush

@section('content')
<div class="services-header">
    <div class="container">
        <h1 class="services-title">Explore Our Services</h1>
        <p class="services-subtitle">Discover a wide range of sustainable and healthy living services</p>
    </div>
</div>

<div class="container">
    <div class="search-section">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <input type="text" class="search-input" placeholder="Search services...">
            </div>
            <div class="col-md-6">
                <select class="category-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse($services as $service)
        <div class="col-md-4 mb-4">
            <div class="service-card">
                <div class="service-icon-container">
                    <i class="{{ $service->category->icon }} service-icon"></i>
                </div>
                <div class="service-content">
                    <h3 class="service-title">{{ $service->name }}</h3>
                    <p class="service-description">{{ Str::limit($service->description, 100) }}</p>
                    <div class="service-meta">
                        <span class="service-category">{{ $service->category->name }}</span>
                        <span class="service-price">${{ number_format($service->price, 2) }}</span>
                    </div>
                    <a href="{{ route('service.details', $service) }}" class="view-details-btn">View Details</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <div class="py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h3>No services found</h3>
                <p class="text-muted">Try adjusting your search or filter criteria</p>
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $services->links() }}
    </div>
</div>
@endsection
