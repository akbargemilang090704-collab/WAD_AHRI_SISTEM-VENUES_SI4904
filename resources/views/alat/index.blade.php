<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 fw-bold text-dark mb-0">
                {{ __('Data Alat') }}
            </h2>
        </div>
    </x-slot>

    <div class="container-fluid py-4 px-4">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-4">
                    <form method="GET" action="{{ route('alat.index') }}" class="d-flex flex-wrap gap-2 align-items-center">
                        <input type="text" name="q" value="{{ $q }}" class="form-control" style="width: 240px;" placeholder="Cari Alat...">
                        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                        @if ($q !== '')
                            <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary">Reset</a>
                        @endif
                    </form>
                    <a href="{{ route('alat.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Alat
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Kondisi</th>
                                <th>Stok</th>
                                <th>Tarif Sewa</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($data as $i => $row)
                            <tr>
                                <td>{{ $data->firstItem() + $i }}</td>
                                <td class="fw-semibold">{{ $row->kode }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->kategori }}</td>
                                <td>
                                    <span class="badge bg-{{ $row->kondisi == 'Baik' ? 'primary' : ($row->kondisi == 'Rusak' ? 'danger' : 'warning text-dark') }}">
                                        {{ $row->kondisi }}
                                    </span>
                                </td>
                                <td>{{ $row->stok }}</td>
                                <td>Rp {{ number_format($row->tarif_sewa, 0, ',', '.') }}</td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('alat.edit', $row->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('alat.destroy', $row->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Data tidak ditemukan.</td>
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