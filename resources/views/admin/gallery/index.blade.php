@extends('layouts.admin')

@section('title', 'Gallery Management')

@section('content')
<style>
    /* Asumsi: admin-card dan admin-btn-primary sudah ada di layouts.admin */
    .gallery-image {
        width: 100%;
        height: 250px; /* Tinggi yang konsisten */
        object-fit: cover; /* Memastikan gambar mengisi area tanpa terdistorsi */
        border-radius: 0.5rem 0.5rem 0 0; /* Sudut atas membulat */
    }
    .admin-card {
        border: 1px solid #e0e0e0;
        border-radius: 0.5rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        overflow: hidden; /* Penting untuk gambar */
    }
    .card-body .btn-group {
        margin-top: 15px;
        display: flex; /* Memastikan Edit dan Delete berbagi ruang */
    }
    .card-body .btn-group .btn {
        flex-grow: 1;
    }
</style>

<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h2 mb-0">Gallery Management</h1>
        <a href="{{ route('admin.gallery.create') }}" class="btn admin-btn-primary">Add New Image</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success admin-alert mt-3">
        {{ session('success') }}
    </div>
@endif

@if($galleries->count() > 0)
    <div class="row mt-4">
        @foreach($galleries as $gallery)
            @php
                // Membersihkan path dari 'products/' dan menggunakan 'uploads/'
                $cleanImage = str_replace('products/', '', $gallery->image);
            @endphp
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4"> <div class="admin-card h-100">
                    
                    {{-- GAMBAR DIPERBAIKI --}}
                    <img 
                        src="{{ asset('uploads/' . $cleanImage) }}" 
                        class="gallery-image" 
                        alt="{{ $gallery->title }}"
                        onerror="this.onerror=null; this.src='https://via.placeholder.com/400x250?text=No+Image';">
                    
                    <div class="card-body p-3">
                        <h5 class="card-title fw-semibold">{{ $gallery->title }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($gallery->description, 50) }}</p>
                        
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

    <div class="d-flex justify-content-center mt-4">
        {{ $galleries->links() }}
    </div>
@else
    <div class="admin-card mt-4">
        <div class="card-body text-center py-5">
            <h4 class="text-muted">No images found in gallery</h4>
            <p class="text-muted">Start by adding your first image to the gallery.</p>
            <a href="{{ route('admin.gallery.create') }}" class="btn admin-btn-primary">Add First Image</a>
        </div>
    </div>
@endif
@endsection