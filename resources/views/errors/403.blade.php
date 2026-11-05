@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
    <div class="d-flex flex-column align-items-center justify-content-center text-center py-5">
        <i class="bi bi-shield-lock-fill text-danger" style="font-size: 5rem;"></i>
        
        <h1 class="display-4 fw-bold mt-3 mb-2">403</h1>
        <h3 class="mb-3">Akses Ditolak</h3>
        
        <p class="text-body-secondary mb-4" style="max-width: 500px;">
            Maaf, Anda tidak memiliki hak akses 
        </p>
        
        <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 py-2">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Dashboard
        </a>
    </div>
@endsection