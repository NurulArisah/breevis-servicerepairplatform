<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technician;
use Illuminate\Support\Facades\Hash; // Diperlukan jika teknisi adalah user yang login

class TechnicianController extends Controller
{
    /**
     * [GET] Menampilkan Daftar Staff (Teknisi) untuk Admin Dashboard.
     * Endpoint: GET /api/technicians
     */
    public function index(Request $request)
    {
        // Mengambil semua data teknisi dengan pagination
        $technicians = Technician::orderBy('technician_name', 'asc')
                                 ->paginate(15); 
        
        return response()->json($technicians);
    }

    /**
     * [POST] Menambahkan Teknisi Baru (Admin Action).
     * Melayani form 'Add New Technician'.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'technician_name' => 'required|string|max:100',
            'technician_phone' => 'required|string|max:20|unique:technicians,technician_phone',
            'start_from' => 'required|date',
            'salary' => 'required|numeric|min:0',
            // 'working_status' akan diset default (misal: 'Available' atau 'On Task')
        ]);

        // Buat Record Teknisi
        $technician = Technician::create(array_merge($validatedData, [
            // set default status kerja
            'working_status' => 'Off Task',
        ]));

        return response()->json([
            'message' => 'Teknisi berhasil ditambahkan.',
            'technician' => $technician
        ], 201);
    }
    
    /**
     * [GET] Mengambil daftar Order yang ditugaskan kepada Teknisi (Tombol "See Order").
     * Endpoint: GET /api/technicians/{id}/orders
     */
    public function getAssignedOrders($technicianId)
    {
        $technician = Technician::find($technicianId);

        if (!$technician) {
            return response()->json(['message' => 'Teknisi tidak ditemukan.'], 404);
        }

        // Menggunakan relasi orders() dari Model Technician
        $orders = $technician->orders()
                            ->with(['orderStatus', 'device', 'paymentStatus'])
                            ->orderBy('order_date', 'desc')
                            ->get();
        
        return response()->json([
            'technician_name' => $technician->technician_name,
            'orders' => $orders
        ]);
    }
    
    // ... Anda dapat menambahkan method update() dan destroy() di sini untuk CRUD lengkap
}