@extends('layouts.app')

@section('title', 'Tambah KRS')

@section('content')
    <x-page-header judul="Tambah data Krs" deskripsi="Menambah data Krs"/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Form Tambah Krs
        </div>
        <div class="card-body">
            <form action="{{ route('krs.store') }}" method="POST">
                @csrf
                @include('krs._form')
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('krs.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

@endsection