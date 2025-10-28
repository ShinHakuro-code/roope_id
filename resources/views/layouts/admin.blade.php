<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Roope.id</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="admin-sidebar">
                <div class="sidebar-brand">
                    <h4 class="text-white">
                        <i class="fas fa-gift"></i> Roope.id
                    </h4>
                    <small class="text-muted">Admin Panel</small>
                </div>
                <nav class="nav flex-column">
                    <a class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                    <a class="admin-nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}" 
                       href="{{ route('admin.products') }}">
                        <i class="fas fa-box me-2"></i> Products
                    </a>
                    <a class="admin-nav-link {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}" 
                       href="{{ route('admin.gallery') }}">
                        <i class="fas fa-images me-2"></i> Gallery
                    </a>
                    <a class="admin-nav-link {{ request()->routeIs('admin.about*') ? 'active' : '' }}" 
                       href="{{ route('admin.about') }}">
                        <i class="fas fa-info-circle me-2"></i> About
                    </a>
                    <a class="admin-nav-link" href="{{ route('user.home') }}" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i> View Site
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-100">
                        @csrf
                        <button type="submit" class="admin-nav-link text-warning w-100 text-start border-0 bg-transparent">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="admin-main">
                <div class="admin-header">
                    <h3 class="mb-0">@yield('title', 'Admin Dashboard')</h3>
                </div>
                
                <main class="mt-4">
                    @if(session('success'))
                    <div class="alert alert-success admin-alert alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger admin-alert alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>