
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 fw-bold text-dark mb-0">
                Data Pelanggan
            </h2>
        </div>
    </x-slot>

    <div class="container-fluid py-4 px-4">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-4">
                    <form method="GET" action="{{ route('pelanggan.index') }}" class="d-flex flex-wrap gap-2 align-items-center">
                        <input type="text" name="q" value="{{ $q }}" class="form-control" style="width: 240px;" placeholder="Cari Pelanggan...">
                        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                        @if ($q !== '')
                            <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">Reset</a>
                        @endif
                    </form>
                    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Pelanggan
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Level</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($data as $i => $row)
                            <tr>
                                <td>{{ $data->firstItem() + $i }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->telepon }}</td>
                                <td>{{ $row->alamat ?? '-' }}</td>
                                <td><span class="badge bg-primary">{{ $row->level_member }}</span></td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('pelanggan.edit', $row->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('pelanggan.destroy', $row->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($data->hasPages())
                    <div class="mt-3">
                        {{ $data->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
