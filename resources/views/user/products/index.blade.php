@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Katalog Produk</h1>
    
    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('user.products.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <form action="{{ route('user.products.index') }}" method="GET">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="all">Semua Kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card product-card h-100">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                    <p class="fw-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('user.products.show', $product) }}" class="btn btn-outline-primary">Detail</a>
                        @auth
                            @if(!Auth::user()->isAdmin())
                            <form action="{{ route('user.cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Login to Buy</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection