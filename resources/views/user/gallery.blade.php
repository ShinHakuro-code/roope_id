@extends('layouts.app')

@section('content')

<style>
    :root {
        --primary-color: #ff6b6b; /* Warna aksen konsisten */
    }
    
    .gallery-header {
        position: relative;
        padding-bottom: 10px;
        margin-bottom: 2rem;
        font-weight: 700;
    }
    .gallery-header::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background-color: var(--primary-color);
        margin: 5px auto 0;
        border-radius: 2px;
    }

    .gallery-card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        overflow: hidden;
        /* Hapus cursor: pointer karena tidak ada link di card utama */
    }

    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .gallery-image {
        width: 100%;
        height: 300px; /* Tinggi yang seragam */
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .gallery-card:hover .gallery-image {
        transform: scale(1.05); /* Efek zoom saat hover */
    }
    
    /* CSS Tambahan: Memastikan card-body memiliki tinggi dinamis */
    .card-body {
        /* Tambahkan padding bawah lebih besar untuk visual */
        padding-bottom: 1.5rem !important;
    }
    
</style>

<div class="container py-5">
    
    <h1 class="text-center gallery-header">🖼️ Gallery Roope.id</h1>
    
    <div class="row">
        @foreach($galleries as $gallery)
        {{-- MENGUBAH GRID: col-lg-4 agar hanya 3 card per baris, memberi ruang untuk deskripsi --}}
        <div class="col-sm-6 col-md-6 col-lg-4 mb-4"> 
            <div class="gallery-card h-100">
                
                @php
                    // Logika pembersihan path tetap dipertahankan
                    $cleanImage = trim(str_replace('products/', '', $gallery->image));
                @endphp
                
                <img 
                    src="{{ asset('uploads/' . $cleanImage) }}" 
                    class="gallery-image" 
                    alt="{{ $gallery->title }}" 
                    onerror="this.onerror=null; this.src='https://via.placeholder.com/400x300?text=Error+Path+Galeri'"
                >
                
                <div class="card-body p-3">
                    <h5 class="card-title fw-semibold text-truncate mb-2">{{ $gallery->title }}</h5>
                    
                    {{-- DESKRIPSI LENGKAP --}}
                    @if($gallery->description)
                    <p class="card-text small text-muted">
                        {{-- MENGHAPUS Str::limit() untuk menampilkan deskripsi full --}}
                        {{ $gallery->description }}
                    </p>
                    @endif
                    
                    {{-- MENGHAPUS TOMBOL 'Lihat Detail' --}}
                    
                </div>
            </div>
        </div>
        @endforeach
        
        @if($galleries->count() == 0)
        <div class="col-12 text-center py-5">
            <i class="fas fa-camera-retro fa-3x text-muted mb-3"></i>
            <h3 class="text-muted">Belum ada karya terbaru di Galeri.</h3>
            <p class="text-secondary">Galeri akan segera diupdate.</p>
        </div>
        @endif
    </div>
</div>
@endsection