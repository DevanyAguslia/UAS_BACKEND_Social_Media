<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <header>
        <h1>Welcome to Home</h1>
    </header>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('profile') }}">Profile</a></li>
            <li><a href="{{ route('create') }}">Create</a></li>
            <li><a href="{{ route('message') }}">Message</a></li>
            <li><a href="{{ route('friends') }}">Friends</a></li>
            <li><a href="{{ route('settings') }}">Settings</a></li>
            
                

    </nav>
    <div class="content">
    
    </div>
</body>
</html>
