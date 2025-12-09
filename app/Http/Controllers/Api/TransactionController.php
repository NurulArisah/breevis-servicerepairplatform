<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        // 1. Ambil data
        $transactions = Transaction::with(['order', 'technician', 'type'])
                        ->latest('transaction_date')
                        ->get();

        // 2. Format Data
        $formattedData = $transactions->map(function($item) {
            
            // Logika Nama
            $displayName = '-';
            if ($item->order) { $displayName = $item->order->customer_name; } 
            elseif ($item->technician) { $displayName = $item->technician->name; } 
            elseif ($item->name) { $displayName = $item->name; }

            $categoryName = $item->type ? $item->type->transaction_type_name : ($item->category ?? $item->transaction_category);

            // Logika Status (Cek beberapa kemungkinan kolom)
            $status = $item->payment_status_id ?? $item->status ?? 'Unpaid';

            return [
                // ID Tampilan (String #TRX...)
                'transaction_id' => '#TRX-' . str_pad($item->transaction_id, 5, '0', STR_PAD_LEFT),
                
                // --- KUNCI PERBAIKAN: ID ASLI (Integer) ---
                // Kita kirim ID asli database dengan nama 'original_id'
                'original_id' => (int) $item->transaction_id, 
                // ------------------------------------------

                'related_id' => $item->order ? $item->order->order_code : '-',
                'name' => $displayName,
                'category' => $categoryName, 
                'payment_method' => $item->payment_method ?? 'Cash',
                'amount' => $item->amount,
                'type' => $item->transaction_category, // income / expense
                'status' => $status,
                'notes' => $item->notes,
                'proof_image' => $item->transaction_image,
                'created_at' => $item->created_at,
                'transaction_date' => $item->transaction_date
            ];
        });

        // 3. Return
        return response()->json([
            'message' => 'Data retrieved',
            'data' => $formattedData,
            'summary' => [
                'income' => $transactions->where('transaction_category', 'income')->sum('amount'),
                'expense' => $transactions->where('transaction_category', 'expense')->sum('amount'),
                'revenue' => $transactions->where('transaction_category', 'income')->sum('amount') - $transactions->where('transaction_category', 'expense')->sum('amount')
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'amount' => 'required|numeric',
            'type_name' => 'required|string', // Dikirim dari Frontend (Vue)
            'transaction_category' => 'required|in:income,expense',
        ]);

        try {
            DB::beginTransaction(); // Biar aman kalau error di tengah jalan

            // 2. Cari ID Tipe Transaksi berdasarkan nama string
            // Contoh: Cari "Service Payment". Jika tidak ada, buat baru.
            $type = TransactionType::firstOrCreate(
                ['transaction_type_name' => $request->type_name]
            );

            // 3. Simpan Transaksi
            $transaction = Transaction::create([
                // Mapping ID hasil pencarian di atas
                'transaction_type_id' => $type->transaction_type_id, 
                
                // Data dari input user
                'transaction_category' => $request->transaction_category,
                'amount' => $request->amount,
                'notes' => $request->notes,
                'transaction_date' => $request->transaction_date ?? now(),
                'payment_method' => $request->payment_method ?? 'Cash',
                
                // Default value
                'status' => 'Completed',
                
                // Kolom nullable (biarkan null karena ini input manual)
                'order_id' => null,
                'technician_id' => null,
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Transaction created successfully',
                'data' => $transaction
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save transaction: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Method update status (untuk tombol Confirm/Cancel)
    public function updateStatus(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if(!$transaction) return response()->json(['message' => 'Not found'], 404);

        $transaction->update(['status' => $request->status]);
        
        return response()->json(['message' => 'Status updated']);
    }

}