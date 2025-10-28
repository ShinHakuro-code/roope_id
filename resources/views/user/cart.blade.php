@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Keranjang Belanja</h1>

    {{-- Flash message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($cartItems->count() > 0)
    <div class="row">
        <div class="col-md-8">
            @foreach($cartItems as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-fluid" style="height: 80px; object-fit: cover;">
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-1">{{ $item->product->name }}</h5>
                            <p class="text-primary fw-bold mb-0">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('user.cart.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control">
                                <button type="submit" class="btn btn-sm btn-outline-primary mt-1 w-100">Update</button>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('user.cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
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
                    <p class="mb-3">Total: <strong class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</strong></p>

                    {{-- FORM CHECKOUT: kirim field yang divalidasi controller --}}
                    <form action="{{ route('user.cart.checkout') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Pengiriman (opsional)</label>
                            <textarea name="shipping_address" class="form-control" rows="3">{{ old('shipping_address') }}</textarea>
                        </div>

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
