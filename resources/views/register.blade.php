<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h2>Register</h2>
<div id="message" style="color: red; margin-bottom: 10px;"></div>
<form id="registerForm" method="POST" action="/api/register">
    <label>Name</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>
</form>

<script>
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    const messageDiv = document.getElementById('message');
    messageDiv.textContent = '';
    messageDiv.style.color = 'red';

    try {
        const response = await fetch('/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const responseData = await response.json();

        if (response.ok) {
            messageDiv.style.color = 'green';
            messageDiv.textContent = 'Registration successful! Redirecting to login...';
            setTimeout(() => {
                window.location.href = '/login';
            }, 2000);
        } else {
            if (responseData.errors) {
                const errors = Object.values(responseData.errors).flat();
                messageDiv.textContent = errors.join(', ');
            } else {
                messageDiv.textContent = responseData.message || 'Registration failed';
            }
        }
    } catch (error) {
        messageDiv.textContent = 'An error occurred. Please try again.';
    }
});
</script>
</body>
</html>
