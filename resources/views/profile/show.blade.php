    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                color: #333;
                margin: 0;
                padding: 0;
            }
            .navbar {
                background-color: #333;
                color: #fff;
                padding: 10px 0;
                text-align: center;
            }
            .navbar a {
                color: #fff;
                padding: 10px 20px;
                text-decoration: none;
                display: inline-block;
            }
            .navbar a:hover {
                background-color: #555;
            }
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
                min-height: calc(100vh - 60px);
            }
            .profile-card {
                background-color: #fff;
                padding: 40px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 800px;
                text-align: center;
            }
            .profile-card h2 {
                margin-top: 0;
                color: #555;
            }
            .profile-details p {
                margin: 20px 0;
                font-size: 18px;
            }
            .profile-details strong {
                color: #333;
            }
            .logout-button {
                display: block;
                width: 100%;
                padding: 15px;
                margin: 20px 0;
                border: none;
                border-radius: 4px;
                background-color: #333;
                color: #fff;
                text-align: center;
                font-size: 18px;
                cursor: pointer;
            }
            .logout-button:hover {
                background-color: #555;
            }
        </style>
    </head>
    <body>
        <div class="navbar">
            <a href="{{ route('friend-requests') }}" class="btn btn-primary">Friend Requests</a>
            <a href="{{ route('friend-list') }}" class="btn btn-primary">Friend List</a>
            <a href="{{ route('messages.index') }}" class="btn btn-primary">Inbox</a>
            <a href="{{ route('messages.create') }}" class="btn btn-primary">New Message</a>
            <a href="{{ route('feeds.index') }}" class="btn btn-primary">Feeds</a>
        </div>

        </div>
    </body>
    </html>

    <!-- resources/views/profile/show.blade.php -->

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f2f5;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .profile {
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-width: 400px;
                width: 100%;
                text-align: center;
            }
            .profile h1 {
                margin-bottom: 20px;
            }
            .profile-picture img {
                width: 150px;
                height: 150px;
                border-radius: 50%;
                object-fit: cover;
                margin-bottom: 20px;
            }
            .bio {
                margin-bottom: 20px;
            }
            .alert {
                padding: 10px;
                margin-bottom: 20px;
                border-radius: 5px;
            }
            .alert-success {
                background-color: #d4edda;
                color: #155724;
            }
            .alert-danger {
                background-color: #f8d7da;
                color: #721c24;
            }
        </style>
    </head>
    <body>
        <div class="profile">
            <h1>{{ $user->name }}</h1>
            <div class="profile-picture">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
                @else
                    <img src="{{ asset('storage/default-profile.png') }}" alt="Default Profile Picture">
                @endif
            </div>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <div class="bio">
                <p>{{ $user->bio }}</p>
            </div>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
        </div>
        
    </body>
    </html>

    <!-- resources/views/profile.blade.php -->

