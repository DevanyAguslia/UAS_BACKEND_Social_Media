<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend Requests</title>
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
        @foreach ($friendRequests as $request)
            <li>
                From: {{ $request->sender->username }} 
                @if ($request->status == 'pending')
                    <form action="{{ route('accept-friend-request') }}" method="post">
                        @csrf
                        <input type="hidden" name="request_id" value="{{ $request->id }}">
                        <button type="submit">Accept</button>
                    </form>
                    <form action="{{ route('reject-friend-request') }}" method="post">
                        @csrf
                        <input type="hidden" name="request_id" value="{{ $request->id }}">
                        <button type="submit">Reject</button>
                    </form>
                @elseif ($request->status == 'accepted')
                    <span>Accepted</span>
                @else
                    <span>Rejected</span>
                @endif
            </li>
        @endforeach
    </ul>
</body>
</html>
