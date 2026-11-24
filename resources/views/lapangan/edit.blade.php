<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 fw-bold text-dark mb-0">
                Edit Data Lapangan
            </h2>
        </div>
    </x-slot>

    <div class="container-fluid py-4 px-4">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <form action="{{ route('lapangan.update', $lapangan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Lapangan:</label>
                        <input type="text" name="nama_lapangan" value="{{ $lapangan->nama_lapangan }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis:</label>
                        <input type="text" name="jenis" value="{{ $lapangan->jenis }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga / Jam:</label>
                        <input type="number" name="harga" value="{{ $lapangan->harga }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi:</label>
                        <textarea name="deskripsi" rows="3" class="form-control">{{ $lapangan->deskripsi }}</textarea>
                    </div>

                    <div class="d-flex flex-wrap gap-2 align-items-center mt-4">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                        <a href="{{ route('lapangan.index') }}" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
