@extends('layouts.app')
@section('title', 'Tambah Pengguna')

@section('content')
<div class="card">
    <div class="card-header card-header-blue">Tambah Pengguna</div>
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST" novalidate>
            @csrf
            
            @include('users._form')
            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
