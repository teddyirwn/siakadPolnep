<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index():View
    {
        $statistik =[
            ['judul' => 'Mahasiswa', 'jumlah' => 1,'ikon' =>'bi-mortarboard-fill','warna' => 'primary'],
            ['judul' => 'Dosen', 'jumlah' => 68,'ikon' =>'bi-person-badge-fill','warna' => 'success'],
            ['judul' => 'Mata Kuliah', 'jumlah' => 94,'ikon' =>'bi-book-fill','warna' => 'warning'],
            ['judul' => 'KRS Aktif', 'jumlah' => 842,'ikon' =>'bi-journal-check','warna' => 'info'],
            
        ];

        $kolomKrs = [
            'nim'=>'NIM',
            'nama'=>'Nama Mahasiswa',
            'sks'=>'SKS',
            'status'=>'Status',
        ];

        $krsTerbaru=[
            ['nim'=>'2401001','nama'=>'Budi Santoso','sks'=>20,'status'=>'Disetujui'],
            ['nim'=>'2401002','nama'=>'Siti Aminah','sks'=>18,'status'=>'Disetujui'],
            ['nim'=>'2401003','nama'=>'Ahmad Fauzi','sks'=>22,'status'=>'Disetujui'],
            ['nim'=>'2401004','nama'=>'Dewi Lestari','sks'=>16,'status'=>'Menunggu'],
            ['nim'=>'210002','nama'=>'Siti Aminah','sks'=>18,'status'=>'Disetujui'],
            ['nim'=>'2401002','nama'=>'Siti Aminah','sks'=>18,'status'=>'Disetujui'],
            ['nim'=>'2401003','nama'=>'Ahmad Fauzi','sks'=>22,'status'=>'Disetujui'],
            ['nim'=>'2401004','nama'=>'Dewi Lestari','sks'=>16,'status'=>'Menunggu'],
            ['nim'=>'210003','nama'=>'Ahmad Fauzi','sks'=>22,'status'=>'Disetujui'],
            ['nim'=>'2401002','nama'=>'Siti Aminah','sks'=>18,'status'=>'Disetujui'],
            ['nim'=>'2401003','nama'=>'Ahmad Fauzi','sks'=>22,'status'=>'Disetujui'],
            ['nim'=>'2401004','nama'=>'Dewi Lestari','sks'=>16,'status'=>'Menunggu'],
            ['nim'=>'210004','nama'=>'Dewi Lestari','sks'=>16,'status'=>'Menunggu'],
        ];

        $statusKrs = [
            ['label' => 'Disetujui', 'persen' => 70, 'warna' => 'success'],
            ['label' => 'Menunggu', 'persen' => 25, 'warna' => 'warning'],
            ['label' => 'Ditolak', 'persen' => 5, 'warna' => 'danger'],
        ];

        return view('dashboard',compact('statistik','kolomKrs','krsTerbaru','statusKrs'));
    }
}
