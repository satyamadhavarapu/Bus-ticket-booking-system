// login.js

document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Add your login validation logic here
        if (username && password) {
            // Redirect to bus selection page after successful login
            window.location.href = 'bus-selection.html';
        } else {
            alert('Please enter both username and password.');
        }
    });
});
