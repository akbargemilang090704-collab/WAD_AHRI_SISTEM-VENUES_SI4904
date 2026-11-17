<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - VenueSport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/venuesport.css') }}" rel="stylesheet">
</head>
<body>
@php
    $isAdmin = auth()->user()->isAdmin();
    // Menu mengikuti role. Ini hanya TAMPILAN; pembatasan sebenarnya ada di middleware role.
    $menu = $isAdmin
        ? [
            ['admin.dashboard', 'admin.dashboard', 'bi-speedometer2', 'Dashboard'],
            ['alat.index', 'alat.*', 'bi-tools', 'Alat'],
            ['instruktur.index', 'instruktur.*', 'bi-person-badge', 'Instruktur'],
            ['lapangan.index', 'lapangan.*', 'bi-geo-alt', 'Lapangan'],
            ['pelanggan.index', 'pelanggan.*', 'bi-people', 'Pelanggan'],
            ['users.index', 'users.*', 'bi-person-gear', 'Pengguna'],
        ]
        : [
            ['user.dashboard', 'user.dashboard', 'bi-speedometer2', 'Dashboard'],
            ['user.lapangan', 'user.lapangan', 'bi-geo-alt', 'Info Lapangan'],
            ['user.instruktur', 'user.instruktur', 'bi-person-badge', 'Info Instruktur'],
            ['user.alat', 'user.alat', 'bi-tools', 'Info Alat'],
        ];
@endphp

<aside class="vs-sidebar" id="sidebar">
    <div class="vs-brand"><i class="bi bi-trophy-fill"></i> VenueSport</div>
    <nav class="nav flex-column mt-3">
        @foreach ($menu as [$route, $pattern, $icon, $label])
            <a class="nav-link {{ request()->routeIs($pattern) ? 'active' : '' }}" href="{{ route($route) }}">
                <i class="bi {{ $icon }}"></i> {{ $label }}
            </a>
        @endforeach
        <form action="{{ route('logout') }}" method="POST" class="mt-3 px-3">
            @csrf
            <button class="btn btn-outline-light w-100" type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
        </form>
    </nav>
</aside>

<div class="vs-main">
    <div class="vs-topbar d-flex align-items-center justify-content-between">
        <button class="btn btn-outline-primary d-lg-none" type="button" onclick="document.getElementById('sidebar').classList.toggle('show')">
            <i class="bi bi-list"></i>
        </button>
        <h5 class="mb-0 text-primary fw-semibold">@yield('title', 'Dashboard')</h5>
        <span class="text-muted small"><i class="bi bi-person-circle text-primary"></i> {{ auth()->user()->nama }}
            <span class="badge bg-{{ $isAdmin ? 'primary' : 'secondary' }} ms-1">{{ strtoupper(auth()->user()->role) }}</span></span>
    </div>

    <div class="vs-content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show"><i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
