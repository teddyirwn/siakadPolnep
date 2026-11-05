<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SIAKAD') || {{ config('app.name') }}</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/siakad.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body class="bg-body-tertiary">
   @include('layouts.partials.navbar')
    <div class="container-fluid flex-grow-1 d-flex flex-column">
        <div class="row flex-grow-1">
            @include('layouts.partials.sidebar')
            <main class="col-lg-9 col-xl-10 px-3 px-md-4 py-4 d-flex flex-column">
                {{-- @include('layouts.partials.flash') --}}

                <div class="flex-grow-1">
                    @yield('content')
                </div>

                <footer class="text-center text-body-secondary small mt-auto pt-4">
                    &copy; {{ date('Y') }} {{ config('app.name') }}
                    - D3 Teknik Informatika - Politeknik Negeri Pontianak
                </footer>
            </main>
        </div>
    </div>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    @push('scripts')
    <script>
        const htmlElement = document.documentElement;
        const themeToggleBtn = document.getElementById('darkmode');
        const themeIcon = document.getElementById('ikonTema');

        const successMessage = @json(session('success'));
        const errorMessage = @json(session('error'));

        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: successMessage,
                timer: 3000,
                showConfirmButton: true
            });
        }
        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: errorMessage,
                timer: 3000,
                showConfirmButton: true
            });
        }

        if (themeToggleBtn && themeIcon) {
            themeToggleBtn.addEventListener('click', function() {
                if (htmlElement.getAttribute('data-bs-theme') === 'light') {
                    htmlElement.setAttribute('data-bs-theme', 'dark');                    
                    themeIcon.classList.remove('bi-moon-fill');
                    themeIcon.classList.add('bi-sun-fill');
                } else {
                    htmlElement.setAttribute('data-bs-theme', 'light');                
                    themeIcon.classList.remove('bi-sun-fill');
                    themeIcon.classList.add('bi-moon-fill');
                }
            });
        }
    </script>
@endpush
@stack('scripts')

    
</body>

</html>
