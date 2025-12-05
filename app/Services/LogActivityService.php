<?php

namespace App\Services;

use App\Models\LogActivity; // Model yang akan digunakan
use Illuminate\Support\Facades\Request; 
// Import model lain yang Anda butuhkan di Service Layer

class LogActivityService
{
    /**
     * Mencatat aktivitas ke tabel log_activities.
     */
    public function log(string $action, string $description, string $status = 'Info', int $relatedId = null, string $actorRole = null): void
    {
        // 1. Tentukan Actor ID dan Role (Logika yang kita bahas)
        $user = auth()->user();
        
        $actorId = $user ? $user->id : null; 
        
        if ($actorRole) {
            $role = $actorRole;
            $actorId = null; 
        } else {
            $role = $user ? ($user->role ?? 'Admin') : 'System';
        }

        // 2. Buat Log (WRITE)
        LogActivity::create([
            'actor_id' => $actorId,
            'actor_role' => $role,
            'action' => $action,
            'description' => $description,
            'status' => $status,
            'ip_address' => Request::ip(),
            'device_info' => Request::header('User-Agent'), 
            'related_id' => $relatedId,
        ]);
    }
}