<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">Tambah Data Lapangan</h2>
    </x-slot>

    <div class="card">
        <div class="card-header card-header-blue">Tambah Data Lapangan</div>
        <div class="card-body">
            <form action="/lapangan" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Lapangan:</label>
                    <input type="text" name="nama_lapangan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis:</label>
                    <input type="text" name="jenis" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga / Jam:</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi:</label>
                    <textarea name="deskripsi" rows="3" class="form-control"></textarea>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                    <a href="/lapangan" class="btn btn-outline-secondary">Kembali ke Daftar Lapangan</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>