// Add this to your JavaScript file or inline script
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Update your form submission handler
$('.login-form').on('submit', function(e) {
    e.preventDefault();
    
    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            if (response.success) {
                window.location.href = response.redirect;
            } else {
                alert(response.message || 'Login failed. Please check your credentials.');
            }
        },
        error: function(xhr) {
            if (xhr.status === 419) {
                alert('Your session has expired. Please refresh the page and try again.');
            } else {
                alert('An error occurred. Please try again.');
            }
        }
    });
});