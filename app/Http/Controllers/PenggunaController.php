<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        $kolom =[
            'name' => 'Nama','email'=> 'Email','role' => 'Peran','last_login_at' => 'Terakhir Login'
        ];

        $pengguna = User::orderBy('name')->get(['name','email','role','last_login_at'])->toArray();
        return view('pengguna.index', compact('kolom', 'pengguna'));
    }
}
