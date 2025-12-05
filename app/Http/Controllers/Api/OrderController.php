<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Device;
use App\Models\OrderTimeline;
use App\Services\OrderService; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use App\Models\OrderStatus;
use App\Models\Transaction;

class OrderController extends Controller
{
    protected $orderService;

    // Gunakan Constructor untuk inject Service
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * [POST] Menerima Order Baru dari Customer. (Customer API)
     */
    public function store(Request $request)
    {
        $PICKUP_ID = 2; // Asumsi: ID status Pick-up Service
        $STATUS_ORDER_SUBMITTED_ID = 1;

        // --- 1. VALIDASI INPUT CUSTOMER ---
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'required|email|max:100',
            
            // Data Perangkat
            'device_type_id' => 'required|integer|exists:device_type,device_type_id',
            'device_brand_name' => 'required|string|max:100', 
            'model_series' => 'required|string|max:100',
            'problem_description' => 'required|string',
            'serial_number' => 'nullable|string|max:100',
            'previous_repair' => 'required|string|in:Pernah,Tidak Pernah', 
            
            // Service Preference
            'delivery_method_id' => 'required|integer|exists:delivery_method,delivery_method_id',
            'service_type_id' => 'required|integer|exists:service_type,service_type_id',
            'payment_method_id' => 'required|integer|exists:payment_method,payment_method_id',
            'notes' => 'nullable|string', 

            // Validasi Bersyarat
            'customer_full_address' => 'required_if:delivery_method_id,' . $PICKUP_ID . '|nullable|string|max:255',
            'city_region' => 'required_if:delivery_method_id,' . $PICKUP_ID . '|nullable|string|max:50',
        ]);

        // --- 2. VALIDASI BISNIS: SATU ORDER AKTIF PER CUSTOMER ---
        /*
        $nonActiveStatusIds = [7, 8]; 
        
        $existingActiveOrder = Order::where('customer_phone', $validatedData['customer_phone'])
            ->whereNotIn('order_status_id', $nonActiveStatusIds)
            ->orWhere(function ($query) use ($validatedData, $nonActiveStatusIds) {
                $query->where('customer_email', $validatedData['customer_email'])
                      ->whereNotIn('order_status_id', $nonActiveStatusIds);
            })
            ->first();

        if ($existingActiveOrder) {
            return response()->json([
                'message' => 'Gagal. Anda sudah memiliki pesanan aktif.',
                'tracking_code' => $existingActiveOrder->order_id_customer
            ], 409); 
        }
        */

        // --- 3. EKSEKUSI TRANSAKSI DATABASE ---
        try {
            DB::beginTransaction(); 

            // A. Buat Device Baru
            $device = Device::create([
                'device_type_id' => $validatedData['device_type_id'],
                'device_brand_name' => $validatedData['device_brand_name'],
                'model_series' => $validatedData['model_series'],
                'problem_description' => $validatedData['problem_description'],
                'serial_number' => $validatedData['serial_number'] ?? null,
                'previous_repair' => $validatedData['previous_repair'],
            ]);
            
            // B. Buat Order Baru
            $orderCode = 'BRV-' . date('YmdHis') . Str::random(4); 

            $order = Order::create([
                'order_customer_id' => $orderCode,
                'device_id' => $device->device_id,
                'order_date' => now(),
                'customer_name' => $validatedData['customer_name'],
                'customer_phone' => $validatedData['customer_phone'],
                'customer_email' => $validatedData['customer_email'],
                'customer_full_address' => $validatedData['customer_full_address'] ?? null,
                'city_region' => $validatedData['city_region'] ?? null,
                'order_status_id' => $STATUS_ORDER_SUBMITTED_ID, 
                'payment_status_id' => 1, 
                'total_price' => 0, 
                'delivery_method_id' => $validatedData['delivery_method_id'],
                'payment_method_id' => $validatedData['payment_method_id'],
                'service_type_id' => $validatedData['service_type_id'],
            ]);
            
            // C. CATAT TIMELINE AWAL
            OrderTimeline::create([
                'order_id' => $order->order_id,
                'from_status_id' => $STATUS_ORDER_SUBMITTED_ID, 
                'to_status_id' => $STATUS_ORDER_SUBMITTED_ID,   
                'description' => 'Order berhasil disubmit oleh customer.',

            ]);
            
            DB::commit(); 

            return response()->json([
                'message' => 'Pesanan berhasil dibuat. Mohon gunakan kode tracking ini.',
                'tracking_code' => $orderCode
            ], 201); 

        } catch (\Exception $e) {
            DB::rollBack(); 
            return response()->json(['message' => 'Server Error: Gagal memproses pesanan.'], 500); 
        }
    }

    /**
     * [GET] Menampilkan Detail Order untuk Customer Tracking. (Customer API)
     */
    public function show($order_code)
    {
        $order = Order::where('order_customer_id', $order_code)
            ->with([
                'device', 
                'timeline.toStatus', 
                'orderStatus', 
            ])
            ->first([
                'order_id', 'order_customer_id', 'order_date', 
                'customer_name', 'customer_phone', 'customer_email',
                'customer_full_address', 'city_region', 'notes',
                'payment_method_id', 'payment_status_id', 
                'service_type_id', 'delivery_method_id',
                'order_status_id', 'total_price',
            ]);

        if (!$order) {
            return response()->json(['message' => 'Kode tracking tidak valid atau pesanan tidak ditemukan.'], 404);
        }
        
        return response()->json($order);
    }

    /**
     * [GET] Menampilkan Daftar Order dan Summary Cards (Khusus Admin). (Admin API - READ)
     */
    public function index(Request $request)
    {
        // --- 1. LOGIKA SUMMARY CARDS ---
        $summaryCounts = Order::selectRaw('COUNT(orders.order_id) as total, order_status.general_category')
            ->join('order_status', 'orders.order_status_id', '=', 'order_status.order_status_id')
            ->groupBy('order_status.general_category')
            ->pluck('total', 'general_category')
            ->toArray();

        $finalSummary = [
            'ON-PROGRESS' => $summaryCounts['ON-PROGRESS'] ?? 0,
            'COMPLETED' => $summaryCounts['COMPLETED'] ?? 0,
            'CANCELLED' => $summaryCounts['CANCELLED'] ?? 0,
            'TOTAL' => array_sum($summaryCounts),
        ];
        
        // --- 2. MENGAMBIL DAFTAR ORDER UTAMA (dengan Filter/Search) ---
        $query = Order::with([
            'orderStatus', 'deliveryMethod', 'paymentMethod', 
            'technician', 
            'device'
        ]);
        
        // --- PENERAPAN LOGIKA FILTER, SEARCH, DAN DATE RANGE ---
        
        // FILTER KHUSUS BERDASARKAN TEKNISI (Filter dari Staff Management)
        $query->when($request->filled('technician_id'), function ($q) use ($request) {
            $q->where('technician_id', $request->input('technician_id'));
        });

        // A. FILTER BERDASARKAN FK (Delivery Method, Payment Status, Order Status)
        $query->when($request->filled('delivery_method_id'), function ($q) use ($request) {
            $q->where('delivery_method_id', $request->input('delivery_method_id'));
        });
        $query->when($request->filled('payment_status_id'), function ($q) use ($request) {
            $q->where('payment_status_id', $request->input('payment_status_id'));
        });
        $query->when($request->filled('order_status_id'), function ($q) use ($request) {
            $q->where('order_status_id', $request->input('order_status_id'));
        });
        // (Anda perlu menambahkan filter untuk payment_method_id)

        // B. SEARCH BERDASARKAN TULISAN (Kolom Search)
        $query->when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->input('search') . '%';
            $q->where('customer_name', 'LIKE', $searchTerm)
            ->orWhere('order_customer_id', 'LIKE', $searchTerm);
        });

        // C. FILTER BERDASARKAN TANGGAL (Calendar Dropdown)
        $query->when($request->filled('start_date') && $request->filled('end_date'), function ($q) use ($request) {
            $q->whereBetween('order_date', [
                $request->input('start_date'), 
                $request->input('end_date')
            ]);
        });
        
        // D. SORTING (orderBy) - Asumsi default sorting adalah order_date
        $query->orderBy(
            $request->input('sort_by', 'order_date'),
            $request->input('sort_direction', 'desc')
        );


        // 3. Ambil data dengan pagination
        $orders = $query->paginate(10); 

        return response()->json([
            'summary' => $finalSummary, 
            'orders' => $orders->items(), 
            'pagination' => [
                'total' => $orders->total(),
                'per_page' => $orders->perPage(),
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
            ]
        ]);
    }
    
    /**
     * [PATCH] Menugaskan Teknisi ke Order (Tugas 2: API Assign Teknisi). (Admin API - UPDATE)
     */
    public function assignTechnician(Request $request, $orderId)
    {
        $validated = $request->validate([
            'technician_id' => 'required|integer|exists:technicians,technician_id',
        ]);
        
        $result = $this->orderService->assignTechnician($orderId, $validated['technician_id']);

        if ($result['success']) {
            return response()->json($result, 200);
        }
        
        return response()->json($result, 400); 
    }

    /**
     * [PATCH] Admin/Teknisi mengisi hasil diagnosis dan estimasi harga. (Admin API - UPDATE)
     */
    public function updateDiagnosis(Request $request, $orderId)
    {
        $validated = $request->validate([
            'diagnosis_notes' => 'required|string',
            'total_parts_cost' => 'required|numeric|min:0',
            'spareparts_detail' => 'nullable|string',
        ]);

        $result = $this->orderService->updateDiagnosisAndPrice($orderId, $validated);

        if ($result['success']) {
            return response()->json($result, 200);
        }
        
        return response()->json($result, 400); 
    }

    /**
     * [PATCH] Membatalkan Order oleh Customer atau Admin. (Admin/Customer API - UPDATE)
     */
    public function cancelOrder($orderId)
    {
        $order = Order::find($orderId);

        // Asumsi ID Status:
        $CANCELLED_ORDER_ID = 8; // Order Status (Order Statuses Table)
        $CANCELLED_TRANSACTION_ID = 4; // Payment Status (Payment Statuses Table)
        
        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan.'], 404);
        }
        
        // Pengecekan Bisnis: Jangan batalkan jika status sudah selesai/dikirim (ID >= 6)
        if ($order->order_status_id >= 6) { 
            return response()->json(['message' => 'Order tidak dapat dibatalkan karena sudah selesai atau sedang dalam pengiriman kembali.'], 400);
        }

        try {
            DB::beginTransaction();

            // 1. UPDATE ORDER STATUS (Memicu Observer Timeline)
            $order->order_status_id = $CANCELLED_ORDER_ID;
            $order->save(); 

            // 2. CANCEL TRANSAKSI TERKAIT (Jika ada transaksi Income yang terkait dengan Order ini)
            $transaction = Transaction::where('order_id', $orderId)
                                    ->where('transaction_category', 'income')
                                    ->first(); 
                                    
            if ($transaction) {
                // Update status pembayaran transaksi menjadi Cancelled
                $transaction->payment_status_id = $CANCELLED_TRANSACTION_ID;
                $transaction->save();
            }

            DB::commit();

            return response()->json(['message' => 'Order berhasil dibatalkan.'], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            // Tampilkan error sebenarnya untuk diagnosis terakhir
            return response()->json(['message' => 'Fatal Error during Cancellation.', 'error_detail' => $e->getMessage()], 500);
        }
    }
    
    /**
     * [PATCH] Konfirmasi Pembayaran COD (Cash on Delivery) dari Customer. (Customer API - UPDATE)
     */
    public function confirmPayment($orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan.'], 404);
        }
        
        $COD_METHOD_ID = 4; 
        $PAID_PAYMENT_STATUS_ID = 2; 
        $PAYMENT_COMPLETED_ORDER_STATUS_ID = 6; 

        if ($order->payment_method_id != $COD_METHOD_ID) {
            return response()->json(['message' => 'Konfirmasi ini hanya untuk metode pembayaran COD.'], 400);
        }

        if ($order->payment_status_id == $PAID_PAYMENT_STATUS_ID) {
            return response()->json(['message' => 'Pembayaran sudah dikonfirmasi sebelumnya.'], 400);
        }
        
        $order->payment_status_id = $PAID_PAYMENT_STATUS_ID;
        $order->order_status_id = $PAYMENT_COMPLETED_ORDER_STATUS_ID; 
        
        $order->save();

        return response()->json(['message' => 'Pembayaran berhasil dikonfirmasi. Perangkat Anda akan segera dikirim kembali.'], 200);
    }
    
    /**
     * [PATCH] Persetujuan Perbaikan oleh Customer (Dipicu dari modal 'Proceed with Repair'). (Customer API - UPDATE)
     */
    public function approveRepair($orderId)
    {
        $order = Order::find($orderId);

        $AWAITING_APPROVAL_ID = 5; 
        $REPAIR_IN_PROGRESS_ID = 6; 
        $SERVICE_TRANSACTION_TYPE_ID = 1; // Asumsi ID untuk 'Service Payment'
        $PAYMENT_STATUS_PENDING = 1;  // Asumsi ID untuk 'Pending'

        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan.'], 404);
        }

        if ($order->order_status_id != $AWAITING_APPROVAL_ID) {
            return response()->json(['message' => 'Order tidak berada di tahap menunggu persetujuan.'], 400);
        }

        // --- START TRANSACTION (Untuk keamanan multi-Model) ---
        try {
            DB::beginTransaction();

            // 1. UPDATE ORDER STATUS (Memicu Observer Timeline)
            $order->order_status_id = $REPAIR_IN_PROGRESS_ID;

            // 2. CREATE PENDING TRANSACTION (Mencatat Pendapatan yang disetujui)
            Transaction::create([
                'order_id' => $order->order_id,
                'transaction_type_id' => $SERVICE_TRANSACTION_TYPE_ID, 
                'transaction_category' => 'income',
                'amount' => $order->total_price, // Menggunakan harga final yang di-set Admin
                'transaction_date' => now(),
                'payment_status_id' => $PAYMENT_STATUS_PENDING,
                // technician_id diisi null karena tidak terkait gaji, hanya Order
            ]);

            $order->transaction_id = $transaction->transaction_id;
            $order->save();

            // 3. Commit Transaksi
            DB::commit();

            return response()->json(['message' => 'Persetujuan perbaikan berhasil dikonfirmasi. Perbaikan akan segera dimulai.'], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal memproses persetujuan. Coba lagi.'], 500);
        }

        // $order->order_status_id = $REPAIR_IN_PROGRESS_ID;

        return response()->json(['message' => 'Persetujuan perbaikan berhasil dikonfirmasi. Perbaikan akan segera dimulai.'], 200);
    }

    public function updateStatus(Request $request, $order_id){
        // Validasi bahwa ID Status yang dikirim ada di tabel Order Status
        $request->validate([
            'order_status_id' => 'required|integer|exists:order_status,order_status_id',
        ]);

        // Cari Order
        $order = Order::find($order_id);
        
        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan.'], 404);
        }
    
        $newStatusId = $request->input('order_status_id');
    
        // Logika Status Transition: Memastikan Order Service/Model 
        // Anda yang bertanggung jawab untuk mencatat timeline dipanggil
        $order->order_status_id = $newStatusId;
        $order->save();

        // 4. Response Sukses
        return response()->json([
            'message' => 'Status Order berhasil diperbarui.',
            'new_status_id' => $newStatusId
        ], 200);
    }

    public function initiatePayment(Request $request, $order_id)
    {
        // 1. Dapatkan Order
        $order = Order::find($order_id);

        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan.'], 404);
        }
        
        // 2. Cek Metode Pembayaran (Pastikan bukan COD)
        if ($order->payment_method_id == 4 /* Asumsi ID COD */) {
            return response()->json(['message' => 'Gunakan endpoint konfirmasi COD.'], 400);
        }

        // 3. Panggil Payment Gateway (Langkah Placeholder)
        // Di sini, Anda akan menggunakan library pihak ketiga (Midtrans/Xendit)
        // untuk mengirim detail Order ($order->total_price, order_id_customer, dll.)
        
        // ASUMSI: Logika ini memanggil PaymentService
        $paymentService = new \App\Services\PaymentGatewayService(); 
        $transactionDetails = $paymentService->generateTransaction($order);

        // 4. Update Order (opsional: simpan ID transaksi dari gateway di orders.payment_id)
        $order->payment_id = $transactionDetails['gateway_id']; 
        $order->save();

        // 5. Kembalikan URL/Data Pembayaran
        return response()->json([
            'message' => 'Transaksi pembayaran berhasil dibuat.',
            'payment_data' => [
                'type' => $order->paymentMethod->method_name,
                'amount' => $order->total_price,
                'qr_code_url' => $transactionDetails['qr_url'] ?? null, // URL QRIS
                'va_number' => $transactionDetails['va_number'] ?? null, // Nomor VA
                'expiry_time' => $transactionDetails['expiry'],
            ]
        ]);
    }
}