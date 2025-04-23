<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 pb-5 pt-0">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Welcome Back</h3>
                    <p class="text-muted">Sign in to continue to your account</p>
                </div>

                <ul class="nav nav-pills nav-fill mb-4" id="loginTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-pill" id="user-tab" data-bs-toggle="tab" data-bs-target="#userLogin" type="button" role="tab">
                            <i class="fas fa-user me-2"></i>User
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill" id="business-tab" data-bs-toggle="tab" data-bs-target="#businessLogin" type="button" role="tab">
                            <i class="fas fa-building me-2"></i>Business
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill" id="admin-tab" data-bs-toggle="tab" data-bs-target="#adminLogin" type="button" role="tab">
                            <i class="fas fa-shield-alt me-2"></i>Admin
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="loginTabsContent">
                    <!-- User Login Form -->
                    <div class="tab-pane fade show active" id="userLogin" role="tabpanel">
                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf
                            <input type="hidden" name="role" value="user">
                            
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="modal-userEmail" name="email" placeholder="name@example.com" required>
                                <label for="modal-userEmail">Email address</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="modal-userPassword" name="password" placeholder="Password" required>
                                <label for="modal-userPassword">Password</label>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="modal-userRemember">
                                    <label class="form-check-label" for="modal-userRemember">Remember me</label>
                                </div>
                                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password?</a>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-2 mb-4">Sign In</button>
                            
                            <div class="text-center">
                                <p class="mb-0">Don't have an account? 
                                    <a href="#" class="text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#registerModal">Sign Up</a>
                                </p>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Business Login Form -->
                    <div class="tab-pane fade" id="businessLogin" role="tabpanel">
                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf
                            <input type="hidden" name="role" value="business">
                            
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="modal-businessEmail" name="email" placeholder="name@example.com" required>
                                <label for="modal-businessEmail">Business Email</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="modal-businessPassword" name="password" placeholder="Password" required>
                                <label for="modal-businessPassword">Password</label>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="modal-businessRemember">
                                    <label class="form-check-label" for="modal-businessRemember">Remember me</label>
                                </div>
                                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password?</a>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-2 mb-4">Sign In</button>
                            
                            <div class="text-center">
                                <p class="mb-0">Don't have a business account? 
                                    <a href="#" class="text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#registerBusinessModal">Register Business</a>
                                </p>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Admin Login Form -->
                    <div class="tab-pane fade" id="adminLogin" role="tabpanel">
                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf
                            <input type="hidden" name="role" value="admin">
                            
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="modal-adminEmail" name="email" placeholder="name@example.com" required>
                                <label for="modal-adminEmail">Admin Email</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="modal-adminPassword" name="password" placeholder="Password" required>
                                <label for="modal-adminPassword">Password</label>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="modal-adminRemember">
                                    <label class="form-check-label" for="modal-adminRemember">Remember me</label>
                                </div>
                                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password?</a>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-2 mb-4">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-content {
        border: none;
        overflow: hidden;
    }
    
    .nav-pills .nav-link {
        color: #6c757d;
        font-weight: 500;
        padding: 0.75rem 1rem;
        transition: all 0.2s ease;
    }
    
    .nav-pills .nav-link.active {
        background-color: #4CAF50;
        color: white;
        box-shadow: 0 4px 8px rgba(76, 175, 80, 0.2);
    }
    
    .form-floating > .form-control {
        padding: 1rem 0.75rem;
    }
    
    .form-control:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
    }
    
    .btn-primary {
        background-color: #4CAF50;
        border-color: #4CAF50;
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: #3d8b40;
        border-color: #3d8b40;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .form-check-input:checked {
        background-color: #4CAF50;
        border-color: #4CAF50;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all login forms
    const loginForms = document.querySelectorAll('.login-form');
    
    // Add submit event listener to each form
    loginForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Signing in...';
            submitBtn.disabled = true;
            
            // Get form data
            const formData = new FormData(this);
            
            // Add CSRF token to headers
            const headers = new Headers();
            headers.append('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            
            // Submit form using fetch
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: headers,
                credentials: 'same-origin'
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                } else {
                    return response.json();
                }
            })
            .then(data => {
                if (data && data.error) {
                    throw new Error(data.error);
                }
            })
            .catch(error => {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // Show error message
                alert(error.message || 'Login failed. Please try again.');
            });
        });
    });
});
</script>