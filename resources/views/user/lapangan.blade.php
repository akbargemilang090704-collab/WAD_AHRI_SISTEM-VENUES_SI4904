@extends('layouts.app')
@section('title', 'Informasi Lapangan')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route('user.lapangan') }}" class="d-flex gap-2 mb-3">
            <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari Lapangan...">
            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
            @if ($q !== '')<a href="{{ route('user.lapangan') }}" class="btn btn-outline-secondary">Reset</a>@endif
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead><tr><th>#</th><th>Kode</th><th>Nama</th><th>Jenis Olahraga</th><th>Permukaan</th><th>Ukuran</th><th>Status Fisik</th></tr></thead>
                <tbody>
                @forelse ($data as $i => $row)
                    <tr><td>{{ $data->firstItem() + $i }}</td><td>{{ $row->kode }}</td><td>{{ $row->nama }}</td><td>{{ $row->jenis_olahraga }}</td><td>{{ $row->jenis_permukaan }}</td><td>{{ $row->ukuran }}</td><td><span class="badge bg-{{ $row->status_fisik == 'Baik' ? 'primary' : ($row->status_fisik == 'Rusak' ? 'danger' : 'warning text-dark') }}">{{ $row->status_fisik }}</span></td></tr>
                @empty
                    <tr><td colspan="20" class="text-center text-muted py-4">Data tidak ditemukan.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $data->links() }}
    </div>
</div>
@endsection
