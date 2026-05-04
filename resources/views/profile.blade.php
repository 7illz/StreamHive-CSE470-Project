<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #2a2a2a;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 350px;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }
        .form-group input {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #444;
            border-radius: 4px;
            background-color: #333;
            color: #fff;
        }
        .form-group span {
            color: #f44336;
            font-size: 0.8rem;
            margin-top: 0.25rem;
            display: block;
        }
        button {
            width: 100%;
            padding: 0.6rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 1rem;
        }
        button:hover {
            background-color: #0056b3;
        }
        .toggle-password {
            cursor: pointer;
            color: #007bff;
            font-size: 0.9rem;
            margin-top: 0.5rem;
            display: inline-block;
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #fff;
        }
        .divider {
            border-top: 1px solid #444;
            margin: 1.5rem 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Profile Settings</h2>

        @if(session('success'))
            <div style="color: #4caf50; text-align: center; margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{route('profile.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Change Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="divider"></div>

            <div class="form-group">
                <label for="old_password">Old Password (Optional)</label>
                <input type="password" name="old_password" id="old_password">
                @error('old_password')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="new_password">New Password (Optional)</label>
                <input type="password" name="new_password" id="new_password" minlength="6">
                <span class="toggle-password" onclick="togglePassword('new_password')">Show Password</span>
                @error('new_password')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation">
                <span class="toggle-password" onclick="togglePassword('new_password_confirmation')">Show Password</span>
            </div>

            <button type="submit">Update Profile</button>
        </form>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            if (field.type === "password") {
                field.type = "text";
            } else {
                field.type = "password";
            }
        }
    </script>
</body>
</html>