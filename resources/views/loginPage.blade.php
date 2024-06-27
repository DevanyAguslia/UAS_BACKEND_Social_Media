<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="{{ old('username') }}" required>
        @if ($errors->has('username'))
            <span>{{ $errors->first('username') }}</span>
        @endif
        
        <br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        @if ($errors->has('password'))
            <span>{{ $errors->first('password') }}</span>
        @endif
        
        <br><br>
        
        <input type="submit" value="Login">
    </form>

    <p>If you don't have an account, <a href="{{ route('register') }}">register here</a>.</p>
</body>
</html>
