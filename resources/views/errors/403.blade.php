<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 Akses Ditolak - VenueSport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/venuesport.css') }}" rel="stylesheet">
</head>
<body>
<div class="login-wrap">
    <div class="card login-card">
        <div class="card-body p-4 p-md-5 text-center">
            <div class="display-1 fw-bold text-danger">403</div>
            <h4 class="fw-bold text-primary mb-2"><i class="bi bi-shield-lock-fill"></i> Akses Ditolak</h4>
            <p class="text-muted">{{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses untuk membuka halaman ini.' }}</p>
            @auth
                <p class="small text-muted">Login sebagai <strong>{{ auth()->user()->nama }}</strong> ({{ auth()->user()->role }})</p>
                <a href="{{ route('dashboard') }}" class="btn btn-primary w-100"><i class="bi bi-house"></i> Kembali ke Dashboard Saya</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary w-100"><i class="bi bi-box-arrow-in-right"></i> Ke Halaman Login</a>
            @endauth
        </div>
    </div>
</div>
</body>
</html>
