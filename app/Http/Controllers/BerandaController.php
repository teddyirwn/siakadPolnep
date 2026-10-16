<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index() {
        $versiMysql = DB::selectOne('select version() as versi')->versi;

        return view('beranda',[
            'namaAplikasi' => config('app.name'),
            'versiLaravel' => app()->version(),
            'versiPhp' => PHP_VERSION,
            'versiMysql' => $versiMysql,
            'namaDatabase' => DB::getDatabaseName(),
            'waktu' => now()->translatedFormat('l, d F Y H:i:s'),
            'variable' => "<script>alert(1)</script>"
        ]);
    }
}
