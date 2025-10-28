@extends('layouts.app')

@section('content')

<style>
    :root {
        --primary-color: #ff6b6b; /* Warna aksen konsisten */
        --secondary-bg: #fff0f0; /* Latar belakang lembut untuk section */
    }
    
    .about-header {
        position: relative;
        padding-bottom: 10px;
        margin-bottom: 3rem;
        font-weight: 700;
    }
    .about-header::after {
        content: '';
        display: block;
        width: 100px;
        height: 4px;
        background-color: var(--primary-color);
        margin: 10px auto 0;
        border-radius: 2px;
    }
    
    .about-section {
        padding: 4rem 0;
    }

    /* Styling Kotak Info/Keunggulan */
    .info-box {
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        transition: transform 0.3s ease;
        height: 100%;
    }
    .info-box:hover {
        transform: translateY(-5px);
    }
    
    .info-box h4 {
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    /* Styling List Keunggulan */
    .advantage-list li {
        margin-bottom: 0.5rem;
        list-style: none; /* Hilangkan bullet default */
        position: relative;
        padding-left: 25px;
        font-size: 1.05rem;
    }
    
    .advantage-list li::before {
        content: "⭐"; /* Ikon bintang di depan */
        position: absolute;
        left: 0;
        color: var(--primary-color);
        font-size: 0.9em;
    }

    /* Styling CTA Banner */
    .cta-banner {
        background: var(--secondary-bg);
        border-left: 5px solid var(--primary-color);
        border-radius: 0.5rem;
        padding: 1.5rem;
        font-size: 1.1rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
</style>

<section class="about-section pt-5 pb-3">
    <div class="container">
        <h1 class="text-center about-header">Tentang Roope.id</h1>
        <div class="col-lg-8 mx-auto text-center">
            
            <h2 class="fw-bold mb-3 text-dark">{{ $aboutData['name'] ?? 'Roope.id' }}</h2>
            
            <p class="lead text-secondary mx-auto" style="max-width: 700px;">
                {{ $aboutData['description'] ?? 'Kami adalah penyedia bucket murah berkualitas di Palembang, berdedikasi untuk menciptakan hadiah spesial untuk setiap momen penting Anda.' }}
            </p>
            <hr class="my-4">
        </div>
    </div>
</section>

<section class="about-section py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Hubungi Kami</h2>
        <div class="row justify-content-center">
            
            <div class="col-md-4 mb-4">
                <div class="info-box text-center">
                    <h4><i class="fas fa-map-marker-alt me-2"></i> Lokasi Kami</h4>
                    <p class="mb-0 text-muted">{{ $aboutData['location'] ?? 'Palembang, Sumatera Selatan' }}</p>
                    {{-- Tambahkan link jika ada --}}
                    {{-- <a href="#" class="btn btn-sm btn-link mt-2">Lihat di Peta</a> --}}
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="info-box text-center">
                    <h4><i class="fab fa-instagram me-2"></i> Kunjungi Kami</h4>
                    <p class="mb-2 text-dark fw-semibold">@ {{ $aboutData['instagram'] ?? 'roope.id' }}</p>
                    <a href="https://instagram.com/{{ $aboutData['instagram'] ?? 'roope.id' }}" target="_blank" class="btn btn-primary">
                        <i class="fab fa-instagram me-1"></i> Follow Sekarang
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</section>

<section class="about-section py-5">
    <div class="container">
        <div class="row">
            
            <div class="col-md-6 mb-5">
                <h3 class="fw-bold mb-4 text-dark">Mengapa Memilih Roope.id?</h3>
                <ul class="advantage-list">
                    @foreach($aboutData['advantages'] as $advantage)
                    <li>{{ $advantage }}</li>
                    @endforeach
                </ul>
            </div>
            
            <div class="col-md-6 mb-5">
                <h3 class="fw-bold mb-4 text-dark">🛍️ Jenis Produk Kami</h3>
                <div class="row">
                    @foreach($aboutData['products'] as $product)
                    <div class="col-6 mb-3">
                        <span class="badge bg-secondary p-2">{{ $product }}</span>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('user.products.index') }}" class="btn btn-outline-danger">Lihat Semua Produk</a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-10 mx-auto mt-4">
            <div class="cta-banner">
                <h5 class="fw-bold text-dark mb-2">💡 Pesanan Kustom (Custom Order)</h5>
                <p class="mb-0">
                    Roope.id menerima pesanan custom sesuai dengan kebutuhan dan tema acara Anda.
                    Hubungi kami melalui Instagram untuk konsultasi dan pemesanan desain bucket spesial.
                </p>
            </div>
        </div>
    </div>
</section>

@endsection