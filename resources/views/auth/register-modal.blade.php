<div class="modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 justify-content-end">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-5 py-4">
                <div class="text-center mb-4">
                    <h1 class="modal-title fw-bold mb-2">Create Your Account</h1>
                    <p class="text-muted">Join Healthy Habitat Network today</p>
                </div>

                <ul class="nav nav-pills nav-justified mb-4" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#userRegister">
                            <i class="fas fa-user me-2"></i>User Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#businessRegister">
                            <i class="fas fa-building me-2"></i>Business Account
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- User Registration Form -->
                    <div class="tab-pane fade show active" id="userRegister">
                        <form method="POST" action="{{ route('register') }}" class="register-form">
                            @csrf
                            <input type="hidden" name="role" value="user">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                        name="name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                        name="email" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                        name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" 
                                        name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                    name="phone" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                    name="address" rows="2" required></textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">Create Account</button>
                            
                            <div class="text-center">
                                <p class="mb-0">Already have an account? 
                                    <a href="#" class="text-primary" onclick="showLoginModal()">Sign In</a>
                                </p>
                            </div>
                        </form>
                    </div>

                    <!-- Business Registration Form -->
                    <div class="tab-pane fade" id="businessRegister">
                        <form method="POST" action="{{ route('register') }}" class="register-form">
                            @csrf
                            <input type="hidden" name="role" value="business">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Business Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                        name="name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Business Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                        name="email" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                        name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" 
                                        name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Business Phone</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                    name="phone" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Business Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                    name="address" rows="2" required></textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">Register Business</button>
                            
                            <div class="text-center">
                                <p class="mb-0">Already have a business account? 
                                    <a href="#" class="text-primary" onclick="showLoginModal()">Sign In</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showRegisterModal() {
    // Hide login modal
    const loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
    if (loginModal) {
        loginModal.hide();
    }
    
    // Show register modal
    const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
    registerModal.show();
}

function showLoginModal() {
    // Hide register modal
    const registerModal = bootstrap.Modal.getInstance(document.getElementById('registerModal'));
    if (registerModal) {
        registerModal.hide();
    }
    
    // Show login modal
    const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
    loginModal.show();
}
</script>

<style>
.modal-content {
    border: none;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.nav-pills .nav-link {
    color: #666;
    border-radius: 8px;
    padding: 0.75rem;
    transition: all 0.3s ease;
}

.nav-pills .nav-link.active {
    background-color: #4CAF50;
    color: white;
}

.form-control {
    border-radius: 8px;
    padding: 0.75rem;
    border: 1px solid #dee2e6;
}

.form-control:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
}

.btn-primary {
    background-color: #4CAF50;
    border-color: #4CAF50;
    border-radius: 8px;
    padding: 0.75rem;
}

.btn-primary:hover {
    background-color: #3d8b40;
    border-color: #3d8b40;
}

@media (max-width: 768px) {
    .modal-dialog {
        margin: 1rem;
    }
}
</style>