<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceBrand extends Model
{
    use HasFactory;
    
    // Asumsi nama tabel adalah 'payment_methods'
    protected $primaryKey = 'brand_id'; 
    
    protected $fillable = [
        'brand_name'
    ]; 
    
    // Tidak ada relasi di sini karena ini adalah Model lookup (tujuan)
}