<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    // 1. Simpan Order (POST)
    public function store(Request $request)
    {
        // Validasi basic (sesuaikan kebutuhan)
        $request->validate([
            'customer_name' => 'required',
            'device_brand' => 'required',
            'file_upload' => 'nullable|file|max:10240', // Max 10MB
        ]);

        $data = $request->all();

        // Handle File Upload
        if ($request->hasFile('file_upload')) {
            // Simpan di storage/app/public/attachments
            $path = $request->file('file_upload')->store('attachments', 'public');
            $data['attachment_path'] = $path;
        }

        // Generate Estimasi Biaya Dummy (Logic bisnis bisa ditaruh sini)
        // Misal: Biaya dasar 50.000 + Biaya Urgent 50.000
        $cost = 50000; 
        if ($request->service_type == 'Urgent Repair (+Fee)') {
            $cost += 50000;
        }
        $data['estimated_cost'] = $cost;

        // Create Order
        $order = Order::create($data);

        // Kembalikan ID agar frontend bisa redirect ke receipt
        return response()->json([
            'message' => 'Order success',
            'order_id' => $order->id 
        ], 201);
    }

    // 2. Ambil Data Order untuk Receipt (GET)
    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    // Tambahkan method ini di dalam class OrderController
    public function index()
    {
        // Mengambil semua order, urutkan dari yang terbaru
        $orders = Order::orderBy('created_at', 'desc')->get();
        
        return response()->json($orders);
    }
}