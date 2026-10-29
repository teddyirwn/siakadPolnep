@extends('layouts.app')
@section('title', 'Detail Mahasiswa')
@section('content')
    <x-page-header judul="Detail Mahasiswa" deskripsi="Informasi lengkap mahasiswa." />
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">{{ $mahasiswa['nama'] }}</h5>
            <p class="card-text"><strong>NIM:</strong> {{ $mahasiswa['nim'] }}</p>
            <p class="card-text"><strong>Angkatan:</strong> {{ $mahasiswa['angkatan'] }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $mahasiswa['email'] }}</p>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection