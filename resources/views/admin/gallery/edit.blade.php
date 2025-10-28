<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gallery Image - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products') }}">
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.gallery') }}">
                                Gallery
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.about') }}">
                                About
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Edit Gallery Image</h1>
                    <a href="{{ route('admin.gallery') }}" class="btn btn-secondary">Back to Gallery</a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $gallery->title }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                @if($gallery->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" style="max-width: 200px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control" id="image" name="image">
                                <small class="text-muted">Leave empty to keep current image</small>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ $gallery->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Gallery Image</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>