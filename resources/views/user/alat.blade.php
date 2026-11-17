@extends('layouts.app')
@section('title', 'Informasi Alat Olahraga')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route('user.alat') }}" class="d-flex gap-2 mb-3">
            <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari Alat...">
            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
            @if ($q !== '')<a href="{{ route('user.alat') }}" class="btn btn-outline-secondary">Reset</a>@endif
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead><tr><th>#</th><th>Kode</th><th>Nama</th><th>Kategori</th><th>Kondisi</th><th>Stok</th><th>Tarif Sewa</th></tr></thead>
                <tbody>
                @forelse ($data as $i => $row)
                    <tr><td>{{ $data->firstItem() + $i }}</td><td>{{ $row->kode }}</td><td>{{ $row->nama }}</td><td>{{ $row->kategori }}</td><td>{{ $row->kondisi }}</td><td>{{ $row->stok }}</td><td>Rp {{ number_format($row->tarif_sewa, 0, ',', '.') }}</td></tr>
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
