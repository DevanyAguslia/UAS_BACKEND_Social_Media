<!-- resources/views/friendship/addFriend.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend Requests</title>
    <style>
        body {
            background-color: #f0f0ff; /* Warna latar belakang */
            color: #4b0082; /* Warna teks */
        }

        h1 {
            color: #800080; /* Warna judul */
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            padding: 5px;
            background-color: #e6e6fa; /* Warna latar belakang daftar */
            border-radius: 5px;
        }

        .friend {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Friend Requests</h1>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('search-users') }}" method="GET">
        <input type="text" name="search" placeholder="Search users...">
        <button type="submit">Search</button>
    </form>
    <ul>
        @foreach($dicari as $result)
            @if ($result['username'] != auth()->user()->username)
            <li>
                {{$result['username']}}
                @if ($friendIds->contains($result['id']))
                    <span class="friend">Friend</span>
                @else
                    <form action="{{ route('send-friend-request') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $result['id'] }}">
                        <button type="submit">Add Friend</button>
                    </form>
                @endif
            </li>
            @endif
        @endforeach
    </ul>
</body>
</html>
