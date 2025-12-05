<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin; // Asumsi ada model Admin/User

class LogActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'actor_id',
        'actor_role',
        'action',
        'description',
        'status',
        'ip_address',
        'device_info',
        'related_id',
    ];

    // Relasi ke Actor (Admin)
    // Asumsi aktor Admin disimpan di tabel 'admins' dengan kolom primary key 'id' atau 'admin_id'
    public function actor()
    {
        // Ganti 'Admin::class' dan foreign key jika Model atau kolomnya berbeda
        return $this->belongsTo(Admin::class, 'actor_id'); 
    }
    
    // Anda bisa tambahkan relasi ke Order atau Transaction di sini (Polymorphic/Conditional)
    // public function relatedOrder() { ... }
}