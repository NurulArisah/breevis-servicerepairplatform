<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    use HasFactory;
    
    protected $table = 'device_type';

    // Asumsi nama tabel adalah 'payment_methods'
    protected $primaryKey = 'device_type_id'; 
    
    protected $fillable = [
        'device_type_name'
    ]; 
    
    // Tidak ada relasi di sini karena ini adalah Model lookup (tujuan)
}