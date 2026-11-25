<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem Venue') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Figtree', sans-serif;
                background-color: #f4f7fb;
                color: #1e293b;
            }
            .venue-sidebar {
                width: 250px;
                min-width: 250px;
                min-height: 100vh;
                background: linear-gradient(180deg, #0d5bd7 0%, #083c96 100%);
                color: #ffffff;
            }
            .venue-brand {
                font-size: 1.25rem;
                font-weight: 700;
                color: #ffffff;
                text-decoration: none;
            }
            .venue-nav-link {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px 14px;
                border-radius: 8px;
                color: rgba(255, 255, 255, 0.88);
                text-decoration: none;
                font-weight: 500;
                margin-bottom: 4px;
                transition: background-color 0.15s ease, color 0.15s ease;
            }
            .venue-nav-link:hover {
                background-color: rgba(255, 255, 255, 0.14);
                color: #ffffff;
            }
            .venue-nav-link.active {
                background-color: rgba(255, 255, 255, 0.22);
                color: #ffffff;
                font-weight: 600;
            }
            .venue-topbar {
                background-color: #ffffff;
                border-bottom: 1px solid #e2e8f0;
            }
            .venue-card-header-blue {
                background-color: #1668e3;
                color: #ffffff;
                font-weight: 600;
            }
            .venue-stat-card {
                background: linear-gradient(135deg, #1668e3 0%, #0b47a8 100%);
                color: #ffffff;
                border: none;
                border-radius: 14px;
            }
        </style>
    </head>
    <body>
        <div class="d-flex min-h-screen">
            <aside class="venue-sidebar d-flex flex-column justify-content-between p-3">
                <div>
                    <div class="px-2 pt-2 pb-4 border-bottom border-white border-opacity-25 mb-3">
                        <a href="{{ route('dashboard') }}" class="venue-brand d-flex align-items-center gap-2">
                            <i class="bi bi-trophy-fill"></i>
                            <span>Sistem Venue</span>
                        </a>
                    </div>

                    <nav class="nav flex-column">
                        <a href="{{ route('dashboard') }}" class="venue-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('alat.index') }}" class="venue-nav-link {{ request()->routeIs('alat.*') ? 'active' : '' }}">
                            <i class="bi bi-tools"></i>
                            <span>Alat</span>
                        </a>
                        <a href="{{ route('instruktur.index') }}" class="venue-nav-link {{ request()->routeIs('instruktur.*') ? 'active' : '' }}">
                            <i class="bi bi-person-badge"></i>
                            <span>Instruktur</span>
                        </a>
                        <a href="{{ route('lapangan.index') }}" class="venue-nav-link {{ request()->routeIs('lapangan.*') ? 'active' : '' }}">
                            <i class="bi bi-geo-alt"></i>
                            <span>Lapangan</span>
                        </a>
                        <a href="{{ route('pelanggan.index') }}" class="venue-nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            <span>Pelanggan</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="venue-nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                            <i class="bi bi-person-gear"></i>
                            <span>Profil</span>
                        </a>
                    </nav>
                </div>

                <div class="pt-3 border-top border-white border-opacity-25">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </aside>

            <div class="flex-grow-1 d-flex flex-column min-w-0">
                <header class="venue-topbar px-4 py-3 d-flex justify-content-between align-items-center">
                    <div>
                        @isset($header)
                            {{ $header }}
                        @else
                            <h2 class="h5 fw-bold text-primary mb-0">Sistem Venue</h2>
                        @endisset
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2">
                            <i class="bi bi-person-circle me-1"></i>
                            {{ auth()->user()->name ?? 'Pengguna' }}
                        </span>
                    </div>
                </header>

                <main class="flex-grow-1 p-4">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>