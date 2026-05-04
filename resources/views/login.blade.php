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
        <h1 class="auth-title">Sign-In</h1>
        <form action="/login" method="POST">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            
            <button type="submit" name="login" class="primary-button1">Sign-In</button>
            
            <button type="button" id="toggle-password" class="secondary-button">Show Password</button>
        </form>
        
        <div class="auth-divider"><span>New to StreamHive?</span></div>
        
        <div class="auth-footer">
            <p>Don't have an account? <a href="{{route('signup')}}">Create your StreamHive account</a></p>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('toggle-password');

        togglePasswordButton.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                togglePasswordButton.textContent = 'Hide Password';
            } else {
                passwordInput.type = 'password';
                togglePasswordButton.textContent = 'Show Password';
            }
        });
    </script>
</body>
</html>