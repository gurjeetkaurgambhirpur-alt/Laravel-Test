<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h2>Login</h2>
<div id="message" style="color: red; margin-bottom: 10px;"></div>
<form id="loginForm" method="POST" action="/api/login">
    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    const messageDiv = document.getElementById('message');
    messageDiv.textContent = '';
    messageDiv.style.color = 'red';

    try {
        const response = await fetch('/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const responseData = await response.json();

        if (response.ok) {
            // Store token in localStorage
            localStorage.setItem('auth_token', responseData.token);
            messageDiv.style.color = 'green';
            messageDiv.textContent = 'Login successful! Redirecting...';
            setTimeout(() => {
                window.location.href = '/movie';
            }, 2000);
        } else {
            messageDiv.textContent = responseData.message || 'Login failed';
        }
    } catch (error) {
        messageDiv.textContent = 'An error occurred. Please try again.';
    }
});
</script>
</body>
</html>
