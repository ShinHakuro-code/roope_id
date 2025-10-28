@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p class="text-muted">Kategori: {{ $product->category->name }}</p>
            <h3 class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
            
            <div class="mb-4">
                <h5>Deskripsi Produk:</h5>
                <p>{{ $product->description }}</p>
            </div>

            <div class="mb-4">
                <p><strong>Stok:</strong> {{ $product->stock }} item</p>
            </div>

            @auth
                @if(!Auth::user()->isAdmin())
                <form action="{{ route('user.cart.add') }}" method="POST" class="mb-3">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="quantity" class="form-label">Jumlah:</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control">
                        </div>
                        <div class="col-md-8 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </form>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-shopping-cart"></i> Login untuk Membeli
                </a>
            @endauth
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="row mt-5">
        <div class="col-12">
            <h3>Produk Terkait</h3>
            <div class="row">
                @foreach($relatedProducts as $relatedProduct)
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100">
                        <img src="{{ asset('storage/' . $relatedProduct->image) }}" class="card-img-top" alt="{{ $relatedProduct->name }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                            <p class="text-primary fw-bold">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</p>
                            <a href="{{ route('user.products.show', $relatedProduct) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection