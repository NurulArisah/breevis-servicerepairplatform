<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LogActivity;
use App\Models\Admin; 

class LogActivitySeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan tabel dikosongkan sebelum insert
        DB::table('log_activities')->truncate(); 

        // Log 1: Admin Login Sukses
        LogActivity::create([
            'actor_id' => 1, 'actor_role' => 'Admin', 'action' => 'Login Successful', 
            'description' => 'Admin login berhasil.', 'status' => 'Success', 
            'ip_address' => '127.0.0.1' 
        ]);
        
        // Log 2: Sistem Menerima Pembayaran (Webhook)
        LogActivity::create([
            'actor_id' => null, 'actor_role' => 'System', 'action' => 'Payment Webhook', 
            'description' => 'Notifikasi pembayaran sukses diterima dari Gateway.', 
            'status' => 'Success', 
            'related_id' => 1, // Order ID 1
        ]);
        
        // Log 3: Aksi Kritis (Order Dihapus)
        LogActivity::create([
            'actor_id' => 1, 'actor_role' => 'Admin', 'action' => 'Order Deleted', 
            'description' => 'Order ID 10 dihapus dari sistem.', 'status' => 'Critical', 
            'related_id' => 10,
        ]);
    }
}