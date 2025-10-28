@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Roope.id</h1>
        <p class="lead">Bucket Murah Palembang - Hadiah Spesial untuk Momen Spesial</p>
        <a href="{{ route('user.products.index') }}" class="btn btn-primary btn-lg">Lihat Produk</a>
    </div>
</section>

<!-- Featured Products -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Produk Unggulan</h2>
        <div class="row">
            @foreach($featuredProducts as $product)
            <div class="col-md-4 mb-4">
                <div class="card product-card h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                        <p class="fw-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('user.products.show', $product) }}" class="btn btn-outline-primary">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Categories -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Kategori Produk</h2>
        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">{{ $category->products->count() }} produk</p>
                        <a href="{{ route('user.products.index', ['category' => $category->id]) }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection