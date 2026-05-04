<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamHive</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="hero">
        <video autoplay muted loop id="bg-video">
            <source src="{{ asset('images/bg1.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <div class="auth-container">
        <div class="auth-logo">StreamHive</div>
        <h1 class="auth-title">Create Account</h1>
        <form action="/signup" method="POST">
            @csrf
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" placeholder="User name" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            
            <label for="age">Age</label>
            <input type="number" id="age" name="age" placeholder="Enter your age" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="At least 6 characters" required>
            
            <label for="confirm-password">Re-enter Password</label>
            <input type="password" id="confirm-password" placeholder="Confirm your password" required>
            
            <div class="error-message" id="error-message"></div>
            
            <button type="submit" class="primary-button1">Create Your StreamHive Account</button>
        </form>
        
        <div class="auth-divider"><span>Already have an account?</span></div>
        
        <div class="auth-footer">
            <p>Already have an account? <a href="{{route('login')}}">Sign-In</a></p>
        </div>
    </div>
    <script>
        const form = document.querySelector('form');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm-password');
        const errorMessage = document.getElementById('error-message');

        form.addEventListener('submit', function(event) {
            if (passwordInput.value !== confirmPasswordInput.value) {
                event.preventDefault();
                errorMessage.textContent = "Passwords do not match";
            } else {
                errorMessage.textContent = "";
            }
        });
    </script>
</body>
</html>