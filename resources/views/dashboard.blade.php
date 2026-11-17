@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3"><div class="stat-card bg-vs1"><i class="bi bi-geo-alt icon"></i>
        <div class="num">{{ $totalLapangan }}</div><div>Lapangan ({{ $lapanganBaik }} kondisi baik)</div></div></div>
    <div class="col-6 col-xl-3"><div class="stat-card bg-vs2"><i class="bi bi-tools icon"></i>
        <div class="num">{{ $totalAlat }}</div><div>Jenis Alat (stok {{ $totalStokAlat }})</div></div></div>
    <div class="col-6 col-xl-3"><div class="stat-card bg-vs3"><i class="bi bi-person-badge icon"></i>
        <div class="num">{{ $totalInstruktur }}</div><div>Instruktur ({{ $instrukturAktif }} aktif)</div></div></div>
    <div class="col-6 col-xl-3"><div class="stat-card bg-vs4"><i class="bi bi-people icon"></i>
        <div class="num">{{ $totalPelanggan }}</div><div>Pelanggan</div></div></div>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header card-header-blue">Level Member Pelanggan</div>
            <ul class="list-group list-group-flush">
                @foreach (['Basic', 'Gold', 'VIP'] as $lv)
                    <li class="list-group-item d-flex justify-content-between">
                        {{ $lv }} <span class="badge bg-primary">{{ $levelMember[$lv] ?? 0 }}</span>
                    </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between text-muted">
                    Total pengguna sistem <span class="badge bg-secondary">{{ $totalUser }}</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card mb-3">
            <div class="card-header card-header-blue">Lapangan Terbaru</div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Kode</th><th>Nama</th><th>Jenis</th><th>Status Fisik</th></tr></thead>
                    <tbody>
                    @forelse ($lapanganTerbaru as $l)
                        <tr><td>{{ $l->kode }}</td><td>{{ $l->nama }}</td><td>{{ $l->jenis_olahraga }}</td>
                            <td><span class="badge bg-{{ $l->status_fisik == 'Baik' ? 'primary' : ($l->status_fisik == 'Rusak' ? 'danger' : 'warning text-dark') }}">{{ $l->status_fisik }}</span></td></tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted">Belum ada data.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header card-header-blue">Pelanggan Terbaru</div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Nama</th><th>Email</th><th>Level</th></tr></thead>
                    <tbody>
                    @forelse ($pelangganTerbaru as $p)
                        <tr><td>{{ $p->nama }}</td><td>{{ $p->email }}</td><td><span class="badge bg-primary">{{ $p->level_member }}</span></td></tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted">Belum ada data.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
