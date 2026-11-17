@extends('layouts.app')
@section('title', 'Tambah Lapangan')

@section('content')
<div class="card">
    <div class="card-header card-header-blue">Tambah Lapangan</div>
    <div class="card-body">
        <form action="{{ route('lapangan.store') }}" method="POST" novalidate>
            @csrf
            
            @include('lapangan._form')
            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('lapangan.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
