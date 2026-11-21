@extends('layouts.app')
@section('title', 'Informasi Instruktur')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route('user.instruktur') }}" class="d-flex gap-2 mb-3">
            <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari Instruktur...">
            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
            @if ($q !== '')<a href="{{ route('user.instruktur') }}" class="btn btn-outline-secondary">Reset</a>@endif
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead><tr><th>#</th><th>Nama</th><th>Keahlian</th><th>Status</th></tr></thead>
                <tbody>
                @forelse ($data as $i => $row)
                    <tr><td>{{ $data->firstItem() + $i }}</td><td>{{ $row->nama }}</td><td>{{ $row->keahlian }}</td><td><span class="badge bg-{{ $row->status == 'Aktif' ? 'primary' : 'secondary' }}">{{ $row->status }}</span></td></tr>
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
