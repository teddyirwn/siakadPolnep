@extends('layouts.app')
@section('title', 'Data KRS')

@section('content')
    <x-page-header judul="Data KRS" deskripsi="Daftar Data KRS (data Contoh)"/>
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Daftar KRS</div>
        <div class="card-body p-0">
            <x-table :kolom="$kolom" :baris="$krs" />
        </div>
    </div>
@endsection