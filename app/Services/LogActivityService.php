<?php

namespace App\Services;

use App\Models\LogActivity;
use Illuminate\Support\Facades\Request;

class LogActivityService
{
    /**
     * Catat aktivitas ke database
     *
     * @param string $action Judul aksi (misal: 'Login Success')
     * @param string $description Detail aksi
     * @param string $status (Success, Warning, Critical, Info)
     * @param mixed $relatedModel Model terkait (opsional)
     */
    public function log($action, $description, $status = 'Info', $relatedModel = null)
    {
        // Tentukan siapa yang login (Admin atau null)
        $user = auth()->user(); 
        
        // Deteksi Role
        $role = 'System';
        if ($user) {
            // Cek apakah dia instansi dari model Admin
            if ($user instanceof \App\Models\Admin) {
                $role = 'Admin';
            } else {
                $role = 'Customer';
            }
        }

        LogActivity::create([
            'actor_id' => $user ? $user->id : null, // ID Admin/User
            'actor_role' => $role,
            'action' => $action,
            'description' => $description,
            'status' => $status,
            'ip_address' => Request::ip(),
            'device_info' => Request::header('User-Agent'),
            'related_id' => $relatedModel ? $relatedModel->id : null
        ]);
    }
}