@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Inbox</h1>
    <a href="{{ route('messages.create') }}" class="btn btn-primary">New Message</a>
    <ul class="list-group mt-3">
        @foreach($messages as $message)
            <li class="list-group-item">
                <strong>{{ $message->sender->username }} to {{ $message->receiver->username }}:</strong>
                <p>{{ $message->message }}</p>
                <span class="text-muted">{{ $message->created_at->diffForHumans() }}</span>
            </li>
        @endforeach
    </ul>
</div>
@endsection
