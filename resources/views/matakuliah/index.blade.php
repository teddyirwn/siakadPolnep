@extends('layouts.app')
@section('title', 'Data Matakuliah')

@section('content')
    <x-page-header judul="Data Matakuliah" deskripsi="Daftar Data Matakuliah (data Contoh)"/>
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Daftar Matakuliah</div>
        <div class="card-body p-0">
            <x-table :kolom="$kolom" :baris="$mataKuliah" />
        </div>
    </div>
@endsection