<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roope.id - Bucket Murah Palembang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://via.placeholder.com/1500x500');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        .product-card {
            transition: transform 0.3s;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('user.home') }}">
                <i class="fas fa-gift"></i> Roope.id
            </a>
            
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('user.home') }}">Home</a>
                <a class="nav-link" href="{{ route('user.products.index') }}">Produk</a>
                <a class="nav-link" href="{{ route('user.gallery') }}">Gallery</a>
                <a class="nav-link" href="{{ route('user.about') }}">Tentang</a>
                
                @auth
                    @if(Auth::user()->isAdmin())
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a>
                    @else
                        <a class="nav-link position-relative" href="{{ route('user.cart') }}">
                            <i class="fas fa-shopping-cart"></i>
                            @php
                                $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count();
                            @endphp
                            @if($cartCount > 0)
                                <span class="cart-badge badge bg-danger">{{ $cartCount }}</span>
                            @endif
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">Logout</button>
                    </form>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4">
                    <h5>Roope.id</h5>
                    <p>Bucket Murah Palembang - Menyediakan berbagai bucket bunga, snack, dan custom untuk acara spesial Anda.</p>
                </div>
                <div class="col-md-4">
                    <h5>Kontak</h5>
                    <p><i class="fab fa-instagram"></i> @roope.id</p>
                    <p><i class="fas fa-map-marker-alt"></i> Plaju, Palembang</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <a href="{{ route('user.home') }}" class="text-white d-block">Home</a>
                    <a href="{{ route('user.products.index') }}" class="text-white d-block">Produk</a>
                    <a href="{{ route('user.about') }}" class="text-white d-block">Tentang Kami</a>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>&copy; 2024 Roope.id - All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>