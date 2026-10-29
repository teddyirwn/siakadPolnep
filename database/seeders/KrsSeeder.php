<?php

namespace Database\Seeders;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswa = Mahasiswa::limit(10)->get();

        foreach ($mahasiswa as $mhs) {
            $krs = Krs::create([
                'mahasiswa_id' => $mhs->id,
                'tahun_akademik' => '2026/2027',
                'semester' => 'Ganjil',
                'status' => 'draft'
            ]);
            $ids_mk =MataKuliah::inRandomOrder()->limit(5)->pluck('id');

            $krs->mataKuliah()->attach($ids_mk);


        }

    }
}
