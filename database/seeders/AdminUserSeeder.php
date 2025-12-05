<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // WAJIB untuk hash password
use App\Models\Admin; // Asumsi menggunakan Model User default

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. NONAKTIFKAN CEK FOREIGN KEY (Melanggar aturan 1701)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); 

        // 2. Kosongkan Tabel Admin
        DB::table('admin')->truncate(); 

        // 3. Reset Auto Increment ke 1
        DB::statement('ALTER TABLE admin AUTO_INCREMENT = 1;'); 

        // 4. AKTIFKAN KEMBALI CEK FOREIGN KEY
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // Membuat akun Admin
        Admin::create([
            'name' => 'Super Admin BriVis',
            'email' => 'admin@brivis.com',
            'password' => Hash::make('password123'), // PASSWORD WAJIB DI-HASH!
            // Jika ada kolom 'role' di tabel, set di sini: 'role' => 'admin'
        ]);
        
        // Catatan: Jika Anda menggunakan tabel 'admin', ganti User::create menjadi Admin::create
    }
}