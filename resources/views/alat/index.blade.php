@extends('layouts.app')
@section('title', 'Data Alat')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap gap-2 justify-content-between mb-3">
            <form method="GET" action="{{ route('alat.index') }}" class="d-flex gap-2">
                <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari Alat...">
                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                @if ($q !== '')<a href="{{ route('alat.index') }}" class="btn btn-outline-secondary">Reset</a>@endif
            </form>
            <a href="{{ route('alat.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Alat</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead><tr><th>#</th><th>Kode</th><th>Nama</th><th>Kategori</th><th>Kondisi</th><th>Stok</th><th>Tarif Sewa</th><th class="text-end">Aksi</th></tr></thead>
                <tbody>
                @forelse ($data as $i => $row)
                    <tr>
                        <td>{{ $data->firstItem() + $i }}</td>
                        <td>{{ $row->kode }}</td><td>{{ $row->nama }}</td><td>{{ $row->kategori }}</td>
                        <td><span class="badge bg-{{ $row->kondisi == 'Baik' ? 'primary' : ($row->kondisi == 'Rusak' ? 'danger' : 'warning text-dark') }}">{{ $row->kondisi }}</span></td>
                        <td>{{ $row->stok }}</td><td>Rp {{ number_format($row->tarif_sewa, 0, ',', '.') }}</td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('alat.edit', $row->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Edit</a>
                            <form action="{{ route('alat.destroy', $row->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit"><i class="bi bi-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
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
