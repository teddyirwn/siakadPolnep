<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $kolom =[
            'kode' => 'Kode', 'nama' => 'Mata Kuliah',
            'sks' => 'SKS', 'semester' => 'Semester', 'jenis' => 'Jenis',
        ];

        $mataKuliah = [
            ['kode' =>'TIF201', 'nama' => 'Pemrograman Web', 'sks' => 3, 'semester' => 1, 'jenis' => 'Wajib'],
            ['kode' =>'TIF202', 'nama' => 'Basis Data', 'sks' => 3, 'semester' => 1, 'jenis' => 'Wajib'],
            ['kode' =>'TIF203', 'nama' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 2, 'jenis' => 'Wajib'],
            ['kode' =>'TIF204', 'nama' => 'Sistem Informasi', 'sks' => 3, 'semester' => 2, 'jenis' => 'Wajib'],
            ['kode' =>'TIF205', 'nama' => 'Pemrograman Mobile', 'sks' => 3, 'semester' => 3, 'jenis' => 'Wajib'],
            ['kode' =>'TIF206', 'nama' => 'Kecerdasan Buatan', 'sks' => 3, 'semester' => 3, 'jenis' => 'Pilihan'],
        ];
        return view('matakuliah.index',compact('kolom','mataKuliah'));
    }
}
