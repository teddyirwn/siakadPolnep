<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function index(): View
    {
        $kolom =[
            'nim' => 'NIM', 'nama' => 'Nama Mahasiswa',
            'angkatan' => 'Angkatan', 'email' => 'Email', 'status' => 'Status',
        ];

        $mahasiswa = [
            ['nim' => '2401001', 'nama' => 'Budi Santoso', 'angkatan' => 2024, 'email' => 'budi@example.com', 'status' => 'Aktif'],
            ['nim' => '2401002', 'nama' => 'Siti Aminah', 'angkatan' => 2024, 'email' => 'siti@example.com', 'status' => 'Aktif'],
            ['nim' => '2401003', 'nama' => 'Ahmad Fauzi', 'angkatan' => 2024, 'email' => 'ahmad@example.com', 'status' => 'Aktif'],
            ['nim' => '2401004', 'nama' => 'Dewi Lestari', 'angkatan' => 2024, 'email' => 'dewi@example.com', 'status' => 'Drop Out'],
        ];
        return view('mahasiswa.index',compact('kolom','mahasiswa'));


    }
}
