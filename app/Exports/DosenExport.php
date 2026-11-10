<?php

namespace App\Exports;

use App\Models\Dosen;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DosenExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return Dosen::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIDN',
            'Nama',
            'Jenis Kelamin',
            'Email',
            'Program Studi',
        ];
    }

    public function map($dosen): array
    {
        return [
            $dosen->id,
            $dosen->nidn,
            $dosen->nama,
            $dosen->jenis_kelamin,
            $dosen->email,
            $dosen->program_studi,
        ];
    }
}
