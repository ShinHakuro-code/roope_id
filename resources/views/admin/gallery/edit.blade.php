@extends('layouts.admin')

@section('title', 'Edit Gallery Image')

@section('content')
<style>
    .image-preview-container {
        border: 1px dashed #ccc;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 10px;
        display: inline-block;
    }
    .current-image {
        max-width: 250px;
        height: auto;
        border-radius: 4px;
        object-fit: cover;
    }
</style>

<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h2 mb-0">Edit Gallery Image: {{ Str::limit($gallery->title, 30) }}</h1>
        <a href="{{ route('admin.gallery') }}" class="btn btn-secondary">Back to Gallery</a>
    </div>
</div>

{{-- Tambahkan notifikasi success/error jika ada --}}
@if (session('success'))
    <div class="alert alert-success mt-3 admin-alert">{{ session('success') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger mt-3 admin-alert">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif

<div class="admin-card">
    <div class="card-body">
        <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $gallery->title) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $gallery->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="form-label">Current Image</label>
                @if($gallery->image)
                    @php
                        // Hapus 'products/' dari path dan menggunakan 'uploads/'
                        $cleanImage = str_replace('products/', '', $gallery->image);
                    @endphp
                    
                    <div class="image-preview-container">
                        <img 
                            src="{{ asset('uploads/' . $cleanImage) }}" 
                            alt="{{ $gallery->title }}" 
                            class="current-image"
                            onerror="this.onerror=null; this.src='https://via.placeholder.com/250x150?text=Path+Error';"
                        >
                    </div>
                    
                @endif
                <input type="file" class="form-control" id="image" name="image">
                <small class="text-muted">Leave empty to keep current image. Max size: 2MB.</small>
            </div>
            
            <button type="submit" class="btn admin-btn-primary">Update Gallery Image</button>
        </form>
    </div>
</div>
@endsection