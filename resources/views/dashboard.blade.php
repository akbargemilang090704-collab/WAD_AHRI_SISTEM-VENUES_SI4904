<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 fw-bold text-primary mb-0">Dashboard</h2>
    </x-slot>

    {{-- Banner sapaan ringkas tanpa tombol --}}
    <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #1668e3 0%, #0b47a8 100%); color: #ffffff; border-radius: 12px;">
        <div class="card-body p-4">
            <h3 class="h5 fw-bold mb-1">Halo, {{ auth()->user()->name ?? 'Pengguna' }}</h3>
            <p class="mb-0 small text-white text-opacity-75">
                Pilih modul di bawah atau lewat menu kiri untuk mengelola data Sistem Venue.
            </p>
        </div>
    </div>

    {{-- 4 Kartu modul utama --}}
    <div class="row g-3">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-semibold text-dark">Alat</span>
                            <i class="bi bi-tools text-primary fs-5"></i>
                        </div>
                        <p class="text-muted small mb-4">Data perlengkapan dan alat olahraga.</p>
                    </div>
                    <a href="{{ route('alat.index') }}" class="btn btn-outline-primary btn-sm">
                        Kelola Data
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-semibold text-dark">Instruktur</span>
                            <i class="bi bi-person-badge text-primary fs-5"></i>
                        </div>
                        <p class="text-muted small mb-4">Data instruktur sesi dan latihan.</p>
                    </div>
                    <a href="{{ route('instruktur.index') }}" class="btn btn-outline-primary btn-sm">
                        Kelola Data
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-semibold text-dark">Lapangan</span>
                            <i class="bi bi-geo-alt text-primary fs-5"></i>
                        </div>
                        <p class="text-muted small mb-4">Data venue dan lapangan tersedia.</p>
                    </div>
                    <a href="{{ route('lapangan.index') }}" class="btn btn-outline-primary btn-sm">
                        Kelola Data
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-semibold text-dark">Pelanggan</span>
                            <i class="bi bi-people text-primary fs-5"></i>
                        </div>
                        <p class="text-muted small mb-4">Data pelanggan terdaftar di sistem.</p>
                    </div>
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-primary btn-sm">
                        Kelola Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>