@extends('layouts.app')
@section('title', 'Edit Pelanggan')

@section('content')
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
@endsection
