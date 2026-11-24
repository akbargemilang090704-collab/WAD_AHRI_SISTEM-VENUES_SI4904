<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">Edit Pelanggan</h2>
    </x-slot>

    <div class="card">
        <div class="card-header card-header-blue">Edit Pelanggan</div>
        <div class="card-body">
            <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')
                @include('pelanggan._form')

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> Simpan</button>
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
