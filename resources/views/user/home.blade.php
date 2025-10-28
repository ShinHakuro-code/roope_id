@extends('layouts.app')

@section('content')

<style>
    /* 1. Hero Section yang Dramatis */
    .hero-section {
        /* Ganti dengan URL gambar berkualitas tinggi tentang bucket/hadiah */
        background: url('https://picsum.photos/1600/600') center center; 
        background-size: cover;
        /* Overlay gelap untuk membuat teks lebih menonjol */
        background-color: rgba(0, 0, 0, 0.5); 
        background-blend-mode: overlay; /* Gabungkan warna overlay dengan gambar */
        padding: 8rem 0; /* Jarak atas/bawah yang lebih besar */
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        margin-bottom: 2rem;
    }

    .hero-section .display-4 {
        font-size: 3.5rem; /* Judul utama */
        margin-bottom: 1rem;
    }
    
    .hero-section .btn-primary {
        /* Tombol lebih besar, dengan transisi halus */
        transition: all 0.3s ease;
        background-color: #ff6b6b; /* Warna yang lebih 'pop' (merah cerah) */
        border-color: #ff6b6b;
        font-weight: bold;
    }

    .hero-section .btn-primary:hover {
        background-color: #e63946;
        border-color: #e63946;
        transform: translateY(-2px); /* Efek angkat */
    }

    /* 2. Card Produk yang Rapi dan Profesional */
    .product-card {
        border: 1px solid #e0e0e0;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        overflow: hidden; /* Pastikan gambar tidak keluar dari radius */
    }

    .product-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Bayangan lebih kuat saat hover */
        transform: translateY(-5px); /* Efek angkat saat hover */
    }

    .product-card .card-img-top {
        border-bottom: 1px solid #f0f0f0;
        max-height: 280px; /* Sedikit lebih tinggi */
    }

    .text-price {
        color: #ff6b6b !important; /* Warna harga sesuai aksen tombol */
        font-size: 1.25rem;
    }

    /* 3. Kategori yang Berani */
    .category-card {
        transition: transform 0.3s ease;
        border: none;
        background-color: #ffffff;
        border-radius: 0.5rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    
    .category-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border: 1px solid #ff6b6b;
    }

    .category-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        color: #ff6b6b;
    }

</style>

<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">
            Roope.id
        </h1>
        <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">
            Bucket Murah Palembang - Hadiah Spesial untuk Momen Spesial
        </p>
        <a href="{{ route('user.products.index') }}" class="btn btn-primary btn-lg animate__animated animate__zoomIn animate__delay-2s">
            <i class="fas fa-shopping-basket me-2"></i> Lihat Semua Produk
        </a>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold text-dark">✨ Produk Unggulan Kami</h2>
        <div class="row">
            @foreach($featuredProducts as $product)
            <div class="col-md-4 mb-4">
                <div class="card product-card h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 280px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-semibold text-truncate">{{ $product->name }}</h5>
                        <p class="card-text small text-muted mb-3">{{ Str::limit($product->description, 80) }}</p>
                        
                        <p class="fw-bold text-price mt-auto">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        
                        <a href="{{ route('user.products.show', $product) }}" class="btn btn-outline-danger mt-2">
                            Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('user.products.index') }}" class="btn btn-link text-dark fw-bold">
                Jelajahi Semua Bucket <i class="fas fa-long-arrow-alt-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold text-dark">Kategori Pilihan</h2>
        <div class="row justify-content-center">
            @foreach($categories as $category)
            <div class="col-6 col-md-3 mb-4">
                <a href="{{ route('user.products.index', ['category' => $category->id]) }}" class="text-decoration-none text-dark">
                    <div class="card text-center category-card p-3 h-100">
                        <div class="card-body p-2">
                            <i class="fas fa-tags category-icon"></i> 
                            <h6 class="card-title fw-semibold mt-2">{{ $category->name }}</h6>
                            <p class="card-text small text-muted">{{ $category->products->count() }} produk</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection