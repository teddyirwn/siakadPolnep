@extends('layouts.app')

@section('title', 'Tambah Matakuliah')

@section('content')
    <x-page-header judul="Tambah Matakuliah" deskripsi="Form Tambah Matakuliah Baru" />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            {{$mk->nama_mk}}
        </div>

        <div class="card-body">
            <dl class="row mb-3">
                <dt class="col-sm-3">Kode Matakuliah:</dt>
                <dd class="col-sm-9">{{$mk->kode_mk}}</dd>

                <dt class="col-sm-3">Nama Matakuliah:</dt>
                <dd class="col-sm-9">{{$mk->nama_mk}}</dd>

                <dt class="col-sm-3">SKS:</dt>
                <dd class="col-sm-9">{{$mk->sks}}</dd>
            </dl>

            <a href="{{route('matakuliah.index')}}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            @if (Auth::user()->role==="admin")
                <a href="{{route('matakuliah.edit', $mk)}}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Ubah
                </a>
            @endif
        </div>
    </div>
@endsection