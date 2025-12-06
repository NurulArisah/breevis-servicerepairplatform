<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\DB;
use App\Models\Order; // Diperlukan untuk relasi di show/index

class TransactionController extends Controller
{
    /**
     * [GET] Menampilkan Laporan Keuangan (Income/Expense Log) dan Summary.
     * Mendukung filtering berdasarkan category=income atau category=expense.
     */
    public function index(Request $request)
    {
        // 1. Hitung Summary Neraca (Total Income vs Total Expense)
        $summary = $this->calculateFinancialSummary();

        // 2. Inisiasi Query
        // Eager load relasi yang diperlukan untuk daftar tabel (Type, Order, Technician)
        $query = Transaction::with(['type', 'order', 'technician']) 
            ->orderBy('transaction_date', 'desc');

        // >>> LOGIKA FILTER CATEGORY BARU <<<
        // Memfilter berdasarkan parameter 'category' di URL (misal: ?category=income)
        if ($request->filled('category') && in_array($request->input('category'), ['income', 'expense'])) {
            $query->where('transaction_category', $request->input('category'));
        }
        
        // 3. Ambil data dengan pagination
        $transactions = $query->paginate(20);

        return response()->json([
            'summary' => $summary,
            'transactions' => $transactions->items(),
            'pagination' => [
                'total' => $transactions->total(),
                'per_page' => $transactions->perPage(),
                'current_page' => $transactions->currentPage(),
                'last_page' => $transactions->lastPage(),
            ]
        ]);
    }
    
    /**
     * [INTERNAL] Menghitung Total Income, Total Expense, dan Saldo Bersih.
     */
    private function calculateFinancialSummary()
    {
        // Menggunakan DB::raw untuk mengelompokkan dan menjumlahkan berdasarkan kategori
        $totals = Transaction::select('transaction_category')
            ->selectRaw('SUM(amount) as total_amount')
            ->groupBy('transaction_category')
            ->pluck('total_amount', 'transaction_category');

        $income = $totals['income'] ?? 0;
        $expense = $totals['expense'] ?? 0; 
        
        return [
            'total_income' => (float) $income,
            'total_expense' => (float) $expense,
            'net_balance' => (float) $income - (float) $expense
        ];
    }


    /**
     * [POST] Mencatat Transaksi Manual (Misal: Pembelian Sparepart / Pengeluaran Gaji).
     */
    public function store(Request $request)
    {
        $SPAREPART_PURCHASE_ID = 2;
        $SALARY_ID = 3;
        
        $validatedData = $request->validate([
            'transaction_type_id' => 'required|integer|exists:transaction_type,transaction_type_id',
            'transaction_category' => 'required|in:income,expense', 
            'amount' => 'required|numeric|min:0.01',
            'bank_name' => 'required_if:transaction_type_id,' . $SPAREPART_PURCHASE_ID . ',' . $SALARY_ID . '|nullable|string|max:100',
            'account_number' => 'required_if:transaction_type_id,' . $SPAREPART_PURCHASE_ID . ',' . $SALARY_ID . '|nullable|string|max:100',
            'notes' => 'nullable|string',
            'transaction_date' => 'required|date',
            'technician_id' => 'nullable|integer|exists:technicians,technician_id', 
            'order_id' => 'nullable|integer|exists:orders,order_id', 
        ]);
        
        $transaction = Transaction::create($validatedData);

        return response()->json([
            'message' => 'Transaksi berhasil dicatat.', 
            'transaction' => $transaction
        ], 201);
    }

    /**
     * [GET] Menampilkan Detail Transaksi untuk Modal (Transaction Details).
     */
    public function show($transaction_id)
    {
        // Menggunakan with untuk eager load semua data bersarang yang dibutuhkan untuk modal
        $transaction = Transaction::with([
            'type', // Transaction Type Name
            'order.diagnosis', // CRUCIAL: Untuk rincian biaya breakdown
            'order.paymentMethod',
            'order.serviceType',
            'order.deliveryMethod',
            'order.device' // Untuk detail perangkat
        ])
        ->find($transaction_id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan.'], 404);
        }
        
        return response()->json($transaction);
    }

    /**
     * [PATCH] Mengubah status transaksi menjadi "Completed/Confirmed".
     */
    public function confirmTransaction($transaction_id)
    {
        $transaction = Transaction::find($transaction_id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan.'], 404);
        }

        // Asumsi: Status ID untuk "Completed" atau "Confirmed" adalah 2
        $CONFIRMED_ID = 2; 

        // Asumsi: Tabel 'transactions' memiliki kolom 'status_id' (atau sejenisnya)
        $transaction->payment_status_id = $CONFIRMED_ID; 
        $transaction->save();

        return response()->json(['message' => 'Transaksi berhasil dikonfirmasi.'], 200);
    }

    /**
     * [PATCH] Membatalkan Transaksi.
     */
    public function cancelTransaction($transaction_id)
    {
        // Asumsi: Status ID untuk "Cancelled" adalah 4
        $CANCELLED_TRANSACTION_ID = 4;
        
        $transaction = Transaction::find($transaction_id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan.'], 404);
        }

        if ($transaction->payment_status_id == $CANCELLED_TRANSACTION_ID) {
            return response()->json(['message' => 'Transaksi ini sudah dibatalkan sebelumnya.'], 400);
        }

        if ($transaction->transaction_category === 'income' && $transaction->order_id !== null) {
            return response()->json(['message' => 'Untuk transaksi pendapatan Order, batalkan Order secara keseluruhan.'], 400);
        }

        $transaction->payment_status_id = $CANCELLED_TRANSACTION_ID;
        $transaction->save();

        return response()->json(['message' => 'Transaksi berhasil dibatalkan.'], 200);
    }
}