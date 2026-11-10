@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <x-page-header judul="Tambah Mahasiswa" deskripsi="Form Tambah Mahasiswa"/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Form Tambah Mahasiswa</div>
        <div class="card-body">
            <form action="{{route('mahasiswa.store')}}" method="POST" novalidate>
                @csrf
                @include('mahasiswa._form')
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{route('mahasiswa.index')}}" class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection