<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       if (app()->isProduction()) {
        $this->command?->warn("UserSeeder dilewati di production");
        return;
       }

       $akun =[
        ['dosen@siakad.test', 'Dosen 1', 'dosen@123', 'dosen'],
        ['mahasiswa@siakad.test', 'Mahasiswa Uji', 'mahasiswa@123', 'mahasiswa']
       ];

       foreach($akun as [$email, $name, $password, $role]) {
        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'role' => $role
            ]
        );
       }
    }
}
