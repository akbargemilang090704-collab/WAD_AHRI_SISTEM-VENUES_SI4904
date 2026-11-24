<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 fw-bold text-dark mb-0">
                Tambah Data Lapangan
            </h2>
        </div>
    </x-slot>

    <div class="container-fluid py-4 px-4">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
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

                    <div class="d-flex flex-wrap gap-2 align-items-center mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                        <a href="/lapangan" class="btn btn-outline-secondary">Kembali ke Daftar Lapangan</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>