<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 1. Ganti nama class menjadi Order
class Order extends Model
{
    use HasFactory;

    // 2. Tentukan nama tabel jika tidak sesuai konvensi (opsional, tapi aman)
    protected $table = 'orders';

    // 3. Tentukan Primary Key
    protected $primaryKey = 'order_id';

    // 4. Daftar kolom yang diizinkan diisi (WHITELIST)
    protected $fillable = [
        'order_customer_id',
        'order_date',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_full_address',
        'city_region',
        'total_price',
        'notes',
        
        // --- DAFTAR FOREIGN KEY (FK) YANG WAJIB DIISI ---
        'device_id',            
        'technician_id',        
        'delivery_method_id',   
        'payment_method_id',    
        'payment_status_id',    
        'order_status_id',      
        'service_type_id',      
        'payment_id',           
        'diagnosis_id',         
    ];
    
    // 5. RELASI UNTUK PENGAMBILAN DATA (PENTING untuk Order Management Admin)
    
    // Relasi 1:1 ke Device
    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    // Relasi M:1 ke Technician (Yang ditugaskan Admin)
    public function technician()
    {
        return $this->belongsTo(Technician::class, 'technician_id');
    }

    // Relasi 1:M ke OrderTimeline (Untuk tracking riwayat status)
    public function timeline()
    {
        return $this->hasMany(OrderTimeline::class, 'order_id')->orderBy('created_at', 'asc');
    }
    
    // Relasi ke Lookup Tables
    public function deliveryMethod()
    {
        return $this->belongsTo(DeliveryMethod::class, 'delivery_method_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }
    
    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status_id');
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }
    
    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class, 'diagnosis_id');
    }
}