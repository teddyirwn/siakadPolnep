<?php

namespace App\Exports;

use App\Models\MataKuliah;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MataKuliahExport implements FromCollection, WithHeadings,WithMapping
{
    public function collection(): Collection
    {
        return MataKuliah::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kode Mata Kuliah',
            'Nama Mata Kuliah',
            'SKS',
        ];
    }

    public function map($mataKuliah): array
    {
        return [
            $mataKuliah->id,
            $mataKuliah->kode_mk,
            $mataKuliah->nama_mk,
            $mataKuliah->sks,
        ];
    }
}
