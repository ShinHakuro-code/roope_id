@extends('layouts.admin')

@section('title', 'About Management')

@section('content')
<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h2 mb-0">About Page Management</h1>
        <small class="text-muted">Last updated: {{ \Carbon\Carbon::parse($aboutData['updated_at'])->format('M d, Y H:i') }}</small>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success admin-alert">
        {{ session('success') }}
    </div>
@endif

<div class="admin-card">
    <div class="card-header">
        <h5 class="mb-0">Edit About Page Content</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.about.update') }}" method="POST" class="admin-form">
            @csrf
            <!-- Form content about yang sudah ada -->
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Page Title</label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="{{ old('title', $aboutData['title']) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ old('email', $aboutData['email']) }}">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">About Content</label>
                <textarea class="form-control" id="content" name="content" rows="6" 
                          placeholder="Tell your company story...">{{ old('content', $aboutData['content']) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="mission" class="form-label">Mission</label>
                        <textarea class="form-control" id="mission" name="mission" rows="4"
                                  placeholder="Our mission...">{{ old('mission', $aboutData['mission']) }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="vision" class="form-label">Vision</label>
                        <textarea class="form-control" id="vision" name="vision" rows="4"
                                  placeholder="Our vision...">{{ old('vision', $aboutData['vision']) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3"
                                  placeholder="Company address...">{{ old('address', $aboutData['address']) }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" 
                               value="{{ old('phone', $aboutData['phone']) }}">
                        
                        <label for="website" class="form-label mt-2">Website</label>
                        <input type="url" class="form-control" id="website" name="website" 
                               value="{{ old('website', $aboutData['website']) }}">
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn admin-btn-primary">Update About Page</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </form>
    </div>
</div>
@endsection