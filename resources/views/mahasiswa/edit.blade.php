@extends('layouts.app')

@section('title', 'Edit Mahasiswa')
@section('content')

    <x-page-header judul="Ubah Mahasiswa" deskripsi="Perbarui data mahasiswa baru.NIM dan email harus tetap unik." />
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            <form action="{{ route('mahasiswa.update', $mhs) }}" method="POST">
                @csrf
                @method('PUT')
                @include('mahasiswa._form')
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
