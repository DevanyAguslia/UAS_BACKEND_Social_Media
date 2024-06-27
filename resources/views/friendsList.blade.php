<!-- resources/views/friends/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Daftar Teman</h1>

    <ul>
        @foreach($friends as $friend)
            <li>{{ $friend->name }} 
                <form action="/friends/remove" method="post">
                    @csrf
                    <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h2>Tambah Teman Baru</h2>
    <form action="/friends/add" method="post">
        @csrf
        <select name="friend_id">
            @foreach($users as $user)
                @if(!$friends->contains($user))
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endif
            @endforeach
        </select>
        <button type="submit">Tambah Teman</button>
    </form>
@endsection
