@extends('layouts.app')

@section('content')

<style>
    /* Warna Aksen */
    :root {
        --primary-color: #ff6b6b; /* Merah muda/salmon untuk aksen */
        --primary-hover: #e63946;
    }

    /* Penataan Ulang Heading */
    .catalog-header {
        position: relative;
        padding: 1rem 0;
        margin-bottom: 3rem;
        font-weight: 700;
        color: #333;
    }

    .catalog-header::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background-color: var(--primary-color);
        margin: 10px auto 0;
        border-radius: 2px;
    }

    /* Peningkatan Filter dan Search */
    .filter-section {
        background-color: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(255, 107, 107, 0.25);
    }

    /* Card Produk yang Rapi dan Interaktif (Sama dengan Beranda) */
    .product-card {
        border: none; /* Hapus border */
        border-radius: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Bayangan halus */
        overflow: hidden;
    }

    .product-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2); 
        transform: translateY(-5px); 
    }

    .product-card .card-img-top {
        height: 280px; /* Sedikit lebih tinggi */
        object-fit: cover;
        border-bottom: 1px solid #f0f0f0;
    }

    /* Warna Harga */
    .text-price {
        color: var(--primary-color) !important; 
        font-size: 1.3rem;
        font-weight: 700;
    }
    
    /* Styling Tombol CTA */
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
    }
    
    .btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: white;
    }
</style>

<div class="container py-5">
    
    <h1 class="text-center catalog-header">Katalog Produk Roope.id</h1>
    
    <div class="filter-section mb-5">
        <div class="row align-items-center">
            
            <div class="col-md-6 mb-3 mb-md-0">
                <form action="{{ route('user.products.index') }}" method="GET" class="d-flex align-items-center">
                    <label for="category-select" class="me-2 fw-semibold text-muted">Filter Kategori:</label>
                    <select name="category" id="category-select" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                </form>
            </div>

            <div class="col-md-6">
                <form action="{{ route('user.products.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari produk berdasarkan nama..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div> <div class="row">
        @if($products->isEmpty())
            <div class="col-12 text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <p class="lead text-muted">Maaf, produk tidak ditemukan untuk kriteria tersebut.</p>
                <a href="{{ route('user.products.index') }}" class="btn btn-outline-secondary mt-3">Tampilkan Semua Produk</a>
            </div>
        @endif

        @foreach($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4"> <div class="card product-card h-100">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-secondary mb-2 align-self-start">{{ $product->category->name ?? 'Lain-lain' }}</span>
                    
                    <h5 class="card-title fw-semibold text-truncate">{{ $product->name }}</h5>
                    <p class="card-text small text-muted mb-2">{{ Str::limit($product->description, 50) }}</p>
                    
                    <p class="fw-bold text-price mt-auto mb-3">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                        <a href="{{ route('user.products.show', $product) }}" class="btn btn-outline-primary btn-sm flex-grow-1 me-md-2">
                            <i class="fas fa-info-circle me-1"></i> Detail
                        </a>
                        
                        @auth
                            @if(!Auth::user()->isAdmin())
                            <form action="{{ route('user.cart.add') }}" method="POST" class="flex-grow-1">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-cart-plus me-1"></i> Beli
                                </button>
                            </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-sm flex-grow-1">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>
</div>
@endsection