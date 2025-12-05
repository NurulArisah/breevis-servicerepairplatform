<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'device_id';
    protected $fillable = [
        'order_id', // FK ke Order (jika relasi 1:1)
        'device_brand_name',
        'device_type_id',
        'model_series',
        'serial_number',
        'problem_description',
        'issue_started_date',
        'previous_repair',
        'photo_url',
    ];

    // Relasi M:1 ke DeviceType
    public function type()
    {
        // Mengambil nama Tipe Perangkat dari tabel device_types
        return $this->belongsTo(DeviceType::class, 'device_type_id');
    }

    // Relasi 1:1 ke Order
    // Perangkat ini adalah milik satu Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}