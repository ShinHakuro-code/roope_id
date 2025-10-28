<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Roope.id</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h2><i class="fas fa-gift text-primary"></i> Roope.id</h2>
                            <p class="text-muted">Bucket Murah Palembang</p>
                        </div>

                        @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
                        </form>

                        <div class="text-center mt-4">
                            <p class="text-muted">Demo Accounts:</p>
                            <div class="row">
                                <div class="col-6">
                                    <small><strong>Admin:</strong><br>admin@roope.id / admin123</small>
                                </div>
                                <div class="col-6">
                                    <small><strong>User:</strong><br>user@example.com / user123</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>