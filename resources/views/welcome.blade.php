<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Chatter</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container text-center">
        <img src="{{ asset('images/logoo chatter backend.png') }}" alt="Chatter Logo" style="width: 200px; height: auto;">
        <h1>Welcome to Chatter</h1>
        <p>Sudah punya akun?</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
    </div>
</body>
</html>
