<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun — Sistem Venue</title>
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
            max-width: 450px;
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
            <h1 class="h5 mb-1 fw-semibold">Buat Akun Baru</h1>
            <p class="mb-0 small text-white-50">Lengkapi data di bawah ini untuk mendaftar.</p>
        </div>

        <div class="card-body p-4 bg-white">
            <form method="POST" action="{{ route('register') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label small fw-medium text-secondary">Nama Lengkap</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Masukkan nama lengkap"
                        class="form-control @error('name') is-invalid @enderror"
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label small fw-medium text-secondary">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
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
                        autocomplete="new-password"
                        placeholder="Minimal 8 karakter"
                        class="form-control @error('password') is-invalid @enderror"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label small fw-medium text-secondary">Konfirmasi Password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Ulangi password"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                    >
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-venue w-100 py-2">
                    <i class="bi bi-person-plus me-1"></i> Daftar
                </button>

                <div class="text-center mt-4 pt-3 border-top small text-secondary">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="fw-medium text-decoration-none text-primary">
                        Masuk di sini
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>