<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">Tambah Alat</h2>
    </x-slot>

    <div class="card">
        <div class="card-header card-header-blue">Tambah Alat</div>
        <div class="card-body">
            <form action="{{ route('alat.store') }}" method="POST" novalidate>
                @csrf
                @include('alat._form')

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> Simpan</button>
                    <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>