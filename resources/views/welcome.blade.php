<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
    <div class="profile-container">
        <div class="profile-card">
            <h2>User Profile</h2>
            <div class="profile-details">
                <p><strong>Username:</strong> {{ $user->username }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
            <!-- Button to Friend Requests Page -->
            <a href="{{ route('friend-requests') }}" class="btn btn-primary">Friend Requests</a>
            <!-- Button to Friend List Page -->
            <a href="{{ route('friend-list') }}" class="btn btn-primary">Friend List</a>
        </div>
    </div>
</body>
</html>
