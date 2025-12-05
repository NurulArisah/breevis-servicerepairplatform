<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // data status spesifik dan kategori umum
        $statuses = [
            // on progress 
            ['order_status_name' => 'Order Submitted', 'general_category' => 'ON-PROGRESS'],
            ['order_status_name' => 'Driver Picked Up', 'general_category' => 'ON-PROGRESS'],
            ['order_status_name' => 'Device Arrived at Office', 'general_category' => 'ON-PROGRESS'],
            ['order_status_name' => 'Diagnosis Completed', 'general_category' => 'ON-PROGRESS'],
            ['order_status_name' => 'Awaiting Customer Approval', 'general_category' => 'ON-PROGRESS'],
            ['order_status_name' => 'Repair in Progress', 'general_category' => 'ON-PROGRESS'],

            // completed
            ['order_status_name' => 'Repair Completed', 'general_category' => 'COMPLETED'],

            // cancelled
            // --- CANCELLED (ID 8) ---
            ['status_name' => 'Order Cancelled', 'general_category' => 'CANCELLED'],
        ];

        // memasukkan data ke tabel 'order_status'
        DB::table('order_status')->insert($statuses);
    }
}
