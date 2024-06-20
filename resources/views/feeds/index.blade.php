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
                            
                            <div class="media-body">
                                <h5 class="mt-0">{{ $feed->user->username }}</h5>
                                <p>{{ $feed->content }}</p>
                                <!-- Tampilkan gambar jika ada -->
                                @if($feed->image)
                                    <img src="{{ asset('storage/' . $feed->image) }}" alt="Feed Image" style="max-width: 300px;">
                                @endif
                                <div class="mt-2">
                                    <form action="{{ route('feeds.like', $feed->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            Like ({{ $feed->likes->count() }})
                                        </button>
                                    </form>
                                    <a href="{{ route('feeds.edit', $feed->id) }}" class="btn btn-secondary">Edit</a>
                                    <form action="{{ route('feeds.destroy', $feed->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                                <div class="mt-2">
                                    <form action="{{ route('feeds.comment', $feed->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <textarea class="form-control" name="comment" rows="2" placeholder="Add a comment"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Comment</button>
                                    </form>
                                    @foreach($feed->comments as $comment)
                                        <div class="media mt-3">
                                            <div class="media-body">
                                                <h6 class="mt-0">{{ $comment->user->username }}</h6>
                                                {{ $comment->comment }}
                                            </div>
                                        </div>
                                    @endforeach
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
