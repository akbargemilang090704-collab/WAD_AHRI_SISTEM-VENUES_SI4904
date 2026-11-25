<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — Sistem Venue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 55%, #1e3a8a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .auth-card {
            width: 100%;
            max-width: 430px;
            border: 0;
            border-radius: 16px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.25);
            overflow: hidden;
        }
        .auth-header {
            background-color: #1d4ed8;
            color: #ffffff;
            padding: 24px 28px;
        }
        .btn-venue {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
            font-weight: 500;
        }
        .btn-venue:hover, .btn-venue:focus {
            background-color: #1e40af;
            border-color: #1e40af;
        }
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.15);
        }
    </style>
</head>
<body>
    <div class="card auth-card">
        <div class="auth-header">
            <div class="d-flex align-items-center gap-2 mb-1">
                <i class="bi bi-trophy-fill fs-5"></i>
                <span class="fw-semibold fs-6">Sistem Venue</span>
            </div>
            <h1 class="h5 mb-1 fw-semibold">Masuk ke Akun Anda</h1>
            <p class="mb-0 small text-white-50">Silakan masuk untuk mengelola data dan layanan venue.</p>
        </div>

        <div class="card-body p-4 bg-white">
            @if (session('status'))
                <div class="alert alert-info py-2 px-3 small mb-3" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label small fw-medium text-secondary">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="nama@email.com"
                        class="form-control @error('email') is-invalid @enderror"
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label small fw-medium text-secondary">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan password"
                        class="form-control @error('password') is-invalid @enderror"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="form-check-input"
                        >
                        <label for="remember_me" class="form-check-label small text-secondary">
                            Ingat saya
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small text-decoration-none text-primary">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-venue w-100 py-2">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                </button>

                @if (Route::has('register'))
                    <div class="text-center mt-4 pt-3 border-top small text-secondary">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="fw-medium text-decoration-none text-primary">
                            Daftar sekarang
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>