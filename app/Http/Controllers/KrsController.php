<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function index()
    {
        $kolom =[
            'nim' => 'NIM', 'nama' => 'Nama Mahasiswa',
            'semester' => 'Semester', 'sks' => 'Total SKS', 'status' => 'Status',
        ];

        $krs = [
            ['nim' => '2401001', 'nama' => 'Budi Santoso', 'semester' => 1, 'sks' => 6, 'status' => 'Aktif'],
            ['nim' => '2401002', 'nama' => 'Siti Aminah', 'semester' => 2, 'sks' => 6, 'status' => 'Aktif'],
            ['nim' => '2401003', 'nama' => 'Ahmad Fauzi', 'semester' => 3, 'sks' => 6, 'status' => 'Aktif'],
            ['nim' => '2401004', 'nama' => 'Dewi Lestari', 'semester' => 4, 'sks' => 6, 'status' => 'Aktif'],
            ['nim' => '2401005', 'nama' => 'Rina Wijaya', 'semester' => 5, 'sks' => 6, 'status' => 'Aktif'],
            ['nim' => '2401006', 'nama' => 'Andi Pratama', 'semester' => 6, 'sks' => 6, 'status' => 'Aktif'],
            ['nim' => '2401007', 'nama' => 'Dewi Lestari', 'semester' => 7, 'sks' => 6, 'status' => 'Aktif'],
            ['nim' => '2401008', 'nama' => 'Rina Wijaya', 'semester' => 8, 'sks' => 6, 'status' => 'Menunggu'],
            ['nim' => '2401009', 'nama' => 'Andi Pratama', 'semester' => 9, 'sks' => 6, 'status' => 'Ditolak'],
        ];
        return view('krs.index',compact('kolom','krs'));
    }
}
