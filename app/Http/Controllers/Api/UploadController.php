<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage; // Untuk upload file

class UploadController extends Controller
{
    /**
     * [POST] Menerima file foto/video dari Customer (Bukti Kerusakan).
     * File ini di-link ke tabel device_photo.
     */
    public function uploadDevicePhoto(Request $request, $device_id)
    {
        $request->validate([
            'photo' => 'required|file|mimes:jpeg,png,jpg,gif,mp4|max:5120', // Maks 5MB
        ]);

        if (!$request->hasFile('photo')) {
            return response()->json(['message' => 'File tidak ditemukan.'], 400);
        }
        
        // Simpan File ke Storage
        $path = $request->file('photo')->store('device-photos', 'public'); 

        $device = Device::find($device_id);
        if (!$device) {
            return response()->json(['message' => 'Perangkat dengan ID tersebut tidak ditemukan.'], 404);
        }

        // 3. UPDATE KOLOM PHOTO_URL DI TABEL DEVICES (Relasi 1:1)
        $device->photo_url = Storage::url($path);
        $device->save();
        
        // Catat Path File ke Database DevicePhoto
    /*    $devicePhoto = DevicePhoto::create([
            'device_id' => $device_id, // FK yang dikirim dari frontend
            'photo_url' => Storage::url($path), // Simpan path publik
        ]);
    */
        return response()->json([
            'message' => 'Foto berhasil diunggah.',
            'device_id' => $device->device_id,
            'url' => $device->photo_url
        ], 200);
    }

    /**
     * [POST] Menerima bukti transfer/struk dari Admin (Bukti Pengeluaran).
     * File ini di-link ke kolom transactions.receipt_image.
     */
    public function uploadTransactionReceipt(Request $request, $transaction_id)
    {
        $request->validate([
            'receipt' => 'required|file|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        $transaction = Transaction::find($transaction_id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan.'], 404);
        }
        
        if (!$request->hasFile('receipt')) {
            return response()->json(['message' => 'File tidak ditemukan.'], 400);
        }

        // Simpan File ke Storage
        $path = $request->file('receipt')->store('receipts', 'public'); 

        // Update Path File di Tabel Transactions
        $transaction->transaction_image = Storage::url($path);
        $transaction->save();

        return response()->json([
            'message' => 'Bukti transfer berhasil diunggah dan dicatat.',
            'url' => $transaction->transaction_image
        ], 200);
    }
}