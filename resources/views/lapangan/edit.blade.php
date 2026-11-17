@extends('layouts.app')
@section('title', 'Edit Lapangan')

@section('content')
<div class="card">
    <div class="card-header card-header-blue">Edit Lapangan</div>
    <div class="card-body">
        <form action="{{ route('lapangan.update', $lapangan->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')
            @include('lapangan._form')
            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('lapangan.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
