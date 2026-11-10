@extends('layouts.app')
@section('title', 'Data Matakuliah')

@section('content')
    <x-page-header judul="Data Matakuliah" deskripsi="Daftar Data Matakuliah (data Contoh)" />
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body d-flex justify-content-between align-items-center">
            <span>Daftar Matakuliah</span>

            @if (Auth::user()->role === 'admin')
                <div>
                    <a href="{{ route('matakuliah.export-pdf') }}" class="btn btn-outline-danger ">Export PDF</a>
                    <a href="{{ route('matakuliah.export-excel') }}" class="btn btn-outline-success ">Export Excel</a>
                    <a href="{{ route('matakuliah.create') }}" class="btn btn-primary">Tambah Matakuliah</a>
                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-matakuliah" class="table table-hover table-striped" id="matakuliah-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Matakuliah</th>
                            <th>Nama Matakuliah</th>
                            <th>SKS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap5.min.js') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        $(function() {
            $('#table-matakuliah').DataTable({
                processing: true,
                serverSide: true,
                ajax: @json(route('matakuliah.data', [], false)),
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kode_mk',
                        name: 'kode_mk'
                    },
                    {
                        data: 'nama_mk',
                        name: 'nama_mk'
                    },
                    {
                        data: 'sks',
                        name: 'sks'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        className: 'text-wrap',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [2, 'asc']
                ],
                language: {
                    processing: 'Memuat Data...',
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ Data',
                    infoEmpty: 'Tidak ada data',
                    infoFiltered: '(disaring dari _MAX_ data)',
                    zereRecords: 'Tidak ada data yang tersedia',
                    paginate: {
                        first: 'Awal',
                        last: 'Akhir',
                        next: 'Berikutnya',
                        previous: 'Sebelumnya'
                    }
                }
            });
        });
    </script>
@endpush

@push('scripts')
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        const csrfToken = @json(csrf_token());

        $(document).on('click', '.btn-hapus', function(e) {
            const url = this.dataset.url;
            const nama = this.dataset.nama;

            Swal.fire({
                title: 'Hapus data Matakuliah ?',
                text: 'Data ' + nama + ' Akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((hasil) => {
                if (!hasil.isConfirmed) {
                    return;
                }

                $.ajax({
                    url: url,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                }).done(function(res) {
                    $('#table-matakuliah').DataTable().ajax.reload(null, false);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Berhasil',
                        text: res.message,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }).fail(function(xhr) {
                    const pesan = (xhr.responseJSON && xhr.responseJSON.message) ||
                        'Data tidak dapat dihapus';
                    Swal.fire({

                        icon: 'error',
                        title: 'Gagal(' + xhr.status + ')',
                        text: pesan,
                    });
                });
            });
        });
    </script>
@endpush
