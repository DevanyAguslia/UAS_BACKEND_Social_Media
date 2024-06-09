<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <br><br>
        
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        
        <br><br>
        
        <input type="submit" value="Register">
    </form>

    <p>Already have an account? <a href="{{ route('login') }}">Login here</a>.</p>
</body>
</html>
