@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Keranjang Belanja</h1>
    
    @if($cartItems->count() > 0)
    <div class="row">
        <div class="col-md-8">
            @foreach($cartItems as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-fluid" style="height: 80px; object-fit: cover;">
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $item->product->name }}</h5>
                            <p class="text-primary fw-bold">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('user.cart.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control">
                                <button type="submit" class="btn btn-sm btn-outline-primary mt-1">Update</button>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('user.cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Ringkasan Belanja</h5>
                    <hr>
                    <p>Total: <strong class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</strong></p>
                    <form action="{{ route('user.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <h3>Keranjang belanja kosong</h3>
        <p>Silakan tambahkan produk ke keranjang belanja Anda.</p>
        <a href="{{ route('user.products.index') }}" class="btn btn-primary">Lihat Produk</a>
    </div>
    @endif
</div>
@endsection