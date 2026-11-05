<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Masuk') || {{config('app.name')}}</title>

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/siakad.css') }}" rel="stylesheet">
    @stack('styles')

</head>
<body class="bg-body-tertiary">

    <main class="container min-vh-100 py-4 d-flex align-items-center justify-content-center">
        <div class="w-100" style="max-width: 420px;">
            @yield('content')
        </div>

    </main>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    @push('scripts')
    <script>
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
    </script>
    @stack('scripts') 

</body>
</html>