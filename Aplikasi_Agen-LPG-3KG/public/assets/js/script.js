// filepath: c:\xampp\htdocs\Aplikasi_Agen-LPG-3KG\public\assets\js\script.js
document.addEventListener('DOMContentLoaded', function() {
    // User authentication handling
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            // Perform login AJAX request
            const formData = new FormData(loginForm);
            fetch('/auth/login', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/distribution';
                } else {
                    alert(data.message);
                }
            });
        });
    }

    // Registration handling
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            event.preventDefault();
            // Perform registration AJAX request
            const formData = new FormData(registerForm);
            fetch('/auth/register', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Registration successful! Please log in.');
                    window.location.href = '/auth/login';
                } else {
                    alert(data.message);
                }
            });
        });
    }

    // Distribution planning handling
    const distributionForm = document.getElementById('distributionForm');
    if (distributionForm) {
        distributionForm.addEventListener('submit', function(event) {
            event.preventDefault();
            // Perform distribution planning AJAX request
            const formData = new FormData(distributionForm);
            fetch('/distribution/plan', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Distribution plan saved successfully!');
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            });
        });
    }

    // Payment transaction handling
    const paymentForm = document.getElementById('paymentForm');
    if (paymentForm) {
        paymentForm.addEventListener('submit', function(event) {
            event.preventDefault();
            // Perform payment transaction AJAX request
            const formData = new FormData(paymentForm);
            fetch('/payment/transaction', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Payment processed successfully!');
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            });
        });
    }
});