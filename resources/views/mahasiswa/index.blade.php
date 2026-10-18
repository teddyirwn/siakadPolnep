@extends('layouts.app')
@section('title', 'Data Mahasiswa')

@section('content')
    <x-page-header judul="Data Mahasiswa" deskripsi="Daftar Mahasiswa (data Contoh)">
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#formMahasiswa">
            <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
        </button>
    </x-page-header>

    <div class="collapse mb-4" id="formMahasiswa">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-body fw-semibold">
                Form Mahasiswa
            </div>
            <div class="card-body">
                @include('mahasiswa._form')
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Daftar Mahasiswa</div>
        <div class="card-body p-0">
            <x-table :kolom="$kolom" :baris="$mahasiswa" />
        </div>
    </div>

@endsection
