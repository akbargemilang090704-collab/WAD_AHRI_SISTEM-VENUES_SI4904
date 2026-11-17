<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - VenueSport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/venuesport.css') }}" rel="stylesheet">
</head>
<body>
<div class="login-wrap">
    <div class="card login-card">
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary"><i class="bi bi-trophy-fill"></i> VenueSport</h2>
                <p class="text-muted mb-0">Silakan login untuk melanjutkan</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success py-2">{{ session('success') }}</div>
            @endif
            @if (!empty($throttleMessage))
                <div class="alert alert-warning py-2" id="throttle-alert"><i class="bi bi-hourglass-split"></i> {{ $throttleMessage }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger py-2">{{ session('error') }}</div>
            @endif

            <form action="{{ route('login.proses') }}" method="POST" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="username" value="{{ $username ?? old('username') }}"
                               class="form-control @error('username') is-invalid @enderror" autofocus>
                        @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <button id="btn-login" class="btn btn-primary w-100 py-2" type="submit" @if (!empty($retryAfter)) disabled @endif><i class="bi bi-box-arrow-in-right"></i> Login</button>
            </form>
        </div>
    </div>
</div>
@if (!empty($retryAfter))
<script>
    // Tombol login dikunci selama masa tunggu throttle, lalu aktif lagi otomatis.
    (function () {
        var sisa = {{ (int) $retryAfter }};
        var btn = document.getElementById('btn-login');
        var info = document.getElementById('throttle-alert');
        var teks = btn.innerHTML;
        var t = setInterval(function () {
            sisa--;
            if (sisa <= 0) { clearInterval(t); btn.disabled = false; btn.innerHTML = teks; if (info) info.remove(); return; }
            btn.textContent = 'Coba lagi dalam ' + sisa + ' detik';
        }, 1000);
        btn.textContent = 'Coba lagi dalam ' + sisa + ' detik';
    })();
</script>
@endif
</body>
</html>
