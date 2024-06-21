<!-- resources/views/partials/navbar.blade.php -->

<div class="navbar">
    <a href="{{ route('friend-requests') }}" class="btn btn-primary">Friend Requests</a>
    <a href="{{ route('friend-list') }}" class="btn btn-primary">Friend List</a>
    <a href="{{ route('messages.index') }}" class="btn btn-primary">Inbox</a>
    <a href="{{ route('messages.create') }}" class="btn btn-primary">New Message</a>
    <a href="{{ route('feeds.index') }}" class="btn btn-primary">Feeds</a>
</div>
