<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DosenController extends Controller
{
    public function index() : View {
        $kolom = [
            'nidn' => 'NIDN', 
            'nama' => 'Nama Dosen', 
            'keahlian' => 'Bidang Keahlian', 
            'status' => 'Status'
        ];

        $dosen = [
            ['nidn' => '1234567890', 'nama' => 'Dr. Budi Santoso', 'keahlian' => 'Pemrograman', 'status' => 'Aktif'],
            ['nidn' => '0987654321', 'nama' => 'Dr. Siti Aminah', 'keahlian' => 'Basis Data', 'status' => 'Aktif'],
            ['nidn' => '1122334455', 'nama' => 'Dr. Ahmad Fauzi', 'keahlian' => 'Jaringan Komputer', 'status' => 'Aktif'],
            ['nidn' => '5566778899', 'nama' => 'Dr. Dewi Lestari', 'keahlian' => 'Sistem Informasi', 'status' => 'Tugas Belajar'],
        ];

        return view('dosen.index', compact('kolom', 'dosen'));
    }
}