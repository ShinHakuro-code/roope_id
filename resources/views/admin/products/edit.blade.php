@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h2 mb-0">Edit Product</h1>
        <a href="{{ route('admin.products') }}" class="btn btn-secondary">Back to Products</a>
    </div>
</div>

<div class="admin-card">
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-control" id="category_id" name="category_id">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 100px; border-radius: 6px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="image" name="image">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn admin-btn-primary">Update Product</button>
        </form>
    </div>
</div>
@endsection