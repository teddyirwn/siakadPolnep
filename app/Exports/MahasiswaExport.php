<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MahasiswaExport implements FromCollection , WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return Mahasiswa::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIM',
            'Nama',
            'Jenis Kelamin',
            'Angkatan',
            'Email',
            'Program Studi',

        ];
    }

    public function map($mahasiswa): array
    {
        return [
            $mahasiswa->id,
            "'" .$mahasiswa->nim,
            $mahasiswa->nama,
            $mahasiswa->jenis_kelamin,
            $mahasiswa->angkatan,
            $mahasiswa->email,
            $mahasiswa->program_studi,
        ];
    }
}
