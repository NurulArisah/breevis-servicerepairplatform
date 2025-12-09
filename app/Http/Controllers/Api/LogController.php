<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogActivity;
use App\Models\Admin;
// use App\Models\User; // Jika ada model User/Customer

class LogController extends Controller
{
    public function index(Request $request)
    {
        // 1. Query Dasar
        $query = LogActivity::orderBy('created_at', 'desc');

        // 2. Filter Role
        $query->when($request->filled('role'), function ($q) use ($request) {
            $q->where('actor_role', $request->input('role'));
        });
        
        // 3. Filter Status
        $query->when($request->filled('status'), function ($q) use ($request) {
            $q->where('status', $request->input('status'));
        });

        // 4. Search (Action atau Deskripsi)
        $query->when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->input('search') . '%';
            $q->where(function($sub) use ($searchTerm) {
                $sub->where('action', 'LIKE', $searchTerm)
                    ->orWhere('description', 'LIKE', $searchTerm);
            });
        });

        // 5. Ambil Pagination
        $logs = $query->paginate(50);

        // 6. TRANSFORMASI DATA (PENTING UNTUK FRONTEND)
        // Kita ubah format data agar ada 'actionType' (untuk ikon) dan nama Actor yang jelas
        $logs->getCollection()->transform(function ($log) {
            
            // Logic menentukan Ikon berdasarkan nama Action
            $actionType = 'info';
            $act = strtolower($log->action);
            if (str_contains($act, 'delete') || str_contains($act, 'remove')) $actionType = 'delete';
            elseif (str_contains($act, 'update') || str_contains($act, 'edit') || str_contains($act, 'change')) $actionType = 'edit';
            elseif (str_contains($act, 'upload') || str_contains($act, 'submit') || str_contains($act, 'create')) $actionType = 'upload';
            elseif (str_contains($act, 'download') || str_contains($act, 'export')) $actionType = 'download';
            elseif (str_contains($act, 'login')) $actionType = 'login';

            // Logic mencari Nama Actor (Manual Lookup sederhana)
            $actorName = $log->actor_role; // Default
            if ($log->actor_role === 'Admin' && $log->actor_id) {
                $admin = Admin::find($log->actor_id);
                if ($admin) $actorName = $admin->name;
            }
            // Tambahkan else if untuk Customer jika perlu

            return [
                'id' => $log->id,
                'timestamp' => $log->created_at->format('Y-m-d H:i:s'),
                'actor' => $actorName, 
                'role' => $log->actor_role,
                'ip' => $log->ip_address ?? '-',
                'device' => $log->device_info ?? '-',
                'action' => $log->action,
                'actionType' => $actionType, // <--- Ini yang dipakai Frontend buat Icon
                'desc' => $log->description,
                'status' => $log->status ?? 'Info'
            ];
        });
        
        return response()->json($logs);
    }
}