<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Technician;

class DemoTechnicianSeeder extends Seeder
{
    public function run(): void
    {
        // --- 1. PENCEGAHAN FK ERROR (WAJIB) ---
        // Menonaktifkan pemeriksaan FK agar TRUNCATE pada tabel 'technicians' diizinkan
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); 
        
        // 2. Kosongkan Tabel (Hanya dilakukan SATU KALI)
        DB::table('technicians')->truncate(); 
        
        // 3. AKTIFKAN KEMBALI CEK FOREIGN KEY
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // --- 4. MASUKKAN DATA FINAL ---
        
        // Record 1 (Tama Setiawan - Pastikan semua kolom NOT NULL terisi)
        Technician::create([
            'technician_name' => 'Muh. Rahmatullah Setiawan',
            'technician_phone' => '08367883739', // DITAMBAHKAN
            'start_from' => now(),
            'salary' => 4500000,
            'working_status' => 'Off Task', // Siap ditugaskan
        ]);

        // Record 2 (Rafly Ramadhan)
        Technician::create([
            'technician_name' => 'Rafly Ramadhan',
            'technician_phone' => '08129990001',
            'start_from' => now(),
            'salary' => 5500000,
            'working_status' => 'On Task',
        ]);
        
        // Record 3 (Tama Setiawan - Untuk pengujian relasi)
        Technician::create([
            'technician_name' => 'Nurul Arisah',
            'technician_phone' => '08123456789', // Phone number harus unik
            'start_from' => now(),
            'salary' => 4000000,
            'working_status' => 'On Task',
        ]);
    }
}