<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    use HasFactory;
    
    protected $table = 'delivery_method';
    // Asumsi nama tabel adalah 'payment_methods'
    protected $primaryKey = 'delivery_method_id'; 
    
    protected $fillable = [
        'delivery_method_name'
    ]; 
    
    // Tidak ada relasi di sini karena ini adalah Model lookup (tujuan)
}