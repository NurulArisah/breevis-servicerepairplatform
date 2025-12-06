<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTimeline extends Model
{
    use HasFactory;

    protected $table = 'order_timeline'; // Tentukan nama tabel 
    protected $primaryKey = 'timeline_id';
    
    protected $fillable = [
        'order_id',
        'user_id', // Admin/Teknisi yang melakukan perubahan status
        'from_status_id',
        'to_status_id',
        'changed_at', // Timestamp perubahan
        'decription',
    ];

    // Relasi M:1 ke Order
    public function order()
    {
        // Mengambil Order yang memiliki riwayat ini
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Relasi M:1 ke OrderStatus (Status SEBELUMNYA)
    public function fromStatus()
    {
        // Mengambil Status Awal dari riwayat perubahan
        return $this->belongsTo(OrderStatus::class, 'from_order_status_id');
    }
    
    // Relasi M:1 ke OrderStatus (Status SEKARANG)
    public function toStatus()
    {
        // Mengambil Status Akhir (Status yang baru) dari riwayat perubahan
        return $this->belongsTo(OrderStatus::class, 'to_order_status_id');
    }
    
    // Relasi M:1 ke User/Admin/Technician
    public function user()
    {
        // Mengambil data pengguna yang melakukan update status
        return $this->belongsTo(User::class, 'user_id'); 
    }
}