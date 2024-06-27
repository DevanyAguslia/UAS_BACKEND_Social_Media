<!-- resources/views/friendship/friend-list.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend List</title>
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
    </style>
</head>
<body>
    <h1>Friend List</h1>
    <ul>
        @if(empty($friends))
            <li>No friends found</li>
        @else
            @foreach ($friends as $friend)
                @if ($friend->username != auth()->user()->username)
                    <li>
                        {{ $friend->username }}
                        <form action="{{ route('unfriend') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                            <button type="submit">Unfriend</button>
                        </form>
                    </li>
                @endif
            @endforeach
        @endif
    </ul>
</body>
</html>
