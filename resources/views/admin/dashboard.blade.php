@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="admin-header">
    <h3 class="mb-0">Dashboard Overview</h3>
</div>

@if(session('success'))
    <div class="alert alert-success admin-alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
    </div>
@endif

<!-- Stats Cards - Compact Grid -->
<div class="row compact-grid">
    <div class="col-md-3">
        <div class="admin-stats-card">
            <h5>Total Products</h5>
            <h2>{{ $stats['total_products'] ?? 0 }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-stats-card" style="background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);">
            <h5>Total Users</h5>
            <h2>{{ $stats['total_users'] ?? 0 }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-stats-card" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);">
            <h5>Total Orders</h5>
            <h2>{{ $stats['total_orders'] ?? 0 }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-stats-card" style="background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);">
            <h5>Gallery Images</h5>
            <h2>{{ $stats['total_galleries'] ?? 0 }}</h2>
        </div>
    </div>
</div>

<!-- Recent Products - Compact -->
<div class="admin-card">
    <div class="card-header">
        <h5 class="mb-0">Recent Products</h5>
    </div>
    <div class="card-body">
        @if(isset($stats['recent_products']) && $stats['recent_products']->count() > 0)
            <div class="table-responsive">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['recent_products'] as $product)
                            <tr>
                                <td class="fw-bold">{{ $product->name }}</td>
                                <td class="text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="text-muted">{{ $product->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted text-center py-3 mb-0">No products found.</p>
        @endif
    </div>
</div>
@endsection