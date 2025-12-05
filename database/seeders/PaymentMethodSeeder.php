<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PENTING: Menonaktifkan FK cek sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); 

        // 1. Bersihkan Tabel (Hapus semua data)
        DB::table('payment_method')->truncate();

        // 2. Reset AUTO_INCREMENT (WAJIB agar ID mulai dari 1)
        DB::statement('ALTER TABLE payment_method AUTO_INCREMENT = 1;');
        
        // 3. Aktifkan FK cek kembali
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Data Metode Pembayaran BriVis
        $methods = [
            ['payment_method_name' => 'QRIS'],
            ['payment_method_name' => 'Virtual Account (VA)'],
            ['payment_method_name' => 'Bank Transfer'],
            ['payment_method_name' => 'Cash On Delivery (COD)'],
            ['payment_method_name' => 'E-Wallet (OVO/GoPay/Dana)'],
        ];

        // Masukkan data ke tabel 'payment_methods'
        DB::table('payment_method')->insert($methods);
    }
}