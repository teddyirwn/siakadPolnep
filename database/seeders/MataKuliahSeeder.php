<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daftar =[
            ['TI101', 'PENGANTAR TEKNOLOGI INFORMASI', 2],
            ['TI102', 'ALGORITMA DAN PEMROGRAMAN', 3],
            ['TI103', 'BASIS DATA', 3],
            ['TI104', 'JARINGAN KOMPUTER', 3],
            ['TI105', 'SISTEM OPERASI DAN ADMINISTRASI SERVER', 3],
            ['TI106', 'REKAYASA PERANGKAT LUNAK', 3],
            ['TI107', 'KEAMANAN SISTEM INFORMASI', 3],
            ['TI108', 'PENGEMBANGAN APLIKASI WEB', 3],
            ['TI109', 'PENGEMBANGAN APLIKASI MOBILE', 3],
            ['TI110', 'PENGOLAHAN CITRA DIGITAL', 3],
          
        ];

        foreach($daftar as [$kode, $nama, $sks]){
            MataKuliah::updateOrCreate(
                ['kode_mk'=> $kode],
                [
                    'nama_mk'=> $nama,
                    'sks'=> $sks
                ]
            );
        }
    }
}
