<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LogActivityService;
use Illuminate\Http\Request;
use App\Models\LogActivity;
use Illuminate\Support\Facades\Hash;

class LogController extends Controller
{
    /**
     * [GET] Endpoint untuk menampilkan Daftar Log Activities.
     * Mendukung filter role, status, dan search.
     */
    public function index(Request $request)
    {
        // 1. Inisiasi Query Dasar dengan eager loading relasi 'actor'
        $query = LogActivity::with('actor')
                            ->orderBy('created_at', 'desc');

        // 2. Terapkan Filter
        $query->when($request->filled('role'), function ($q) use ($request) {
            $q->where('actor_role', $request->input('role'));
        });
        
        $query->when($request->filled('status'), function ($q) use ($request) {
            $q->where('status', $request->input('status'));
        });

        // 3. Terapkan Search pada Aksi atau Deskripsi
        $query->when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->input('search') . '%';
            $q->where('action', 'LIKE', $searchTerm)
              ->orWhere('description', 'LIKE', $searchTerm);
        });

        // 4. Ambil data dengan pagination
        $logs = $query->paginate(50); // Sesuaikan angka 50 dengan kebutuhan Anda
        
        // 5. Respon API
        return response()->json($logs);
    }
}

class AuthController extends Controller
{
    protected $logService; // Deklarasi

    public function __construct() // Perlu diupdate jika belum ada injection
    {
        // Inisialisasi Log Service
        $this->logService = new LogActivityService(); 
        // Atau gunakan Dependency Injection jika Anda sudah mengaturnya di AppServiceProvider
    }

    // ... (di dalam method updateProfile)
    public function updateProfile(Request $request)
    {
        // ... (Logika Validasi dan Update)
        
        $user->fill($validatedData);
        $user->save();

        // >>> BARU: CATAT LOG AKSI <<<
        $this->logService->log(
            'Profile Updated', 
            'Admin ' . $user->email . ' memperbarui data profil.', 
            'Info'
        );

        return response()->json(['message' => 'Profile berhasil diperbarui.'], 200);
    }
    
    // ... (di dalam method changePassword)
    public function changePassword(Request $request)
    {
        // ... (Logika Validasi dan Update Password)
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        // >>> BARU: CATAT LOG AKSI KRITIS <<<
        $this->logService->log(
            'Password Changed', 
            'Password Admin ' . $user->email . ' berhasil diubah.', 
            'Critical' // Aksi ini bersifat kritis
        );
        
        // ...
    }
}