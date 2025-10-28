@extends('layouts.admin')

@section('title', 'Gallery Management')

@section('content')
<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h2 mb-0">Gallery Management</h1>
        <a href="{{ route('admin.gallery.create') }}" class="btn admin-btn-primary">Add New Image</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success admin-alert">
        {{ session('success') }}
    </div>
@endif

@if($galleries->count() > 0)
    <div class="row">
        @foreach($galleries as $gallery)
            <div class="col-md-4 mb-4">
                <div class="admin-card">
                    <img src="{{ asset('storage/' . $gallery->image) }}" class="gallery-image" alt="{{ $gallery->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $gallery->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($gallery->description, 100) }}</p>
                        <div class="btn-group w-100">
                            <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $galleries->links() }}
    </div>
@else
    <div class="admin-card">
        <div class="card-body text-center py-5">
            <h4 class="text-muted">No images found in gallery</h4>
            <p class="text-muted">Start by adding your first image to the gallery.</p>
            <a href="{{ route('admin.gallery.create') }}" class="btn admin-btn-primary">Add First Image</a>
        </div>
    </div>
@endif
@endsection