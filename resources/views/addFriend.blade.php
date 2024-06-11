<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend Requests</title>
</head>
<body>
    <h1>Friend Requests</h1>
    <form action="{{ route('search-users') }}" method="GET">
        <input type="text" name="search" placeholder="Search users...">
        <button type="submit">Search</button>
    </form>
    <ul>
    @foreach($dicari as $result)
        @if ($result['username'] != auth()->user()->username)
        <li>
            {{$result['username']}}
            <form action="{{ route('send-friend-request') }}" method="POST">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $result['id'] }}">
                <button type="submit">Add Friend</button>
            </form>
        </li>
        @endif
    @endforeach
    </ul>
</body>
</html>
