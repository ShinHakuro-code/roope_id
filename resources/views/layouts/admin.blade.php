<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Roope.id</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    
    <style>
        :root {
            --roope-primary: #ff6b6b;
            --roope-dark: #343a40;
            --sidebar-width: 250px;
        }

        /* Styling Logo di Sidebar */
        .sidebar-logo {
            height: 60px; 
            width: 60px;
            object-fit: cover;
            border-radius: 50%; /* Bulat */
            margin-right: 10px;
            border: 2px solid white; /* Border putih untuk menonjol */
        }
        
        .admin-sidebar {
            width: var(--sidebar-width);
            background-color: var(--roope-dark); /* Warna gelap untuk Admin */
            color: white;
            position: fixed;
            height: 100%;
            overflow-y: auto;
            z-index: 1000;
            padding-top: 15px;
        }

        .sidebar-brand {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 15px;
        }
        
        .sidebar-brand h4 {
            font-weight: bold;
        }
        
        /* Styling Link Navigasi */
        .admin-nav-link {
            color: #adb5bd;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }
        
        .admin-nav-link:hover {
            color: white;
            background-color: #495057;
        }
        
        .admin-nav-link.active {
            color: white;
            background-color: var(--roope-primary);
        }

        /* Main Content Area */
        .admin-main {
            margin-left: var(--sidebar-width);
            padding: 20px;
        }

        /* Footer */
        .admin-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            padding: 15px 0;
            margin-top: 40px;
            text-align: center;
            font-size: 0.9rem;
            width: 100%;
        }

    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="admin-sidebar">
                <div class="sidebar-brand">
                    {{-- LOGO BULAT --}}
                    <h4 class="text-white mb-1">
                        <img src="{{ asset('images/logo.png') }}" alt="Roope.id Logo" class="sidebar-logo">
                        Roope.id
                    </h4>
                    <small class="text-muted d-block">Admin Panel</small>
                </div>
                <nav class="nav flex-column">
                    {{-- Menu Navigasi --}}
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
                    <hr class="text-white-50 my-2">
                    <form method="POST" action="{{ route('logout') }}" class="w-100">
                        @csrf
                        <button type="submit" class="admin-nav-link text-warning w-100 text-start border-0 bg-transparent">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </nav>
            </div>

            <div class="admin-main">
                <div class="admin-header pb-2 mb-3 border-bottom">
                    <h3 class="mb-0">@yield('title', 'Admin Dashboard')</h3>
                </div>
                
                <main class="mt-4">
                    {{-- Alert Messages --}}
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
                
                {{-- FOOTER ADMIN BARU --}}
                <footer class="admin-footer">
                    &copy; {{ date('Y') }} Roope.id Admin Panel. Dikelola oleh Anda.
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>