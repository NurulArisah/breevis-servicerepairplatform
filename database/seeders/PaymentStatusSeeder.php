<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStatusSeeder extends Seeder
{
    public function run(): void
    {
        // 1. NONAKTIFKAN CEK FOREIGN KEY (WAJIB DILAKUKAN UNTUK TRUNCATE)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); 
        
        // 2. Kosongkan Tabel
        DB::table('payment_status')->truncate(); 

        // Data yang akan dimasukkan
        $statuses = [
            ['payment_status_name' => 'Pending'], 
            ['payment_status_name' => 'Completed'], 
            ['payment_status_name' => 'Failed'],
            ['payment_status_name' => 'Cancelled'],
            ['payment_status_name' => 'Expired'], 
        ];

        // 3. Memasukkan data baru
        DB::table('payment_status')->insert($statuses);
        
        // 4. AKTIFKAN KEMBALI CEK FOREIGN KEY
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}