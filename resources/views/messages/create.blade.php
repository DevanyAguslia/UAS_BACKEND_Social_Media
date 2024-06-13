@extends('layouts.app')

@section('content')
<div class="container">
    <h1>New Message</h1>
    <form action="{{ route('messages.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="receiver_id">Recipient</label>
            <select name="receiver_id" id="receiver_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="message">Message</label>
            <textarea name="message" id="message" rows="5" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Send</button>
    </form>
</div>
@endsection
