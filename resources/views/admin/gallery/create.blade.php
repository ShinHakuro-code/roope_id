@extends('layouts.admin')

@section('title', 'Add Gallery Image')

@section('content')
<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h2 mb-0">Add New Gallery Image</h1>
        <a href="{{ route('admin.gallery') }}" class="btn btn-secondary">Back to Gallery</a>
    </div>
</div>

<div class="admin-card">
    <div class="card-body">
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn admin-btn-primary">Add to Gallery</button>
        </form>
    </div>
</div>
@endsection