@extends('layouts.app')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!-- Add Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', sans-serif;
    }

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
        --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1), 0 10px 10px rgba(0, 0, 0, 0.04);
        --shadow-2xl: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    body {
        background-color: var(--background);
        color: var(--primary);
        line-height: 1.6;
    }

    /* Navbar Styling */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.25rem 5%;
        background: var(--surface);
        box-shadow: var(--shadow-sm);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
    }

    .logo {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .logo:hover {
        color: var(--accent);
    }

    .nav-links {
        display: flex;
        gap: 2rem;
        align-items: center;
    }

    .nav-links a {
        text-decoration: none;
        color: var(--secondary);
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .nav-links a:hover {
        color: var(--accent);
    }

    .login-btn {
        padding: 0.75rem 1.75rem;
        border: 1px solid var(--accent);
        border-radius: 50px;
        color: var(--accent);
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .login-btn:hover {
        background: var(--accent);
        color: var(--surface);
        transform: translateY(-2px);
    }

    /* Main Content Styling */
    .main-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8rem 5% 4rem;
        gap: 4rem;
        background: var(--surface);
        min-height: 90vh;
        position: relative;
        overflow: hidden;
    }

    .content-left {
        flex: 1;
        max-width: 600px;
        position: relative;
        z-index: 2;
    }

    .main-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        color: var(--primary);
        animation: fadeInUp 1s ease-out;
    }

    .main-description {
        color: var(--secondary);
        margin-bottom: 2.5rem;
        font-size: 1.2rem;
        line-height: 1.8;
        animation: fadeInUp 1s ease-out 0.2s;
        opacity: 0;
        animation-fill-mode: forwards;
    }

    .explore-btn {
        display: inline-block;
        padding: 1rem 2rem;
        background: var(--accent);
        color: var(--surface);
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: var(--shadow-md);
        animation: fadeInUp 1s ease-out 0.4s;
        opacity: 0;
        animation-fill-mode: forwards;
        position: relative;
        overflow: hidden;
    }

    .explore-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, var(--accent), #D90429);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .explore-btn:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .explore-btn:hover::before {
        opacity: 1;
    }

    .content-right {
        flex: 1;
        max-width: 600px;
        position: relative;
        z-index: 2;
    }

    .hero-image {
        width: 100%;
        height: auto;
        border-radius: 16px;
        box-shadow: var(--shadow-lg);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        animation: fadeInRight 1s ease-out;
    }

    .hero-image:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-2xl);
    }

    /* Decorative elements */
    .main-content::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 80%;
        height: 200%;
        background: linear-gradient(45deg, rgba(239, 35, 60, 0.05) 0%, rgba(239, 35, 60, 0.02) 100%);
        transform: rotate(30deg);
        z-index: 1;
    }

    .main-content::after {
        content: '';
        position: absolute;
        bottom: -50%;
        left: -20%;
        width: 60%;
        height: 200%;
        background: linear-gradient(45deg, rgba(239, 35, 60, 0.02) 0%, rgba(239, 35, 60, 0.05) 100%);
        transform: rotate(-30deg);
        z-index: 1;
    }

    /* Categories Section */
    .categories {
        padding: 6rem 5%;
        background: var(--background);
    }

    .categories-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 3rem;
        text-align: center;
        color: var(--primary);
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .category-card {
        padding: 2.5rem;
        background: var(--surface);
        border-radius: 16px;
        box-shadow: var(--shadow-md);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent), #D90429);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
    }

    .category-card:hover::before {
        opacity: 1;
    }

    .category-icon {
        font-size: 3rem;
        color: var(--accent);
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease;
    }

    .category-card:hover .category-icon {
        transform: scale(1.1);
    }

    .category-card h3 {
        font-size: 1.25rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .category-card p {
        color: var(--secondary);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    /* Featured Services Section */
    .featured-services {
        padding: 6rem 5%;
        background: var(--surface);
    }

    .featured-services h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 3rem;
        text-align: center;
        color: var(--primary);
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .service-card {
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .service-card:hover {
        text-decoration: none;
        color: inherit;
    }

    .service-image-container {
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(45deg, rgba(239, 35, 60, 0.1), rgba(239, 35, 60, 0.05));
        border-radius: 16px 16px 0 0;
    }

    .service-content {
        padding: 2rem;
        position: relative;
        z-index: 1;
    }

    .service-content h3 {
        font-size: 1.5rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .service-content p {
        color: var(--secondary);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .rating {
        color: #FFD700;
        font-size: 1.25rem;
        display: flex;
        gap: 0.25rem;
    }

    /* About Section */
    .about-section {
        padding: 6rem 5%;
        background: var(--background);
        text-align: center;
    }

    .about-section h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--primary);
    }

    .about-section p {
        color: var(--secondary);
        max-width: 800px;
        margin: 0 auto 3rem;
        font-size: 1.2rem;
        line-height: 1.8;
    }

    .search-bar {
        max-width: 600px;
        margin: 0 auto;
        display: flex;
        gap: 1rem;
    }

    .search-input {
        flex: 1;
        padding: 1rem 1.5rem;
        border: 1px solid var(--border);
        border-radius: 50px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(239, 35, 60, 0.1);
    }

    .search-btn {
        padding: 1rem 2rem;
        background: var(--accent);
        color: var(--surface);
        border: none;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background: #D90429;
        transform: translateY(-2px);
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .main-title {
            font-size: 3rem;
        }
    }

    @media (max-width: 768px) {
        .navbar {
            padding: 1rem 5%;
        }

        .nav-links {
            display: none;
        }

        .main-content {
            flex-direction: column;
            padding: 6rem 5% 3rem;
            text-align: center;
        }

        .main-title {
            font-size: 2.5rem;
        }

        .content-left, .content-right {
            max-width: 100%;
        }

        .hero-image {
            margin-top: 2rem;
        }

        .search-bar {
            flex-direction: column;
        }

        .search-input, .search-btn {
            width: 100%;
        }
    }

    .service-card {
        cursor: pointer;
    }

    .service-details-modal .modal-content {
        border-radius: 1rem;
        border: none;
    }

    .service-details-modal .modal-header {
        border-bottom: none;
        padding: 2rem 2rem 1rem;
    }

    .service-details-modal .modal-body {
        padding: 1rem 2rem 2rem;
    }

    .service-details-modal .modal-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary);
    }

    .service-details-icon {
        font-size: 3rem;
        color: var(--accent);
        margin-bottom: 1rem;
    }

    .service-details-category {
        background: rgba(239, 35, 60, 0.1);
        color: var(--accent);
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-weight: 500;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .service-details-price {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .service-details-description {
        color: var(--secondary);
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .service-details-meta {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .service-details-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--secondary);
    }

    .service-details-meta-item i {
        color: var(--accent);
    }

    .service-details-actions {
        display: flex;
        gap: 1rem;
    }

    .service-details-btn {
        flex: 1;
        padding: 0.75rem;
        border-radius: 0.5rem;
        font-weight: 500;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .service-details-btn.primary {
        background: var(--accent);
        color: var(--surface);
    }

    .service-details-btn.secondary {
        background: var(--background);
        color: var(--primary);
    }

    .service-details-btn:hover {
        transform: translateY(-2px);
    }

    .service-details-btn.primary:hover {
        background: #D90429;
    }

    .service-details-btn.secondary:hover {
        background: var(--border);
    }
</style>
@endpush

@section('content')
<nav class="navbar">
    <a href="/" class="logo">Healthy Habitat Network</a>
    <div class="nav-links">
        <a href="#featured-services">Services</a>
        <a href="#categories">Categories</a>
        <a href="#about-section">About Us</a>
        @auth
            <a href="javascript:void(0)" onclick="handleLogout()" class="login-btn">Logout</a>
        @else
            <a href="javascript:void(0)" onclick="showLoginModal()" class="login-btn">Log in</a>
        @endauth
    </div>
</nav>

<main class="main-content">
    <div class="content-left">
        <h1 class="main-title">Discover Sustainable Living</h1>
        <p class="main-description">Explore eco-friendly services and sustainable solutions for a better tomorrow.</p>
        <a href="#services" class="explore-btn">Explore Services</a>
    </div>
    <div class="content-right">
        <img src="{{ asset('images/forest.png') }}" alt="Healthy Living" class="hero-image">
    </div>
</main>

<section class="categories" id ="categories">
    <h2 class="categories-title">Explore Our Categories</h2>
    <div class="categories-grid">
        @foreach($categories as $category)
        <div class="category-card">
            <i class="{{ $category->icon }} category-icon"></i>
            <h3>{{ $category->name }}</h3>
            <p>{{ $category->description }}</p>
        </div>
        @endforeach
    </div>
</section>

<section class="about-section"  id="about-section">
    <h2>About Us</h2>
    <p>Healthy Habitat Network is dedicated to promoting wellness and sustainability. We connect individuals with quality services and products that foster a healthier, more sustainable lifestyle. Join our community and start your wellness journey today.</p>
</section>

<section id="services" class="featured-services">
    <h2>Featured Services</h2>
    <div class="services-grid">
        @foreach($featuredServices as $service)
        <a href="{{ route('service.details', $service) }}" class="service-card">
            <div class="service-image-container">
                <i class="{{ $service->category->icon }} service-icon"></i>
            </div>
            <div class="service-content">
                <h3 class="service-title">{{ $service->name }}</h3>
                <p class="service-description">{{ Str::limit($service->description, 100) }}</p>
                <div class="service-meta">
                    <span class="service-category">{{ $service->category->name }}</span>
                    <span class="service-price">${{ number_format($service->price, 2) }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</section>

<!-- Include the login modal -->
@include('auth.login-modal')

<!-- Include necessary scripts -->
<script src="{{ asset('js/auth-modals.js') }}"></script>

<!-- Service Details Modal -->
<div class="modal fade service-details-modal" id="serviceDetailsModal" tabindex="-1" aria-labelledby="serviceDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceDetailsModalLabel">Service Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-leaf service-details-icon"></i>
                    <h3 class="service-details-title mb-2">Service Name</h3>
                    <span class="service-details-category">Category</span>
                    <div class="service-details-price">$0.00</div>
                </div>
                <p class="service-details-description">Service description goes here.</p>
                <div class="service-details-meta">
                    <div class="service-details-meta-item">
                        <i class="fas fa-clock"></i>
                        <span>Duration: 60 min</span>
                    </div>
                    <div class="service-details-meta-item">
                        <i class="fas fa-star"></i>
                        <span>4.5 (120 reviews)</span>
                    </div>
                </div>
                <div class="service-details-actions">
                    <a href="#" class="service-details-btn primary">Book Now</a>
                    <a href="#" class="service-details-btn secondary">View Provider</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Add Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<script>
function handleLogout() {
    // Create a form and submit it to handle the logout
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("logout") }}';
    
    // Add CSRF token
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    form.appendChild(csrfToken);
    
    // Add the form to the document and submit it
    document.body.appendChild(form);
    form.submit();
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap modal
    const serviceDetailsModal = new bootstrap.Modal(document.getElementById('serviceDetailsModal'));

    // Get all service cards
    const serviceCards = document.querySelectorAll('.service-card');

    // Add click event to each service card
    serviceCards.forEach(card => {
        card.addEventListener('click', function() {
            const serviceId = this.dataset.serviceId;
            const serviceName = this.querySelector('.service-title').textContent;
            const serviceDescription = this.querySelector('.service-description').textContent;
            const serviceCategory = this.querySelector('.service-category').textContent;
            const servicePrice = this.querySelector('.service-price').textContent;
            const serviceIcon = this.querySelector('.service-icon').className;

            // Update modal content
            document.querySelector('.service-details-icon').className = serviceIcon;
            document.querySelector('.service-details-title').textContent = serviceName;
            document.querySelector('.service-details-category').textContent = serviceCategory;
            document.querySelector('.service-details-price').textContent = servicePrice;
            document.querySelector('.service-details-description').textContent = serviceDescription;

            // Update action buttons
            const bookNowBtn = document.querySelector('.service-details-btn.primary');
            const viewProviderBtn = document.querySelector('.service-details-btn.secondary');
            bookNowBtn.href = `/services/${serviceId}/book`;
            viewProviderBtn.href = `/services/${serviceId}`;

            // Show modal
            serviceDetailsModal.show();
        });
    });

    // Smooth scrolling for all anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endpush