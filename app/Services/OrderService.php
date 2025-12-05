<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Technician;
use App\Models\OrderTimeline;
use App\Models\Diagnosis;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Menugaskan Teknisi ke Order dan mencatat perubahan status ke Timeline.
     */
    public function assignTechnician(int $orderId, int $technicianId): array
    {
        $technician = Technician::find($technicianId);
        $order = Order::find($orderId);

        // Asumsi: 
        $STATUS_DRIVER_PICKED_UP_ID = 2; // ID Status 'Driver Picked Up'
        $STATUS_ORDER_SUBMITTED_ID = 1; // ID Status Awal 'Order Submitted'

        if (!$order) {
            return ['success' => false, 'message' => 'Order tidak ditemukan.'];
        }
        if (!$technician) {
            return ['success' => false, 'message' => 'Teknisi tidak ditemukan.'];
        }


        // 2. Transaksi Database
        try {
            DB::beginTransaction();

            // A. Update Order Utama (Penugasan dan Status Baru)
            $order->technician_id = $technicianId;
            $order->order_status_id = $STATUS_DRIVER_PICKED_UP_ID; // Status berubah menjadi 'Driver Picked Up'
            $order->save();

            // B. Catat Timeline (Transisi: Status Submitted -> Driver Picked Up)
            OrderTimeline::create([
                'order_id' => $order->order_id,
                'from_status_id' => $STATUS_ORDER_SUBMITTED_ID, 
                'to_status_id' => $STATUS_DRIVER_PICKED_UP_ID, 
                'description' => $technician->technician_name . ' ditugaskan untuk penjemputan.',
                'changed_by_user_id' => auth()->id() // Asumsi Admin sudah login
            ]);

            DB::commit();
            return ['success' => true, 'message' => 'Teknisi berhasil ditugaskan dan status diperbarui.'];

        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => 'Terjadi kesalahan saat memproses penugasan: ' . $e->getMessage()];
        }
    }

    public function updateDiagnosisAndPrice(int $orderId, array $data): array
    {
        $order = Order::find($orderId);
        
        // mengambbil biaya tambahan dari serviceType
        $serviceTypeCost = $order->serviceType->extra_cost; // memanggil relasi serviceType

        // Asumsi Status ID:
        $STATUS_DIAGNOSIS_COMPLETE_ID = 4; // ID Status 'Diagnosis Completed'
        $STATUS_DEVICE_ARRIVED_ID = 3;     // ID Status 'Device Arrived at Office'

        if (!$order) {
            return ['success' => false, 'message' => 'Order tidak ditemukan.'];
        }

        // 1. Cek: Pastikan Order sudah sampai (status ID 3) sebelum didiagnosis
        if ($order->order_status_id != $STATUS_DEVICE_ARRIVED_ID) {
            return ['success' => false, 'message' => 'Order belum sampai di kantor untuk didiagnosis.'];
        }

        // 2. Transaksi Database (Kunci keamanan)
        try {
            DB::beginTransaction();

            // A. Buat Record Diagnosis Baru
            $diagnosis = Diagnosis::create([
                'order_id' => $orderId,
                'technician_id' => $order->technician_id, // Gunakan Teknisi yang sudah di-assign
                'diagnosis_notes' => $data['diagnosis_notes'],
                'total_parts_cost' => $data['total_parts_cost'],
                'spareparts_detail' => $data['spareparts_detail'] ?? null, 
            ]);
            
            // B. Update Order Utama (Harga Final dan FK Diagnosis)
            $order->total_price = $serviceTypeCost; // Mengisi harga final yang dilihat customer
            $order->diagnosis_id = $diagnosis->diagnosis_id;
            
            // C. Update Status Order (Berpindah status)
            $old_status_id = $order->order_status_id;
            $order->order_status_id = $STATUS_DIAGNOSIS_COMPLETE_ID; // Pindah ke 'Diagnosis Complete'
            $order->save();
            
            // D. Catat Timeline (Log Transisi)
            // Memanggil helper logTimeline (Asumsi method ini ada di Controller/Service)
            // (new OrderTimelineService())->logTransition($orderId, $old_status_id, $STATUS_DIAGNOSIS_COMPLETE_ID, 'Diagnosis berhasil dilakukan.');
            // Jika Anda belum membuat OrderTimelineService, Anda bisa memanggil method helper di Service ini.

            DB::commit();
            return ['success' => true, 'message' => 'Diagnosis dan harga servis berhasil disimpan.'];

        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => 'DEBUG ERROR: ' . $e->getMessage()];
        }
    }
}
