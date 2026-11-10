@extends('layouts.app')

@section('title', 'Tambah Matakuliah')

@section('content')
    <x-page-header  judul="Tambah Data Matakuliah" deskripsi="Menambah data MataKuliah" />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body text-start fw-semibold">
            Form Tambah Matakuliah
        </div>
        <div class="card-body">
        <form action="{{route('matakuliah.store')}}" method="POST">
            @csrf
            @include('matakuliah._from')
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{route('matakuliah.index')}}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
    </div>

    
@endsection