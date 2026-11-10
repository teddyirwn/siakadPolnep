@extends('layouts.app')
@section('title', 'Detail Mahasiswa')

@section('content')
    <x-page-header judul="detail Mahasiswa" deskripsi="Informasi lengkap satu mahasiswa" />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            {{ $mhs->nama }}
        </div>
        <div class="card-body">
            <dl class="row mb-3">
                <dt class="col-sm-3">NIM:</dt>
                <dd class="col-sm-9">{{ $mhs->nim }}</dd>


                <dt class="col-sm-3">Nama:</dt>
                <dd class="col-sm-9">{{ $mhs->nama }}</dd>

                <dt class="col-sm-3">Email:</dt>
                <dd class="col-sm-9">{{ $mhs->email }}</dd>

                <dt class="col-sm-3">Jenis Kelamin:</dt>
                <dd class="col-sm-9">{{ $mhs->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>

                <dt class="col-sm-3">Angkatan:</dt>
                <dd class="col-sm-9">{{ $mhs->angkatan }}</dd>

                <dt class="col-sm-3">Program Studi:</dt>
                <dd class="col-sm-9">{{ $mhs->program_studi }}</dd>

               

            </dl>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('mahasiswa.edit', $mhs) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Ubah
                </a>
            @endif
        </div>
    </div>
@endsection
