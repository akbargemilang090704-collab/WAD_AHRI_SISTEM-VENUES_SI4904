@extends('layouts.app')
@section('title', 'Dashboard Pengguna')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="stat-card bg-vs1"><i class="bi bi-geo-alt icon"></i>
        <div class="num">{{ $totalLapangan }}</div><div>Lapangan ({{ $lapanganBaik }} kondisi baik)</div></div></div>
    <div class="col-md-4"><div class="stat-card bg-vs3"><i class="bi bi-person-badge icon"></i>
        <div class="num">{{ $totalInstruktur }}</div><div>Instruktur aktif</div></div></div>
    <div class="col-md-4"><div class="stat-card bg-vs2"><i class="bi bi-tools icon"></i>
        <div class="num">{{ $totalAlat }}</div><div>Jenis alat olahraga</div></div></div>
</div>

<div class="card">
    <div class="card-header card-header-blue">Lapangan Terbaru</div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Kode</th><th>Nama</th><th>Jenis Olahraga</th><th>Status Fisik</th></tr></thead>
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
@endsection
