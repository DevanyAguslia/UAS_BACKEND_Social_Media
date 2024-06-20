<!-- resources/views/feeds/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Feed</div>

                <div class="card-body">
                    <form action="{{ route('feeds.update', $feed->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="3">{{ old('content', $feed->content) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                            @if($feed->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $feed->image) }}" alt="Current Image" style="max-width: 100%;">
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Update Feed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
