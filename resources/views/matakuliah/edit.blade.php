@extends('layouts.app')

@section('title', 'Ubah Matakuliah')

@section('content')
    <x-page-header judul="Ubah data Mahasiswa" deskripsi="Memperbarui data Matakuliah"/>

    <div class="card border 0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Form Ubah Matakuliah
        </div>

        <div class="card-body">
            <form action="{{route('matakuliah.update', $mk->id)}}" method="POST">
                @csrf
                @method('PUT')
                @include('matakuliah._from')
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('matakuliah.index')}}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection