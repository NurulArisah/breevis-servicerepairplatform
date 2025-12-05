<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Device;
use App\Models\Technician;
use App\Models\Diagnosis;
use App\Models\OrderTimeline;

class DemoCoreDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ambil FKs yang Dibutuhkan
        $technician = Technician::first(); // Ambil Teknisi pertama (Tama Setiawan)
        
        // Asumsi Lookup IDs:
        $STATUS_SUBMITTED = 1;
        $STATUS_ARRIVED = 3;
        $STATUS_DIAGNOSIS_COMPLETE = 4;
        $PAYMENT_PENDING = 1;

        // --- 2. CREATE DEVICE (Ditempatkan di tabel devices) ---
        $device = Device::create([
            'device_type_id' => 1,
            'device_brand_name' => 'Realme',
            'model_series' => '5i',
            'problem_description' => 'Layar retak dan tombol rusak',
            'previous_repair' => 'Tidak Pernah', // Asumsi 0=No
        ]);

        // --- 3. CREATE ORDER (Ditempatkan di tabel orders) ---
        $order = Order::create([
            'order_customer_id' => 'BRV01288765900015',
            'device_id' => $device->device_id, // Link FK
            'customer_name' => 'Tama Setiawan',
            'customer_email' => 'tamas@gmail.com',
            'customer_phone' => '085176882175',
            'order_date' => now()->subDays(2),
            'order_status_id' => $STATUS_DIAGNOSIS_COMPLETE, // Set status saat ini
            'payment_status_id' => $PAYMENT_PENDING,
            'total_price' => 1565000, // Harga estimasi Admin
            'technician_id' => $technician->technician_id, // Sudah di-assign
            'delivery_method_id' => 1, // Asumsi Pick-up
            'payment_method_id' => 1, // Asumsi COD
            'service_type_id' => 1, // Asumsi Reguler

            'transaction_id' => null,
            'diagnosis_id' => null,
            'notes' => null,
            'customer_full_address' => null,
            'city_region' => null,
        ]);

        // --- 4. CREATE DIAGNOSIS (Ditempatkan di tabel diagnosis) ---
        $diagnosis = Diagnosis::create([
            'order_id' => $order->order_id,
            'technician_id' => $technician->technician_id,
            'diagnosis_notes' => 'Ganti LCD dan tombol power.',
            'total_parts_cost' => 1000000,
            'spareparts_detail' => '{"lcd": "1200000", "button": "150000", "labor": "200000"}',
        ]);
        
        // Update Order dengan diagnosis_id
        $order->diagnosis_id = $diagnosis->diagnosis_id;
        $order->save();

        // --- 5. CREATE ORDER TIMELINE ---
        OrderTimeline::create(['order_id' => $order->order_id, 'from_status_id' => $STATUS_SUBMITTED, 'to_status_id' => $STATUS_SUBMITTED, 'description' => 'Order berhasil diterima.', 'created_at' => now()->subDays(2)]);
        OrderTimeline::create(['order_id' => $order->order_id, 'from_status_id' => $STATUS_SUBMITTED, 'to_status_id' => $STATUS_ARRIVED, 'description' => 'Perangkat sudah tiba di service center.', 'created_at' => now()->subDays(2)->addHours(5)]);
        OrderTimeline::create(['order_id' => $order->order_id, 'from_status_id' => $STATUS_ARRIVED, 'to_status_id' => $STATUS_DIAGNOSIS_COMPLETE, 'description' => 'Pengecekan telah selesai. Admin akan segera menghubungi.', 'created_at' => now()->subHours(10)]);
    }
}