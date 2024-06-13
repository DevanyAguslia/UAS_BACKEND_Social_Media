<!-- resources/views/feeds/index.blade.php -->

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
                            <!-- <img src="{{ asset('storage/' . $feed->image) }}" class="mr-3" alt="{{ $feed->content }}" style="max-width: 100px;"> -->
                            <div class="media-body">
                                <h5 class="mt-0">{{ $feed->user->username }}</h5>
                                <p>{{ $feed->content }}</p>
                                <!-- Tampilkan gambar jika ada -->
                                @if($feed->image)
                                    <img src="{{ asset('storage/' . $feed->image) }}" alt="Feed Image" style="max-width: 300px;">
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
