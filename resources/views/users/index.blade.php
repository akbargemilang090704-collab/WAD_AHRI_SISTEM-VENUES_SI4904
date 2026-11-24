<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@extends('layouts.app')
@section('title', 'Data Pengguna')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap gap-2 justify-content-between mb-3">
            <form method="GET" action="{{ route('users.index') }}" class="d-flex gap-2">
                <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari Pengguna...">
                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                @if ($q !== '')<a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Reset</a>@endif
            </form>
            <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Pengguna</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead><tr><th>#</th><th>Username</th><th>Nama</th><th>Role</th><th class="text-end">Aksi</th></tr></thead>
                <tbody>
                @forelse ($data as $i => $row)
                    <tr>
                        <td>{{ $data->firstItem() + $i }}</td>
                        <td>{{ $row->username }}</td><td>{{ $row->nama }}</td>
                        <td><span class="badge bg-{{ $row->role === 'admin' ? 'primary' : 'secondary' }}">{{ ucfirst($row->role) }}</span></td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('users.edit', $row->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Edit</a>
                            <form action="{{ route('users.destroy', $row->id) }}" method="POST" class="d-inline"
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

