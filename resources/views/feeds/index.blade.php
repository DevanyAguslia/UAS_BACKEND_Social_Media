@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Feeds</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Tombol untuk membuat feed baru -->
                    <div class="mb-3">
                        <a href="{{ route('feeds.create') }}" class="btn btn-primary">Create New Feed</a>
                    </div>

                    @foreach($feeds as $feed)
                        <div class="media mb-3">
                            <!-- Tampilkan gambar jika ada -->
                            @if($feed->image)
                                <img src="{{ asset('storage/' . $feed->image) }}" class="mr-3" alt="{{ $feed->content }}" style="max-width: 100px;">
                            @endif
                            <div class="media-body">
                                <h5 class="mt-0">{{ $feed->user->username }}</h5>
                                <p>{{ $feed->content }}</p>
                                <!-- Tampilkan gambar jika ada -->
                                @if($feed->image)
                                    <img src="{{ asset('storage/' . $feed->image) }}" alt="Feed Image" style="max-width: 300px;">
                                @endif
                                <div class="mt-2">
                                    <a href="{{ route('feeds.edit', $feed->id) }}" class="btn btn-secondary">Edit</a>
                                    <form action="{{ route('feeds.destroy', $feed->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
