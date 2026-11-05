@extends('layouts.app')

@section('title', 'Edit Dosen')
@section('content')
    <x-page-header judul="Ubah Dosen"
        deskripsi="Perbarui data dosen baru.NIDN dan email harus tetap unik." />
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-body fw-semibold">
                <form action="{{route('dosen.update',$dosen)}}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('dosen._form')
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{route('dosen.index')}}" class="btn btn-outline-secondary">Batal</a>
                </form>
            </div>
        </div>
@endsection