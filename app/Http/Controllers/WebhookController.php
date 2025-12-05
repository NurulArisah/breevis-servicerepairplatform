<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; // Diperlukan untuk transaksi (opsional, tapi disarankan)

class WebhookController extends Controller
{
    /**
     * [POST] Menerima Callback Notifikasi Pembayaran dari Payment Gateway.
     */
    public function handlePaymentCallback(Request $request)
    {
        // --- 1. Verifikasi Keamanan (WAJIB DIIISI) ---
        // Logika verifikasi signature/hash dari Payment Gateway harus di sini.
        // if (!$this->verifySignature($request)) { return response()->json('Unauthorized', 403); } 

        // --- 2. Asumsi Data & Status ID ---
        $gatewayTransactionId = $request->input('transaction_id'); 
        $paymentStatus = $request->input('transaction_status'); // Status dari Gateway (contoh: 'settlement', 'expire')
        
        // ASUMSI ID Status di tabel payment_status
        $SUCCESS_PAYMENT_ID = 2; 
        $FAILED_PAYMENT_ID = 3; 

        // --- 3. Cari Order yang Sesuai ---
        // Mencari Order menggunakan ID Transaksi (payment_id) yang sudah tercatat
        $order = Order::where('payment_id', $gatewayTransactionId)->first(); 

        if (!$order) {
            Log::warning('Webhook Error: Order ID not found for transaction ' . $gatewayTransactionId);
            return response()->json('Order Not Found', 404);
        }

        // --- 4. Logika Update Status Pembayaran ---
        try {
            DB::beginTransaction(); // Pastikan proses update aman

            if ($paymentStatus === 'settlement' || $paymentStatus === 'success') {
                
                // JIKA PEMBAYARAN SUKSES
                $order->payment_status_id = $SUCCESS_PAYMENT_ID; // <<< PERUBAHAN KRUSIAL

                // CATATAN: ORDER STATUS (misal: Repair in Progress, dll.)
                // Logika bisnis opsional untuk mengubah Order Status.
                // Misal, jika Diagnosis sudah selesai, Order bisa langsung masuk 'Repair in Progress'.
                // $order->order_status_id = 6; // ASUMSI ID 'Repair in Progress'

            } elseif ($paymentStatus === 'expire' || $paymentStatus === 'cancel') {
                
                // JIKA PEMBAYARAN GAGAL/KADALUARSA
                $order->payment_status_id = $FAILED_PAYMENT_ID;

            }
            
            $order->save();
            // OrderObserver akan otomatis mencatat perubahan status order (jika ada)

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Webhook Update Failed: ' . $e->getMessage());
            return response()->json('Server Error', 500);
        }

        // 5. Konfirmasi Penerimaan (WAJIB 200)
        return response()->json('Callback received and processed successfully', 200);
    }
}