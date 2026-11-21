@extends('layouts.app')
@section('title', 'Data Instruktur')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap gap-2 justify-content-between mb-3">
            <form method="GET" action="{{ route('instruktur.index') }}" class="d-flex gap-2">
                <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari Instruktur...">
                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                @if ($q !== '')<a href="{{ route('instruktur.index') }}" class="btn btn-outline-secondary">Reset</a>@endif
            </form>
            <a href="{{ route('instruktur.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Instruktur</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead><tr><th>#</th><th>Nama</th><th>No. Lisensi</th><th>Keahlian</th><th>Telepon</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
                <tbody>
                @forelse ($data as $i => $row)
                    <tr>
                        <td>{{ $data->firstItem() + $i }}</td>
                        <td>{{ $row->nama }}</td><td>{{ $row->no_lisensi }}</td><td>{{ $row->keahlian }}</td><td>{{ $row->telepon }}</td>
                        <td><span class="badge bg-{{ $row->status == 'Aktif' ? 'primary' : 'secondary' }}">{{ $row->status }}</span></td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('instruktur.edit', $row->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Edit</a>
                            <form action="{{ route('instruktur.destroy', $row->id) }}" method="POST" class="d-inline"
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
