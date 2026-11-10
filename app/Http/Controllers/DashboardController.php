<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index():View
    {
      

        $mhs = Mahasiswa::count();
        $dosen = Dosen::count();
        $matakuliah = MataKuliah::count();
        $krsAktif = Krs::where('status','disetujui')->count();

        $rataSks = Krs::with('mataKuliah')->get()->map(fn($krs) => $krs->mataKuliah->sum('sks'))->avg();
        $dataKrs = Krs::with(['mahasiswa', 'mataKuliah'])->latest()->limit(5)->get()->map(fn($krs) => [
            'nim' => $krs->mahasiswa->nim,
            'nama' => $krs->mahasiswa->nama,
            'sks' => $krs->mataKuliah->sum('sks'),
            'status' => $krs->status
        ]);
        

        $totalKrs = Krs::count();

        $countDisetujui = Krs::where('status', 'disetujui')->count();
        $countDiajukan  = Krs::where('status', 'diajukan')->count();
        $countDitolak   = Krs::where('status', 'ditolak')->count();

        $statusKrsDisetujui = $totalKrs > 0 ? round(($countDisetujui / $totalKrs) * 100, 1) : 0;
        $statusKrsDiajukan  = $totalKrs > 0 ? round(($countDiajukan / $totalKrs) * 100, 1) : 0;
        $statusKrsDitolak   = $totalKrs > 0 ? round(($countDitolak / $totalKrs) * 100, 1) : 0;



        $statistik =[
            ['judul' => 'Mahasiswa', 'jumlah' => $mhs,'ikon' =>'bi-mortarboard-fill','warna' => 'primary'],
            ['judul' => 'Dosen', 'jumlah' => $dosen,'ikon' =>'bi-person-badge-fill','warna' => 'success'],
            ['judul' => 'Mata Kuliah', 'jumlah' => $matakuliah,'ikon' =>'bi-book-fill','warna' => 'warning'],
            ['judul' => 'KRS Aktif', 'jumlah' => $krsAktif,'ikon' =>'bi-journal-check','warna' => 'info'],
            ['judul' => 'Rata-rata SKS', 'jumlah' => $rataSks, 'ikon' => 'bi-calculator-fill', 'warna' => 'danger'],

            
        ];



        $kolomKrs = [
            'nim'=>'NIM',
            'nama'=>'Nama Mahasiswa',
            'sks'=>'SKS',
            'status'=>'Status',
        ];

       

        $statusKrs = [
            ['label' => 'Disetujui', 'persen' => $statusKrsDisetujui, 'warna' => 'success'],
            ['label' => 'Menunggu', 'persen' => $statusKrsDiajukan, 'warna' => 'warning'],
            ['label' => 'Ditolak', 'persen' => $statusKrsDitolak, 'warna' => 'danger'],
        ];

        return view('dashboard',compact('statistik','kolomKrs','dataKrs','statusKrs'));
    }
}
