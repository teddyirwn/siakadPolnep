@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="text-center mb-4">
        <i class="bi bi-mortarboard-fill display-5 text-primary"></i>
        <h1 class="h3 fw-bold mb-1">{{ config('app.name') }}</h1>
        <p class="text-body-secondary mb-0">Politeknik Negeri Pontianak</p>
    </div>


    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h2 class="h5 mb-3">Masuk Ke akun Anda</h2>

            <form action="{{ route('login.attempt') }}" method="POST" novalidate>
                @csrf

                <div class="mb-3">
                    <x-form-input label="Email" name="email" type="email" autocomplete="username" required autofocus />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>

                    <div class="position-relative">

                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" required
                            autocomplete="current-password" style="padding-right: 45px;">

                        <span class="position-absolute top-50 end-0 translate-middle-y pe-3"
                            style="cursor: pointer; z-index: 10;" id="togglePassword">
                            <i class="bi bi-eye text-secondary" id="eyeIcon"></i>
                        </span>

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'text') {
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        });
    });
</script>
@endpush
