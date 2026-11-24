<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 fw-bold text-dark mb-0">
                Daftar Lapangan
            </h2>
        </div>
    </x-slot>

    <div class="container-fluid py-4 px-4">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                    <p class="text-muted mb-0">Berikut adalah data lapangan yang tersedia:</p>

                    @if(auth()->user()->role === 'admin')
                        <a href="/lapangan/create" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Lapangan Baru
                        </a>
                    @endif
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Lapangan</th>
                                <th>Jenis</th>
                                <th>Harga / Jam</th>
                                <th>Deskripsi</th>

                                @if(auth()->user()->role === 'admin')
                                    <th class="text-end">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lapangans as $key => $lapangan)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td class="fw-semibold">{{ $lapangan->nama_lapangan }}</td>
                                <td>{{ $lapangan->jenis }}</td>
                                <td>Rp {{ number_format($lapangan->harga, 0, ',', '.') }}</td>
                                <td>{{ $lapangan->deskripsi }}</td>

                                @if(auth()->user()->role === 'admin')
                                    <td class="text-end text-nowrap">
                                        <a href="{{ route('lapangan.edit', $lapangan->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>

                                        <form action="{{ route('lapangan.destroy', $lapangan->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Yakin mau hapus data ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>