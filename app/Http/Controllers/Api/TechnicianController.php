<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technician;
// use App\Services\LogActivityService; // 1. Matikan Log Service Biar Gak Error

class TechnicianController extends Controller
{
    // protected $logService;

    public function __construct(/* LogActivityService $logService */)
    {
        // $this->logService = $logService;
    }

    /**
     * GET /api/admin/technicians
     * Mengambil semua daftar staff/teknisi
     */
    public function index()
    {
        // Ambil data dari database, urutkan dari yang terbaru
        $technicians = Technician::latest()->get();
        
        // MATIKAN LOG AGAR TIDAK ERROR 500
        // $this->logService->log('View Technicians', 'Admin melihat daftar teknisi', 'Success');

        return response()->json([
            'message' => 'List technicians retrieved',
            'data' => $technicians
        ], 200);
    }

    /**
     * POST /api/admin/technicians
     * Menambah staff baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:technicians,email',
            // 'phone' => 'required', // Boleh diwajibkan atau tidak
        ]);

        $tech = Technician::create([
            'name' => $request->name,
            'role' => $request->role ?? 'Technician',
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'salary' => $request->salary,
            'status' => $request->status ?? 'Off Task',
            'date_joined' => $request->date_joined ?? now()->format('M d, Y')
        ]);

        return response()->json([
            'message' => 'Technician created successfully',
            'data' => $tech
        ], 201);
    }
}