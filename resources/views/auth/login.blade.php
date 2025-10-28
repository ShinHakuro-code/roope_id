<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Roope.id</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* 1. Background Modern */
        body {
            /* Gradien biru-ungu lembut */
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* 2. Styling Card Login */
        .card {
            border: none;
            border-radius: 1rem; 
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15); 
            overflow: hidden;
        }
        
        /* 3. Ukuran Kotak Login Lebih Ringkas */
        .login-box {
            max-width: 400px;
            width: 90%;
        }

        /* 4. Styling Input Focus */
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }

        /* ------------------------------------- */
        /* CSS KUSTOM untuk EFEK SHAKE (Form Error) */
        /* ------------------------------------- */

        @keyframes shake {
            0% { transform: translateX(0); }
            15% { transform: translateX(-8px); }
            30% { transform: translateX(8px); }
            45% { transform: translateX(-8px); }
            60% { transform: translateX(8px); }
            75% { transform: translateX(-8px); }
            90% { transform: translateX(8px); }
            100% { transform: translateX(0); }
        }

        .shake-animation {
            animation: shake 0.6s cubic-bezier(.36,.07,.19,.97) both;
            transform: translate3d(0, 0, 0); 
        }

        /* ------------------------------------- */
        /* CSS KUSTOM untuk FLOATING Teks (Logo) */
        /* ------------------------------------- */

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }

        .floating-text {
            /* Animasi lembut yang berjalan lambat */
            animation: floating 3s ease-in-out infinite; 
            display: inline-block; /* Penting agar animasi Y bekerja */
        }
        
        /* ------------------------------------- */
        /* CSS KUSTOM untuk PULSE Tombol (Login) */
        /* ------------------------------------- */

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.5); }
            70% { box-shadow: 0 0 0 10px rgba(0, 123, 255, 0); }
            100% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0); }
        }

        .btn-primary.pulse-animation {
            background-color: #007bff;
            border-color: #007bff;
            /* Terapkan animasi pulse */
            animation: pulse 2s infinite; 
        }

        .btn-primary.pulse-animation:hover {
            animation: none; /* Hentikan pulse saat di-hover */
            transform: translateY(-1px);
        }

    </style>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-box">
        <div class="card shadow">
            
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h2 class="mb-1 fw-bold text-dark floating-text">
                        <i class="fas fa-box-open text-primary me-2"></i> Roope.id 
                    </h2>
                    <p class="text-secondary small">Masuk untuk mengelola pesanan Bucket Murah Palembang</p>
                </div>

                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->all() as $error)
                    <p class="mb-0 small">{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-semibold">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Contoh: user@domain.com">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label small fw-semibold">Kata Sandi</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan kata sandi Anda">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold pulse-animation">Masuk</button>
                    
                </form>

                <div class="text-center mt-5 pt-3 border-top">
                    <p class="text-muted mb-2 small fw-semibold">Akun Demo (Hanya untuk Uji Coba):</p>
                    <div class="row g-2 small">
                        <div class="col-sm-6">
                            <span class="badge bg-success text-white">Admin</span><br>
                            <code class="text-dark">admin@roope.id</code> / <code class="text-dark">admin123</code>
                        </div>
                        <div class="col-sm-6">
                            <span class="badge bg-secondary">User</span><br>
                            <code class="text-dark">user@example.com</code> / <code class="text-dark">user123</code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const loginCard = document.querySelector('.card');

            loginForm.addEventListener('submit', function(event) {
                // checkValidity() memeriksa required fields
                if (!loginForm.checkValidity()) {
                    // 1. Hentikan submit form
                    event.preventDefault();
                    event.stopPropagation();

                    // 2. Restart dan jalankan animasi shake
                    loginCard.classList.remove('shake-animation');
                    setTimeout(() => {
                        loginCard.classList.add('shake-animation');
                    }, 0);

                    // 3. Hapus kelas shake setelah animasi selesai
                    setTimeout(() => {
                        loginCard.classList.remove('shake-animation');
                    }, 700); 
                }
                
                // Menambahkan kelas Bootstrap 'was-validated' untuk feedback form
                loginForm.classList.add('was-validated');
            }, false);
        });
    </script>
</body>
</html>