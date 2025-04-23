<div class="modal fade" id="forgotPasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <p>Remember your password? <a href="#" onclick="showLoginModal()">Login here</a></p>
            </div>
        </div>
    </div>
</div>