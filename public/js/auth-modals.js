let loginModal = null;
let registerModal = null;
let forgotPasswordModal = null;

document.addEventListener("DOMContentLoaded", function () {
    loginModal = new bootstrap.Modal(document.getElementById("loginModal"));
    registerModal = new bootstrap.Modal(
        document.getElementById("registerModal")
    );
    forgotPasswordModal = new bootstrap.Modal(
        document.getElementById("forgotPasswordModal")
    );

    // Handle form submissions
    setupFormHandlers();

    // Handle validation errors
    handleValidationErrors();
});

function showLoginModal() {
    registerModal?.hide();
    forgotPasswordModal?.hide();
    loginModal.show();
}

function showRegisterModal() {
    loginModal?.hide();
    forgotPasswordModal?.hide();
    registerModal.show();
}

function showForgotPassword() {
    loginModal?.hide();
    registerModal?.hide();
    forgotPasswordModal.show();
}

function setupFormHandlers() {
    const forms = document.querySelectorAll(".login-form, .register-form");
    forms.forEach((form) => {
        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            const formData = new FormData(form);

            try {
                const response = await fetch(form.action, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                        Accept: "application/json",
                    },
                });

                const data = await response.json();

                if (data.success) {
                    // Show success message
                    showAlert(data.message, "success");

                    // Close the modal
                    const modal = form.closest(".modal");
                    if (modal) {
                        const bsModal = bootstrap.Modal.getInstance(modal);
                        if (bsModal) {
                            bsModal.hide();
                        }
                    }

                    // Redirect after a short delay to show the message
                    setTimeout(() => {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            window.location.reload();
                        }
                    }, 1500);
                } else {
                    if (data.errors) {
                        showErrors(form, data.errors);
                    } else {
                        showAlert(
                            data.message ||
                                "An error occurred. Please try again."
                        );
                    }
                }
            } catch (error) {
                console.error("Error:", error);
                showAlert("An error occurred. Please try again.");
            }
        });
    });
}

function handleValidationErrors() {
    if (window.errors) {
        const form = document.querySelector(".login-form, .register-form");
        showErrors(form, window.errors);
    }
}

function showErrors(form, errors) {
    // Clear previous errors
    form.querySelectorAll(".invalid-feedback").forEach((el) => el.remove());
    form.querySelectorAll(".is-invalid").forEach((el) =>
        el.classList.remove("is-invalid")
    );

    // Show new errors
    Object.keys(errors).forEach((field) => {
        const input = form.querySelector(`[name="${field}"]`);
        if (input) {
            input.classList.add("is-invalid");
            const feedback = document.createElement("div");
            feedback.className = "invalid-feedback";
            feedback.textContent = errors[field][0];
            input.parentNode.appendChild(feedback);
        }
    });
}

function showAlert(message, type = "error") {
    // Remove any existing alerts
    document.querySelectorAll(".alert").forEach((alert) => alert.remove());

    const alertDiv = document.createElement("div");
    alertDiv.className = `alert alert-${
        type === "error" ? "danger" : "success"
    } alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
    alertDiv.style.zIndex = "9999";
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(alertDiv);

    // Auto-dismiss after 3 seconds for success messages
    if (type === "success") {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alertDiv);
            bsAlert.close();
        }, 3000);
    }
}
