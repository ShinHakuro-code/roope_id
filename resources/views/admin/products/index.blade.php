@extends('layouts.admin')

@section('title', 'Product Management')

@section('content')
<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h2 mb-0">Product Management</h1>
        <a href="{{ route('admin.products.create') }}" class="btn admin-btn-primary">Add New Product</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success admin-alert">
        {{ session('success') }}
    </div>
@endif

<div class="admin-card">
    <div class="card-body">
        @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ $product->category->name ?? 'No Category' }}</td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <h4 class="text-muted">No products found</h4>
                <p class="text-muted">Start by adding your first product.</p>
                <a href="{{ route('admin.products.create') }}" class="btn admin-btn-primary">Add First Product</a>
            </div>
        @endif
    </div>
</div>
@endsection