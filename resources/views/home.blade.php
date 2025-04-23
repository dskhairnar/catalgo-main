@extends('layouts.app')

@section('content')
<div class="container">
    <div class="hero-section">
        <h1>Welcome to Healthy Habitat Network</h1>
        <p>Find and book the perfect accommodation for your needs</p>
        <div class="search-box">
            <!-- Add search functionality here -->
        </div>
    </div>

    <div class="featured-listings">
        <h2>Featured Listings</h2>
        <!-- Add featured listings here -->
    </div>
</div>

<style>
.hero-section {
    text-align: center;
    padding: 4rem 0;
    background-color: #f8f9fa;
    margin-bottom: 2rem;
}

.hero-section h1 {
    color: #2F4F4F;
    margin-bottom: 1rem;
}

.featured-listings {
    padding: 2rem 0;
}

.featured-listings h2 {
    color: #2F4F4F;
    margin-bottom: 2rem;
}
</style>
@endsection