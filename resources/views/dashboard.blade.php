@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <x-page-header judul="Dashboard" deskripsi="Ringkasan data Akademik (Data sementara)" />

    <div class="row g-3 mb-4">
        @foreach ($statistik as $item)
            <div class="col-12 col-sm-6 col-xl">
                <x-stat-card :judul="$item['judul']" :jumlah="$item['jumlah']" :ikon="$item['ikon']" :warna="$item['warna']" />
            </div>
        @endforeach
    </div>

    <div class="row g-3">
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-body fw-semibold">KRS Terbaru</div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                @foreach ($kolomKrs as $key => $label)
                                    <th>{{ $label }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataKrs as $item)
                                <tr>
                                    <td>{{ $item['nim'] }}</td>
                                    <td>{{ $item['nama'] }}</td>
                                    <td>{{ $item['sks'] }} SKS</td>
                                    <td>
                                        <span
                                            class="badge 
                        @if ($item['status'] == 'disetujui') bg-success 
                        @elseif($item['status'] == 'draft') bg-warning text-dark 
                        @else bg-danger @endif">
                                            {{ ucfirst($item['status']) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-body fw-semibold">Status KRS</div>
                <div class="card-body">
                    @foreach ($statusKrs as $s)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small mb-1">
                                <span>{{ $s['label'] }}</span>
                                <span>{{ $s['persen'] }}%</span>
                            </div>
                            <div class="progress" role="progressbar" aria-valuenow="{{ $s['persen'] }}" aria-valuemin="0"
                                aria-valuemax="100">
                                <div class="progress-bar bg-{{ $s['warna'] }}" style="width: {{ $s['persen'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
