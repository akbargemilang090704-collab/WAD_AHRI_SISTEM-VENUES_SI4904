<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">Edit Instruktur</h2>
    </x-slot>

    <div class="card">
        <div class="card-header card-header-blue">Edit Instruktur</div>
        <div class="card-body">
            <form action="{{ route('instruktur.update', $instruktur->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')
                @include('instruktur._form')

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> Simpan</button>
                    <a href="{{ route('instruktur.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>